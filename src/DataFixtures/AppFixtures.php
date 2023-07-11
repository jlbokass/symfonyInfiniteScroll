<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $article = new Article();
            $article
                ->setTitle($faker->name())
                ->setBody($faker->paragraph(10))
                ;
            $manager->persist($article);
        }

        $manager->flush();
    }
}
