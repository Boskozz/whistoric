<?php

namespace App\Form;

use App\Entity\Carte;
use App\Entity\JoueurLocal;
use App\Form\ContratConfigType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use App\Repository\JoueurLocalRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CarteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contrat', ChoiceType::class, [
                'choices' => [
                    'Contrat ?' => null,
                    'Emballage 8' => 'emb_8',
                    'Emballage 9' => 'emb_9',
                    'Emballage 10' => 'emb_10',
                    'Emballage 11' => 'emb_11',
                    'Emballage 12' => 'emb_12',
                    'Solo 6' => 'solo_6',
                    'Solo 7' => 'solo_7',
                    'Solo 8' => 'solo_8',
                    'Petite Misère' => 'pmis_',
                    'Picolissimo' => 'picoli_',
                    'Picolo' => 'picolo_',
                    'Abondance 9' => 'abon_9',
                    'Abondance 10' => 'abon_10',
                    'Abondance 11' => 'abon_11',
                    'Abondance sur table 9' => 'abonst_9',
                    'Abondance sur table 10' => 'abonst_10',
                    'Abondance sur table 11' => 'abonst_11',
                    'Grande Misère' => 'gm_is',
                    'Grande Misère sur trou' => 'gm_st',
                    'Grande Misère sur table' => 'gm_sta',
                    'Grande Misère sur trou sur table' => 'gm_stt',
                    'Trou' => 'trou_',
                    'Capot' => 'capot_',
                    'Chelem' => 'ptsm_',
                    'Solo chelem' => 'gdsm_'
                ]
            ])
            ->add('partants', EntityType::class, [
                'class' => JoueurLocal::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'label' => 'joueur(s)',
                'query_builder' => function (JoueurLocalRepository $er) use ($options) {
                    return $er->findByPartiePlayer($options['partieId']);
                },
            ])
            ->add('estGagnant', CheckboxType::class, array(
                'label'    => 'Gagné ?',
                'required' => false,
                'attr' => [
                    'checked' => true
                ],
                'data' => true
                ))
            ->add('brin', CheckboxType::class, array(
                'label'    => 'Brin ?',
                'required' => false,
                ))
            ->add('accompagne', CheckboxType::class, array(
                'label'    => 'Accompagné ?',
                'required' => false,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Carte::class,
            'partieId' => null
        ]);
    }
}
