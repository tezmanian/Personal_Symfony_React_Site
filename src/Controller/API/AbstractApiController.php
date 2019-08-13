<?php


namespace App\Controller\API;


use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


abstract class AbstractApiController extends AbstractController
{

    /**
     * @param $data
     * @param array $options
     * @return bool|float|int|string
     * @throws AnnotationException
     */
    protected function encodeJson($data, array $options = [])
    {
        $encoder = new JsonEncoder();

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $normalizer = new ObjectNormalizer($classMetadataFactory);

        $serializer = new Serializer(array(new DateTimeNormalizer(), $normalizer), array($encoder));

        return $serializer->serialize($data, 'json', $options);
    }
}