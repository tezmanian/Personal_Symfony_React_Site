<?php

namespace App\Tests\Controller\API;

use App\Controller\API\ExperienceController;
use App\Entity\JobExperience;
use App\Repository\JobExperienceRepository;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExperienceControllerTest extends WebTestCase
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
        $role->setStartDate(new DateTime("2007-12-12"));
        $role->setEndDate(new DateTime("2008-12-12"));

        $job->addRole($role);

        $jobRepository = $this->createMock(JobExperienceRepository::class);

        $jobRepository->expects($this->any())
            ->method('findSortByDateOfRole')
            ->willReturn($job);

        $objectManager = $this->createMock(ObjectManager::class);

        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($jobRepository);

        $api = new ExperienceController($objectManager);

        $content = $api->apiJobExperienceList($objectManager)->getContent();

        $this->assertJson($content);

        $decode = json_decode($content, true);

        $this->assertArrayHasKey('company', $decode);
        $this->assertEquals($job->getCompany(), $decode['company']);

        $this->assertArrayHasKey('url', $decode);
        $this->assertEquals($job->getUrl(), $decode['url']);

        $this->assertArrayHasKey('roles', $decode);
        $roles = $decode['roles'][0];

        $this->assertArrayHasKey('title', $roles);
        $this->assertEquals($role->getTitle(), $roles['title']);

        $this->assertArrayHasKey('description', $roles);
        $this->assertEquals($role->getDescription(), $roles['description']);

        $this->assertArrayHasKey('startDate', $roles);
        $this->assertEquals($role->getStartDate(), new DateTime($roles['startDate']));

        $this->assertArrayHasKey('endDate', $roles);
        $this->assertEquals($role->getEndDate(), new DateTime($roles['endDate']));

    }

    /**
     * test apiJobExperienceList
     */
    public function testApiJobExperienceList()
    {
        $client = AuthenticationClientTest::getAuthenticatedClient();

        $client->request('GET', '/api/job/experience');
        $this->assertResponseIsSuccessful();
        $content = $client->getResponse()->getContent();
        $this->assertJson($content);
    }

}
