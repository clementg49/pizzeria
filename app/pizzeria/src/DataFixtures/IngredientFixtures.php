<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    public const INGREDIENT_REFERENCE = 'ingredient_reference';

    public function load(ObjectManager $manager): void
    {
        $ingredientsList = [];
        $i = 0;
        $ingredients = ['tomate' => 0.5, 'champignons' => 0.5, 'feta' => 0.5, 'saucisses' => 0.5, 'onions' => 0.5, 'mozzarella' => 0.5, 'origan' => 1];
        foreach ($ingredients as $key => $value) {
            $ingredient = new Ingredient();
            $ingredient->setName($key);
            $ingredient->setPrice($value);
            $manager->persist($ingredient);
            $this->addReference(Ingredient::class . '_' . $i, $ingredient);
            $i++;
        }
        $manager->flush();
    }
}
