<?php

namespace App\Form\Type;

use App\Entity\Ingredient;
use App\Entity\Pizza;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('ingredients', EntityType::class, [
                'choice_value' => function (?Ingredient $ingredient) {
                    return $ingredient ? $ingredient->getName() : '';
                },
                'choice_attr' => ChoiceList::attr($this, function (?Ingredient $ingredient) {
                    return $ingredient ? ['data-price' => $ingredient->getPrice()] : [];
                }),
                'multiple' => true,
                'row_attr' => ['class' => 'check-inline'],
                'attr' => ['class' => 'ingredient-checkbox'],
                'expanded' => true,
                'choice_label' => 'name',
                'class' => Ingredient::class,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class
        ]);
    }
}
