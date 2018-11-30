<?php

namespace App\Form;

use App\Entity\ContratConfig;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ContratConfigType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, $this->getConfig("Titre de la configuration", "Choisissez un titre"))
            ->add('emb8Pos', IntegerType::class, $this->getConfig("Emballage 8 +", "Indiquez la valeur positive d'un Emballage 8"))
            ->add('emb8Neg', IntegerType::class, $this->getConfig("Emballage 8 -", "Indiquez la valeur négative d'un Emballage 8"))
            ->add('emb9Pos', IntegerType::class, $this->getConfig("Emballage 9 +", "Indiquez la valeur positive d'un Emballage 9"))
            ->add('emb9Neg', IntegerType::class, $this->getConfig("Emballage 9 -", "Indiquez la valeur négative d'un Emballage 9"))
            ->add('emb10Pos', IntegerType::class, $this->getConfig("Emballage 10 +", "Indiquez la valeur positive d'un Emballage 10"))
            ->add('emb10Neg', IntegerType::class, $this->getConfig("Emballage 10 -", "Indiquez la valeur négative d'un Emballage 10"))
            ->add('emb11Pos', IntegerType::class, $this->getConfig("Emballage 11 +", "Indiquez la valeur positive d'un Emballage 11"))
            ->add('emb11Neg', IntegerType::class, $this->getConfig("Emballage 11 -", "Indiquez la valeur négative d'un Emballage 11"))
            ->add('emb12Pos', IntegerType::class, $this->getConfig("Emballage 12 +", "Indiquez la valeur positive d'un Emballage 12"))
            ->add('emb12Neg', IntegerType::class, $this->getConfig("Emballage 12 -", "Indiquez la valeur négative d'un Emballage 12"))
            ->add('solo6Pos', IntegerType::class, $this->getConfig("Solo 6 +", "Indiquez la valeur positive d'un Solo 6"))
            ->add('solo6Neg', IntegerType::class, $this->getConfig("Solo 6 -", "Indiquez la valeur négative d'un Solo 6"))
            ->add('solo7Pos', IntegerType::class, $this->getConfig("Solo 7 +", "Indiquez la valeur positive d'un Solo 7"))
            ->add('solo7Neg', IntegerType::class, $this->getConfig("Solo 7 -", "Indiquez la valeur négative d'un Solo 7"))
            ->add('solo8Pos', IntegerType::class, $this->getConfig("Solo 8 +", "Indiquez la valeur positive d'un Solo 8"))
            ->add('solo8Neg', IntegerType::class, $this->getConfig("Solo 8 -", "Indiquez la valeur négative d'un Solo 8"))
            ->add('pmisPos', IntegerType::class, $this->getConfig("Petite misère +", "Indiquez la valeur positive d'une petite misère"))
            ->add('pmisNeg', IntegerType::class, $this->getConfig("Petite misère -", "Indiquez la valeur négative d'une petite misère"))
            ->add('picoliPos', IntegerType::class, $this->getConfig("Picolissimo +", "Indiquez la valeur positive d'un picolissimo"))
            ->add('picoliNeg', IntegerType::class, $this->getConfig("picolissimo -", "Indiquez la valeur négative d'un picolissimo"))
            ->add('picoloPos', IntegerType::class, $this->getConfig("Picolo +", "Indiquez la valeur positive d'un picolo"))
            ->add('picoloNeg', IntegerType::class, $this->getConfig("Picolo -", "Indiquez la valeur négative d'un picolo"))
            ->add('abon9Pos', IntegerType::class, $this->getConfig("Abondance 9 +", "Indiquez la valeur positive d'une abondance 9"))
            ->add('abon9Neg', IntegerType::class, $this->getConfig("Abondance 9 -", "Indiquez la valeur négative d'une abondance 9"))
            ->add('abon10Pos', IntegerType::class, $this->getConfig("Abondance 10 +", "Indiquez la valeur positive d'une abondance 10"))
            ->add('abon10Neg', IntegerType::class, $this->getConfig("Abondance 10 -", "Indiquez la valeur négative d'une abondance 10"))
            ->add('abon11Pos', IntegerType::class, $this->getConfig("Abondance 11 +", "Indiquez la valeur positive d'une abondance 11"))
            ->add('abon11Neg', IntegerType::class, $this->getConfig("Abondance 11 -", "Indiquez la valeur négative d'une abondance 11"))
            ->add('abonst9Pos', IntegerType::class, $this->getConfig("Abondance sur table 9 +", "Indiquez la valeur positive d'une abondance sur table 9"))
            ->add('abonst9Neg', IntegerType::class, $this->getConfig("Abondance sur table 9 -", "Indiquez la valeur négative d'une abondance sur table 9"))
            ->add('abonst10Pos', IntegerType::class, $this->getConfig("Abondance sur table 10 +", "Indiquez la valeur positive d'une abondance sur table 10"))
            ->add('abonst10Neg', IntegerType::class, $this->getConfig("Abondance sur table 10 -", "Indiquez la valeur négative d'une abondance sur table 10"))
            ->add('abonst11Pos', IntegerType::class, $this->getConfig("Abondance sur table 12 +", "Indiquez la valeur positive d'une abondance sur table 11"))
            ->add('abonst11Neg', IntegerType::class, $this->getConfig("Abondance sur table 12 -", "Indiquez la valeur négative d'une abondance sur table 11"))
            ->add('gmisPos', IntegerType::class, $this->getConfig("Grande misère +", "Indiquez la valeur positive d'une grande misère"))
            ->add('gmisNeg', IntegerType::class, $this->getConfig("Grande misère -", "Indiquez la valeur négative d'une grande misère"))
            ->add('gmstPos', IntegerType::class, $this->getConfig("Grande misère sur trou +", "Indiquez la valeur positive d'une grande misère sur trou"))
            ->add('gmstNeg', IntegerType::class, $this->getConfig("Grande misère sur trou -", "Indiquez la valeur négative d'une grande misère sur trou"))
            ->add('gmstaPos', IntegerType::class, $this->getConfig("Grande misère sur table +", "Indiquez la valeur positive d'une grande misère sur table"))
            ->add('gmstaNeg', IntegerType::class, $this->getConfig("Grande misère sur table -", "Indiquez la valeur négative d'une grande misère sur table"))
            ->add('gmsttPos', IntegerType::class, $this->getConfig("Grande misère sur trou sur table +", "Indiquez la valeur positive d'une grande misère sur trou sur table"))
            ->add('gmsttNeg', IntegerType::class, $this->getConfig("Grande misère sur trou sur table -", "Indiquez la valeur négative d'une grande misère sur trou sur table"))
            ->add('trou', IntegerType::class, $this->getConfig("Trou", "Indiquez la valeur d'un trou"))
            ->add('capot', IntegerType::class, $this->getConfig("Capot", "Indiquez la valeur d'un capot"))
            ->add('ptsm', IntegerType::class, $this->getConfig("Chelem", "Indiquez la valeur d'un chelem"))
            ->add('gdsm', IntegerType::class, $this->getConfig("Solo chelem", "Indiquez la valeur d'un solo chelem"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContratConfig::class,
        ]);
    }
}
