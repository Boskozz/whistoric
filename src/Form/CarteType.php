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
                    'Emballage 8' => 'emb8',
                    'Emballage 9' => 'emb9',
                    'Emballage 10' => 'emb10',
                    'Emballage 11' => 'emb11',
                    'Emballage 12' => 'emb12',
                    'Solo 6' => 'solo6',
                    'Solo 7' => 'solo7',
                    'Solo 8' => 'solo8',
                    'Petite Misère' => 'pmis',
                    'Picolissimo' => 'picoli',
                    'Picolo' => 'picolo',
                    'Abondance 9' => 'abon9',
                    'Abondance 10' => 'abon10',
                    'Abondance 11' => 'abon11',
                    'Abondance sur table 9' => 'abonst9',
                    'Abondance sur table 10' => 'abonst10',
                    'Abondance sur table 11' => 'abonst11',
                    'Grande Misère' => 'gmis',
                    'Grande Misère sur trou' => 'gmst',
                    'Grande Misère sur table' => 'gmsta',
                    'Grande Misère sur trou sur table' => 'gmstt',
                    'Trou' => 'trou',
                    'Capot' => 'capot',
                    'Chelem' => 'ptsm',
                    'Solo chelem' => 'gdsm'
                ]
            ])
            ->add('partants', EntityType::class, [
                'class' => JoueurLocal::class,
                'choice_label' => 'nom',
                'multiple' => true,
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
