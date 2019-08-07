<?php

namespace App\Tests\Controller\API;

use App\Entity\JobExperience;
use App\Repository\JobExperienceRepository;
use App\Controller\API\APIExperienceController;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Profiler\Profiler;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\UserInterface;

class APIExperienceControllerTest extends WebTestCase
{

    public function testJobExperienceList()
    {

        $job = new JobExperience();
        $job->setCompany('TestCompany');
        $job->setUrl('http://www.test.de');
        $role = $job->createRole();
        $role->setTitle('Developer');
        $role->setDescription('Senior');
        $role->setLocation('Bonn');
        $role->setStartDate(new \DateTime("2007-12-12"));
        $role->setEndDate(new \DateTime("2008-12-12"));

        $job->addRole($role);

        $jobRepository = $this->createMock(JobExperienceRepository::class);

        $jobRepository->expects($this->any())
                ->method('findSortByDateOfRole')
                ->willReturn($job);

        $objectManager = $this->createMock(ObjectManager::class);

        $objectManager->expects($this->any())
                ->method('getRepository')
                ->willReturn($jobRepository);

        $api = new APIExperienceController($objectManager);

        $this->assertJsonStringEqualsJsonString(
                "{\"id\":null,\"company\":\"TestCompany\",\"url\":\"http:\/\/www.test.de\",\"roles\":[{\"id\":null,\"title\":\"Developer\",\"description\":\"Senior\",\"startDate\":\"2007-12-12T00:00:00+01:00\",\"endDate\":\"2008-12-12T00:00:00+01:00\",\"location\":\"Bonn\"}]}",
                $api->apiJobExperienceList($objectManager)->getContent()
        );
    }

    /**
     * test apiJobExperienceList
     */
    public function testApiJobExperienceList()
    {
        $client = APIAuthenticationClientTest::getAuthenticatedClient();
        
        $client->request('GET', '/api/job/experience');
        $this->assertResponseIsSuccessful();
        $content = $client->getResponse()->getContent();
        $this->assertJson($content);
    }

}
