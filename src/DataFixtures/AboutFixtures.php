<?php

namespace App\DataFixtures;

use App\Entity\About;
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
        $about->setYear( new \DateTime("1989-01-01")));
        $about->setHeading('About me and so');
        $about->setDescription('Some things about me');
        $about->setTop(true);

        $manager->persist($about);

        for ($i=0;$i<10;$i++){
            $about = new About();
            try {
                $about->setYear(new \DateTime("199" . $i . "-01-01"));
            } catch (Exception $e) {
            }
            $about->setHeading('Some text '.$i);
            $about->setDescription('Some description '.$i);
            $about->setTop(false);

            $manager->persist($about);
        }
        $manager->flush();
    }
}
