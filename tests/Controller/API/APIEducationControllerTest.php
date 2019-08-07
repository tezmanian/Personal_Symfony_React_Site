<?php

namespace App\Tests\Controller\API;

use App\Entity\Education;
use App\Repository\EducationRepository;
use App\Controller\API\APIEducationController;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class APIEducationControllerTest extends WebTestCase
{

    public function testEducationList()
    {
        $edu = new Education();
        $edu->setTitle('titel');
        $edu->setUrl('http://www.url.de');
        $edu->setStartDate(new \DateTime("2007-12-12"));
        $edu->setEndDate(new \DateTime("2008-12-12"));

        $eduRepository = $this->createMock(EducationRepository::class);

        $eduRepository->expects($this->any())
                ->method('findBy')
                ->willReturn($edu);

        $objectManager = $this->createMock(ObjectManager::class);

        $objectManager->expects($this->any())
                ->method('getRepository')
                ->willReturn($eduRepository);

        $api = new APIEducationController($objectManager);
        
        $content = $api->apiEducationList($objectManager)->getContent();
        
        $this->assertJson($content);
        
        $decode = json_decode($content,true);

        $this->assertArrayHasKey('title', $decode);
        $this->assertEquals($edu->getTitle(), $decode['title']);
        
        $this->assertArrayHasKey('url', $decode);
        $this->assertEquals($edu->getUrl(), $decode['url']);
        
        $this->assertArrayHasKey('startDate', $decode);
        $this->assertEquals($edu->getStartDate(), new \DateTime($decode['startDate']));
        
        $this->assertArrayHasKey('endDate', $decode);
        $this->assertEquals($edu->getEndDate(), new \DateTime($decode['endDate']));

    }

    /**
     * test apiJobExperienceList
     */
    public function testApiJobExperienceList()
    {
        $client = APIAuthenticationClientTest::getAuthenticatedClient();
        
        $client->request('GET', '/api/education');
        $this->assertResponseIsSuccessful();
        $content = $client->getResponse()->getContent();
        $this->assertJson($content);
    }

}
