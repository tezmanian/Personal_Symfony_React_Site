<?php

namespace App\DataFixtures;

use App\Entity\Setting;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;

class SettingFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
        $profileSettings = [
            'name' => 'René Halberstadt',
            'email' => 'halberstadt.r@web.de',
            'shorttext' => 'Hallo, ich bin René, Webdeveloper, FPV-Racer und Hobbyfotograf.',
            'github' => 'https://github.com/tezmanian',
            'xing' => 'https://www.xing.com/profile/Rene_Halberstadt/',
            'aboutthissite' => 'Willkommen auf meiner React-Webseite. Hier gibt es in Zukunft vieles über Software Entwicklung, Fotografie und FPV Racer.

Die Seite ist eines meiner Projekte. Sie wird nun mit Symfony als Backend und als React Frontend neu aufgesetzt. Derzeit gibt es noch einige statische Inhalte. Diese werden zunehmend durch dynamische ersetzt werden.'
        ];
        
        foreach ($profileSettings as $k => $v)
        {
            $setting = new Setting();
            $setting->setCategory('PROFILE');
            $setting->setName(strtoupper($k));
            $setting->setValue([$k => $v]);
            $manager->persist($setting);            
        }
        

        $manager->flush();
    }
}
