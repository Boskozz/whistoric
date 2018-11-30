<?php

namespace App\Form;

use App\Entity\ContratConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ContratEnJeuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('emb8Pos', CheckboxType::class, [
                'label' => 'Emballage 8',
                'required' => false
            ])
            ->add('emb9Pos')
            ->add('emb10Pos')
            ->add('emb11Pos')
            ->add('emb12Pos')
            ->add('solo6Pos')
            ->add('solo7Pos')
            ->add('solo8Pos')
            ->add('pmisPos')
            ->add('picoliPos')
            ->add('picoloPos')
            ->add('abon9Pos')
            ->add('abon10Pos')
            ->add('abon11Pos')
            ->add('abonst9Pos')
            ->add('abonst10Pos')
            ->add('abonst11Pos')
            ->add('gmisPos')
            ->add('gmstPos')
            ->add('gmstaPos')
            ->add('gmsttPos')
            ->add('trou')
            ->add('capot')
            ->add('ptsm')
            ->add('gdsm')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContratConfig::class,
        ]);
    }
}
