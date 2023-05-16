<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\Entity\Pizza;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class PizzaFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 8; $i++) {
            $pizza = new Pizza();
            $pizza->setName("pizza {$i}");
            for ($y = 0; $y < random_int(2, 7); $y++) {
                $pizza->addIngredient($this->getReference(Ingredient::class . "_{$y}"));
            }
            $manager->persist($pizza);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            IngredientFixtures::class,
        ];
    }
}
