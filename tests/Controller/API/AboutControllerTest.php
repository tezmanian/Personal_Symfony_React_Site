<?php

namespace App\Tests\Controller\API;

use App\Controller\API\AboutController;
use App\Entity\About;
use App\Entity\AboutItem;
use App\Repository\AboutRepository;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AboutControllerTest extends WebTestCase
{

    public function testAboutList()
    {

        $about = new About();
        $about->setHeading('Überschrift');
        $about->setDescription('Hier könnte ein Text stehen');

        $aboutItem = new AboutItem();
        $aboutItem->setYear(new DateTime("1999-01-01"));
        $aboutItem->setHeader('an header');
        $aboutItem->setContent('some content');

        $about->addItem($aboutItem);

        $aboutRepository = $this->createMock(AboutRepository::class);

        $aboutRepository->expects($this->any())
                ->method('findBy')
                ->willReturn($about);

        $objectManager = $this->createMock(ObjectManager::class);

        $objectManager->expects($this->any())
                ->method('getRepository')
                ->willReturn($aboutRepository);

        $api = new AboutController($objectManager);
        $content = $api->apiAboutList()->getContent();

        $this->assertJson($content);

        $decode = json_decode($content, true);

        $this->assertArrayHasKey('heading', $decode);
        $this->assertEquals($about->getHeading(), $decode['heading']);

        $this->assertArrayHasKey('description', $decode);
        $this->assertEquals($about->getDescription(), $decode['description']);
    }

    public function testApiAboutGetItem()
    {
        $client = static::createClient();
        //$client = AuthenticationClientTest::getAuthenticatedClient();
        $client->request('GET', '/api/about/item/1/show');
        $this->assertResponseIsSuccessful();

        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('header', $data);
        $this->assertArrayHasKey('content', $data);
    }

    public function testApiAboutGetItemNull()
    {
        $client = static::createClient();
        //$client = AuthenticationClientTest::getAuthenticatedClient();
        $client->request('GET', '/api/about/item/10/show');
 

        $this->assertResponseIsSuccessful();
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertNull($data);

    }
    
}
