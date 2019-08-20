<?php

namespace App\Controller\API;

use App\Entity\About;
use App\Entity\AboutItem;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class AboutController
 * @package App\Controller\API
 * @Route("/api/about")
 */
class AboutController extends AbstractApiController
{


    private $entityManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->entityManager = $objectManager;
    }

    /**
     *
     * @Route("/", name="apiAboutList", format="json", methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY");
     * @throws AnnotationException
     */
    public function apiAboutList(): JsonResponse
    {

        $educationRepository = $this->entityManager->getRepository(About::class);
        $data = $educationRepository->findOneBy([],[]);

        $json = $this->encodeJson($data, ['groups' => ['about','aboutItem']]);

        return new JsonResponse($json, 200, [], true);
    }

    /**
     * @Route("/item/{id}/show", name="apiAboutShow", requirements={"id"="\d+"}, format="json", methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY");
     * @return JsonResponse
     * @throws AnnotationException
     */
    public function apiAboutGetItem(int $id): JsonResponse
    {
        $aboutRepository = $this->entityManager->getRepository(AboutItem::class);
        $data = $aboutRepository->findOneByOffset($id);

        $json = $this->encodeJson($data, ['groups' => ['aboutItem']]);

        return new JsonResponse($json, 200, [], true);
    }
}
