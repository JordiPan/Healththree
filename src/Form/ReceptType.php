<?php

namespace App\Form;

use App\Entity\Medicines;
use App\Entity\Recept;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReceptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datum')
            ->add('periode')
            ->add('medicijn', EntityType::class,
                [
                    'class' => Medicines::class,
                    'choice_label' => 'naam'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recept::class,
        ]);
    }
}
