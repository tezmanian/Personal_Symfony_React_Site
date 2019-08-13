<?php

namespace App\Controller\API;

use App\Entity\JobExperience;
use App\Entity\JobExperienceRole;
use DateTime;
use Doctrine\Common\{Annotations\AnnotationException, Persistence\ObjectManager};
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ExperienceController extends AbstractApiController
{

    private $entityManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->entityManager = $objectManager;
    }


    /**
     * Lists all experiences including roles
     *
     * @Route("/api/job/experience", name="apiJobExperienceList", format="json", methods={"GET"})
     * @IsGranted("ROLE_USER");
     * @return JsonResponse
     * @throws AnnotationException
     */
    public function apiJobExperienceList(): JsonResponse
    {

        $jobExperienceRepository = $this->entityManager->getRepository(JobExperience::class);
        
        $data = $jobExperienceRepository->findSortByDateOfRole();

        $json = $this->encodeJson($data, ['groups' => ['job', 'jobRole']]);

        return new JsonResponse($json, 200, [], true);

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

    /**
     * Adds new role to experience
     * @Route("/api/job/experience/{id}/role/new", name="apiJobRoleNew", format="json", methods={"POST"})
     * @IsGranted("ROLE_ADMIN");
     * @param Request $request
     * @param JobExperience $experience
     * @return JsonResponse
     * @throws Exception
     */
    public function apiJobRoleNew(Request $request, JobExperience $experience): JsonResponse
    {

        $em = $this->getDoctrine()->getManager();

        $title = $request->request->get('title');
        $description = $request->request->get('description');
        $location = $request->request->get('location');
        $startDate = $request->request->get('startDate');
        $startDate = ($startDate) ? new DateTime($startDate) : new DateTime();
        $endDate = $request->request->get('endDate');
        $endDate = ($endDate) ?? new DateTime($endDate);
        
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
     * @param Request $request
     * @param JobExperience $experience
     * @return JsonResponse
     * @throws Exception
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
            $jobRole->setStartDate(($role['startDate']) ? new DateTime($role['startDate']) : new DateTime());
            $jobRole->setEndDate(($role['endDate']) ?? new DateTime($role['endDate']));
            $em->persist($jobRole);            
            $experience->addRole($jobRole);
          }
        $em->persist($experience);
        $em->flush();
        }
        
        return $this->json(sprintf('JobExperienceRoles successfully created for job %s', $experience->getCompany()));
    }
}
