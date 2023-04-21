<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_event')
            ->add('type_event')
            ->add('nbre_salle')
            ->add('date_deb', DateType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new NotNull([
                        'message' => 'Please enter  date',
                    ]),
                ],
            ])
            ->add('date_fin', DateType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new NotNull([
                        'message' => 'Please enter date',
                    ]),
                ],
            ])
            ->add('nbr_participants')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
