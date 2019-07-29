<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EducationFixtures extends Fixture {

    public function load(ObjectManager $manager) {

        for ($i = 0; $i < 10; $i++) {
            $edu = new \App\Entity\Education();
            $inst = "Institute_".$i;
            $edu->setInstitute($inst);
            $edu->setUrl("http://www.".$inst.".de");
            $edu->setTitle("title_".$i);
            $edu->setStartDate(new \DateTime("1998".$i."-01-01"));
            $edu->setEndDate(new \DateTime("1998".$i."-12-31"));

            $manager->persist($edu);
        }

        $manager->flush();
    }

}
