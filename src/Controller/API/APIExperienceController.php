<?php

namespace App\Controller\API;

use App\Entity\JobExperience;
use App\Entity\JobExperienceRole;
use App\Repository\JobExperienceRepository;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
// use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class APIExperienceController extends AbstractController
{

    /**
     * Lists all experiences including roles
     * @Route("/api/job/experience", name="apiJobExperienceList", format="json", methods={"GET"})
     * @IsGranted("ROLE_USER");
     * @return JsonResponse
     */
    public function apiJobExperienceList(JobExperienceRepository $jobExperienceRepository): JsonResponse
    {

        //$data = $jobExperienceRepository->findBy([], ['id' => 'DESC']);
        //$data = $jobExperienceRepository->findAll();
        
        $data = $jobExperienceRepository->findSortByDateOfRole();
        

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
            'groups' => ['job', 'jobRole'],
        ]);

        return new JsonResponse($json, 200, [], true);

        //return $this->json($jobExperienceRepository->findAll());
    }

    /**
     * Adds new experience
     * 
     * @Route("/api/job/experience/new", name="apiJobExperienceNew", format="json", methods={"POST"})
     * @IsGranted("ROLE_ADMIN");
     * @param Request $request
     * @return JsonResponse
     */
    public function apiJobExperienceNew(Request $request): JsonResponse
    {
        $company = $request->request->get('company');
        if ($company == null)
        {
          return $this->json(['error'=>'Company missing', 'code'=> 400], 400);
        }
        $url = $request->request->get('url');
        
        $entityManager = $this->getDoctrine()->getManager();
        
        $jobExperience = new JobExperience();
        $jobExperience->setCompany($company);
        $jobExperience->setUrl($url);
        
        $entityManager->persist($jobExperience);
        $entityManager->flush();
        
        return $this->json($jobExperience);
        
    }

//    /**
//     * @Route("/api/job/experience/{id}", name="apiJobExperienceShow", format="json", methods={"GET"})
//     * @IsGranted("ROLE_ADMIN");
//     * @return JsonResponse
//     */
//    public function apiJobExperienceShow(JobExperience $experience): JsonResponse
//    {
//        return $this->json($experience);
//    }

//    /**
//     * @Route("/api/job/experience/{id}/delete", name="apiJobExperienceDelete", methods={"GET","DELETE"})
//     */
//    public function apiJobDelete(Request $request, JobExperience $experience): JsonResponse
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->remove($experience);
//        $entityManager->flush();
//    }

    /**
     * Adds new role to experience
     * @Route("/api/job/experience/{id}/role/new", name="apiJobRoleNew", format="json", methods={"POST"})
     * @IsGranted("ROLE_ADMIN");
     * @return JsonResponse
     */
    public function apiJobRoleNew(Request $request, JobExperience $experience): JsonResponse
    {

        $em = $this->getDoctrine()->getManager();

        $title = $request->request->get('title');
        $description = $request->request->get('description');
        $location = $request->request->get('location');
        $startDate = $request->request->get('startDate');
        $startDate = ($startDate) ? new \DateTime($startDate) : new \DateTime();
        $endDate = $request->request->get('endDate');
        $endDate = ($endDate) ?? new \DateTime($endDate);
        
        $jobRole = new JobExperienceRole();
        $jobRole->setTitle($title);
        $jobRole->setDescription($description);
        $jobRole->setLocation($location);
        $jobRole->setStartDate($startDate);
        $jobRole->setEndDate($endDate);
        $em->persist($jobRole);

        $experience->addRole($jobRole);
        $em->persist($experience);
        $em->flush();
        
        return $this->json(sprintf('JobExperienceRole %s successfully created', $jobRole->getTitle()));

    }
    
    /**
     * Adds new roles zo experience
     * @Route("/api/job/experience/{id}/roles/new", name="apiJobRolesNew", format="json", methods={"POST"})
     * @IsGranted("ROLE_ADMIN");
     * @return JsonResponse
     */
    public function apiJobRolesNew(Request $request, JobExperience $experience): JsonResponse
    {

        $em = $this->getDoctrine()->getManager();

        $roles = $request->request->get('roles');
        
        if (is_array($roles))
        {
          foreach ($roles as $role) 
          {
            $jobRole = new JobExperienceRole();
            $jobRole->setTitle($role['title']);
            $jobRole->setDescription($role['description']);
            $jobRole->setLocation($role['location']);
            $jobRole->setStartDate(($role['startDate']) ? new \DateTime($role['startDate']) : new \DateTime());
            $jobRole->setEndDate(($role['endDate']) ?? new \DateTime($role['endDate']));
            $em->persist($jobRole);            
            $experience->addRole($jobRole);
          }
        $em->persist($experience);
        $em->flush();
        }
        
        return $this->json(sprintf('JobExperienceRoles successfully created for job', $experience->getCompany()));
    }
}
