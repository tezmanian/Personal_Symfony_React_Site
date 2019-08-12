<?php

namespace App\Controller\API;

use App\Entity\About;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AboutController extends AbstractController
{


    private $entityManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->entityManager = $objectManager;
    }

    /**
     *
     * @Route("/api/about", name="apiAboutList", format="json", methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY");
     */
    public function apiAboutList(): JsonResponse
    {

        $educationRepository = $this->entityManager->getRepository(About::class);
        $data = $educationRepository->findBy([], ['year' => 'DESC']);

        $encoder = new JsonEncoder();

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $normalizer = new ObjectNormalizer($classMetadataFactory);

        $serializer = new Serializer(array(new DateTimeNormalizer(), $normalizer), array($encoder));

        $json = $serializer->serialize($data, 'json', [
            'groups' => ['about'],
        ]);

        return new JsonResponse($json, 200, [], true);

        //return $this->json($jobExperienceRepository->findAll());
    }

    /**
     * @Route("/api/about/{id}/show", name="apiAboutShow", requirements={"id"="\d+"}, format="json", methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY");
     * @return JsonResponse
     * @throws AnnotationException
     */
    public function apiAboutGetItem(int $id): JsonResponse
    {
        $aboutRepository = $this->entityManager->getRepository(About::class);
        $data = $aboutRepository->findOneByOffset($id, false);

        $encoder = new JsonEncoder();

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $normalizer = new ObjectNormalizer($classMetadataFactory);

        $serializer = new Serializer(array(new DateTimeNormalizer(), $normalizer), array($encoder));

        $json = $serializer->serialize($data, 'json', [
            'groups' => ['about'],
        ]);

        return new JsonResponse($json, 200, [], true);
    }
}
