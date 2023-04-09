<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Event;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Positive;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Champ nomProd de type TextType avec contrainte de validation NotBlank et assertion pour vérifier que la valeur est une chaîne non vide
            ->add('nomProd', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom du produit est obligatoire.',
                    ]),
                ],
                'attr' => [
                    // Assertion pour vérifier que la valeur est une chaîne non vide
                    'assert' => 'strlen(value) > 0 && is_string(value)',
                ],
            ])
            // Champ typeProd de type TextType avec contrainte de validation NotBlank et assertion pour vérifier que la valeur est une chaîne non vide
            ->add('typeProd', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le type de produit est obligatoire.',
                    ]),
                ],
                'attr' => [
                    // Assertion pour vérifier que la valeur est une chaîne non vide
                    'assert' => 'strlen(value) > 0 && is_string(value)',
                ],
            ])
            // Champ quantiteProd de type IntegerType avec contrainte de validation PositiveOrZero et assertion pour vérifier que la valeur est un entier positif ou zéro
            ->add('quantiteProd', IntegerType::class, [
                'constraints' => [
                    new PositiveOrZero([
                        'message' => 'La quantité doit être un entier positif ou zéro.',
                    ]),
                ],
                'attr' => [
                    // Assertion pour vérifier que la valeur est un entier positif ou zéro
                    'assert' => 'is_numeric(value) && value >= 0 && value == intval(value)',
                ],
            ])
            // Champ prixuProd de type MoneyType avec contrainte de validation Positive et assertion pour vérifier que la valeur est un nombre positif
            ->add('prixuProd', MoneyType::class, [
                'constraints' => [
                    new Positive([
                        'message' => 'Le prix doit être un nombre positif.',
                    ]),
                ],
                'attr' => [
                    // Assertion pour vérifier que la valeur est un nombre positif
                    'assert' => 'is_numeric(value) && value > 0',
                ],
            ])
            // Champ categorieProd de type TextType avec contrainte de validation NotBlank
            ->add('categorieProd', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'La catégorie est obligatoire.',
                    ]),
                ],
            ])
            // Champ nomEvent

            ->add('nomEvent', EntityType::class, [
                'class' => Event::class,
                'choice_value' => 'nomEvent',
                'choice_label' => 'nomEvent',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
            'events' => [], // Set default value for the events option
        ]);
    }
}
