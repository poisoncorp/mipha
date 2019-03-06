<?php
/**
 * Created by PhpStorm.
 * User: Corsair
 * Date: 06/03/2019
 * Time: 15:35
 */

// src/DataFixtures/AppFixtures.php
namespace AppBundle\DataFixtures;

use AppBundle\Entity\Signaletique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SignaletiqueFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $signaletique = new Signaletique();
            $signaletique->setName($faker->lastName);
            $signaletique->setFirstname($faker->firstName);
            $manager->persist($signaletique);
        }

        $manager->flush();
    }
}