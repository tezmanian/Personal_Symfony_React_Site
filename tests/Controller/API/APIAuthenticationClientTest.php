<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Tests\Controller\API;

/**
 * Description of APIAuthenticationClient
 *
 * @author halberstadt
 */
class APIAuthenticationClientTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{

    static $_token = null;
    
    static function createAuthenticatedClient($username = 'user_1', $password = 'pwd_1', $return = false)
    {
        $client = static::createClient();
        $client->request(
                'POST',
                '/api/login',
                array(),
                array(),
                array('CONTENT_TYPE' => 'application/json'),
                json_encode(array(
                    'username' => $username,
                    'password' => $password,
                ))
        );

        if ($return)
        {
            return $client->getResponse();   
        }

        $data = json_decode($client->getResponse()->getContent(), true);
        
        self::$_token = $data['token'];
    }
    
    /**
     * Returns an authenticated kernelbrowser instance
     * 
     * @return KernelBrowser
     */
    static function getAuthenticatedClient()
    {
        if (is_null(self::$_token))
        {
            self::createAuthenticatedClient();
        }
        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', self::$_token));

        return $client;        
    }
    
    public function testAuthenticationFailure()
    {
        $response = self::createAuthenticatedClient('user_2', 'pwd_2', true);
        $this->assertResponseStatusCodeSame(401);
        $content = $response->getContent();
        $this->assertJson($content);
        $decode = json_decode($content, true);
        $this->assertArrayHasKey('message', $decode);
        $this->assertEquals('Bad credentials.', $decode['message']);
    }
    
    public function testAuthenticationSuccess()
    {
        $response = self::createAuthenticatedClient('user_1', 'pwd_1', true);
        $this->assertResponseIsSuccessful();
        $content = $response->getContent();
        $this->assertJson($content);
        $decode = json_decode($content, true);
        $this->assertArrayHasKey('token', $decode);
    }
}
