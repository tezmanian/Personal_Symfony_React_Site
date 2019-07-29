<?php

namespace App\DataFixtures;

use App\Entity\JobExperience;
use App\Entity\JobExperienceRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ExperienceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($job_id = 0; $job_id < 10; $job_id++) {
            $job = new JobExperience();
            $job->setCompany('Company_' . $job_id);
            $job->setUrl('http://www.company_' . $job_id . '.de');

            for ($exp_id = 0; $exp_id < $job_id; $exp_id++) {
                $jobExp = new JobExperienceRole();
                $jobExp->setTitle('title_' . $exp_id);
                $jobExp->setLocation('location_' . $exp_id);
                $jobExp->setDescription('desc_' . $exp_id);
                $jobExp->setStartDate(new \DateTime());
                $jobExp->setEndDate(new \DateTime());
                $manager->persist($jobExp);
                $job->addRole($jobExp);
            }
            $manager->persist($job);

        }

        $manager->flush();
    }
}
