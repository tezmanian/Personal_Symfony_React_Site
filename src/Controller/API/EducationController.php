<?php

namespace App\Controller\API;

use App\Entity\Education;
use DateTime;
use Doctrine\Common\{Annotations\AnnotationException, Persistence\ObjectManager};
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EducationController extends AbstractApiController
{

    private $entityManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->entityManager = $objectManager;
    }

    /**
     *
     * @Route("/api/education", name="apiEducationList", format="json", methods={"GET"})
     * @IsGranted("ROLE_USER");
     * @throws AnnotationException
     */
    public function apiEducationList(): JsonResponse
    {

        $educationRepository = $this->entityManager->getRepository(Education::class);
        $data = $educationRepository->findBy([], ['endDate' => 'DESC', 'startDate' => 'DESC']);
        //$data = $educationRepository->findAll();

        $json = $this->encodeJson($data, ['groups' => ['education']]);

        return new JsonResponse($json, 200, [], true);

        //return $this->json($jobExperienceRepository->findAll());
    }

    /**
     * Adds new education
     *
     * @Route("/api/education/new", name="apiEducationNew", format="json", methods={"POST"})
     * @IsGranted("ROLE_ADMIN");
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function apiEducationNew(Request $request): JsonResponse
    {
        $institute = $request->request->get('institute');
        $url = $request->request->get('url');
        $title = $request->request->get('title');
        $startDate = $request->request->get('startDate');
        $startDate = ($startDate) ? new DateTime($startDate) : new DateTime();
        $endDate = $request->request->get('endDate');
        $endDate = ($endDate) ?? new DateTime($endDate);


        $entityManager = $this->getDoctrine()->getManager();

        $edu = new Education();
        $edu->setInstitute($institute);
        $edu->setTitle($title);
        $edu->setUrl($url);
        $edu->setStartDate($startDate);
        $edu->setEndDate($endDate);

        $entityManager->persist($edu);
        $entityManager->flush();

        return $this->json($edu);

    }


}
