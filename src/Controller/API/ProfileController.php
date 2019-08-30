<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\API;

use App\Entity\About;
use App\Entity\AboutItem;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SettingRepository;

/**
 * Description of ProfilePhotoController
 *
 * @author halberstadt
 */

/**
 * @Route("/api/profile")
 */
class ProfileController extends AbstractApiController
{
    
    private $_possbileProfileSettings = ['NAME','EMAIL','SHORTTEXT','GITHUB','XING','LINKEDIN','EMAIL','PHOTO','ABOUTTHISSITE'];
    
    /**
     * @Route("/", name="indexProfile", defaults={"reactRouting": null})
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY");
     */
    public function index()
    {
        return $this->redirectToRoute('indexDefault');

    }
    
    
    /**
     *
     * @Route("/get/{name}", name="apiProfileName", requirements={"name"="\w+"}, format="json", methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY");
     * @param string $name Settingname
     * @throws AnnotationException
     */
    public function apiGetProfileSetting(string $name, SettingRepository $settings): JsonResponse
    {
        if (!in_array(strtoupper($name), $this->_possbileProfileSettings)) 
        {
            return new JsonResponse(sprintf('profile setting \'%s\' not accepted', $name), 400, [], true);
        }
        
        $setting = $settings->findOneBy(['category' => 'PROFILE', 'name' => strtoupper($name)]);
        
        if (is_null($setting))
        {
            return new JsonResponse(sprintf('profile setting \'%s\' not found', $name), 400, [], true);
        }       
        
        $value = $this->encodeJson($setting->getValue());
        
        return new JsonResponse($value, 200, [], true);
    }
       
    
    /**
     *
     * @Route("/photo/get", name="apiProfilePhoto", format="json", methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY");
     * @throws AnnotationException
     */
    public function apiGetPhoto(SettingRepository $settings): JsonResponse
    {
        
//        $photo = $settings->findOneBy(['category' => 'PROFILE', 'name' => 'PHOTO']);
//        
//        /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
//            $file = $product->getBrochure();
//        
//        $values = $photo->getValue();
//        
//                        $file->move(
//                    $this->getParameter('images_directory'),
//                    $fileName
//                );

        
        
        return new JsonResponse($this->getParameter('images_directory'), 200, [], true);
    }
}
