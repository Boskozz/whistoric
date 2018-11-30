<?php

namespace App\Form;

use App\Entity\Partie;
use App\Entity\ContratConfig;
use App\Form\ApplicationType;
use App\Form\JoueurLocalType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PartieType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('totCarte', IntegerType::class, $this->getConfig("Nombre total de carté", "Nombre total de carté"))
            ->add('config', EntityType::class, [
                'class' => ContratConfig::class,
                'choice_label' => 'titre',
                'label' => 'Choisissez une configuration de valeur de contrats'
            ])
            ->add('joueurs', CollectionType::class, [
                'entry_type' => JoueurLocalType::class
            ])
            //->add('save', SubmitType::class, $this->getConfig("Commencez la partie !", ""))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partie::class,
        ]);
    }
}
