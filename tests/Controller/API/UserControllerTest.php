<?php

namespace App\Tests\Controller\API;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of UserControllerTest
 *
 * @author halberstadt
 */
class UserControllerTest extends WebTestCase
{
    
    public function testRegisterUser()
    {
        $client = AuthenticationClientTest::getAuthenticatedClient();
        $client->request(
                'POST',
                '/api/user/register',
                array(),
                array(),
                array('CONTENT_TYPE' => 'application/json'),
                json_encode(array(
                    'username' => 'username',
                    'password' => 'password',
                    'email' => 'test@test.local'
                ))
        );
        
        $this->assertResponseIsSuccessful();
        $content = $client->getResponse()->getContent();
        $this->assertJson($content);
    }
    
    public function testGetUser()
    {
        $client = AuthenticationClientTest::getAuthenticatedClient();
        $client->request('GET', '/api/user/get');
        $this->assertResponseIsSuccessful();
        $content = $client->getResponse()->getContent();
        $this->assertJson($content);
        $decode = json_decode($content, true);
        $this->assertEquals('user_1', $decode['username']);
    }
}
