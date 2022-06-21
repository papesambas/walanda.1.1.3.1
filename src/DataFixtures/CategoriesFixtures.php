<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 3; $i++) {
            $categorie = new Categories();
            $categorie->setNom($faker->domainName);
            $categorie->setSlug($faker->domainName);
            $categorie->setDescription($faker->text);

            $manager->persist($categorie);
            $this->addReference('categorie_' . $i, $categorie);
            # code...
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
