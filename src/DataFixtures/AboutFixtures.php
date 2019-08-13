<?php

namespace App\DataFixtures;

use App\Entity\About;
use App\Entity\AboutItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;

class AboutFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $about = new About();
        $about->setHeading('About me and so');
        $about->setDescription('Some things about me');

        for ($i=0;$i<10;$i++){
            $aboutItem = new AboutItem();
            try {
                $aboutItem->setYear(new \DateTime("199" . $i . "-01-01"));
            } catch (Exception $e) {
            }
            $aboutItem->setHeader('Some header text '.$i);
            
            $aboutItem->setContent('Some content description '.$i);
            
            $manager->persist($aboutItem);

            $about->addItem($aboutItem);
        }
        $manager->persist($about);
        $manager->flush();
    }
}
