<?php

namespace App\Controller\API;

use App\Entity\Education;
use App\Repository\EducationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
// use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\Common\Persistence\ObjectManager;

class APIEducationController extends AbstractController
{
    
    private $entityManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->entityManager = $objectManager;
    }
    
    /**
     * @Route("/api/education", name="apiEducationList", format="json", methods={"GET"})
     * @IsGranted("ROLE_USER");
     */
    public function apiEducationList(): JsonResponse
    {

        $educationRepository = $this->entityManager->getRepository(Education::class);
        $data = $educationRepository->findBy([], ['endDate' => 'DESC','startDate' => 'DESC']);
        //$data = $educationRepository->findAll();
        
        $encoder = new JsonEncoder();
        // $defaultContext = [
        //     AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
        //         return $object->getId();
        //     },
        // ];

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);

        // $normalizer = new ObjectNormalizer($classMetadataFactory, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer(array(new DateTimeNormalizer(), $normalizer), array($encoder));

        $json = $serializer->serialize($data, 'json', [
//            'enable_max_depth' => true,
            'groups' => ['education'],
        ]);

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
     */
    public function apiEducationNew(Request $request): JsonResponse
    {
        $institute = $request->request->get('institute');
        $url = $request->request->get('url');
        $title = $request->request->get('title');
        $startDate = $request->request->get('startDate');
        $startDate = ($startDate) ? new \DateTime($startDate) : new \DateTime();
        $endDate = $request->request->get('endDate');
        $endDate = ($endDate) ?? new \DateTime($endDate);
        
        
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
