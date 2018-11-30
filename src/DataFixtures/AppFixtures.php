<?php

namespace App\DataFixtures;

use App\Entity\ContratConfig;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $contrat = new ContratConfig();
        $contrat->setEmb8Pos(7)
                ->setEmb8Neg(10)
                ->setEmb9Pos(10)
                ->setEmb9Neg(13)
                ->setEmb10Pos(13)
                ->setEmb10Neg(16)
                ->setEmb11Pos(16)
                ->setEmb11Neg(19)
                ->setEmb12Pos(19)
                ->setEmb12Neg(22)
                // Solo
                ->setSolo6Pos(12)
                ->setSolo6Neg(15)
                ->setSolo7Pos(15)
                ->setSolo7Neg(18)
                ->setSolo8Pos(18)
                ->setSolo8Neg(21)
                // Petit misère, picolissimo, picolo
                ->setPmisPos(24)
                ->setPmisNeg(27)
                ->setPicoliPos(21)
                ->setPicoliNeg(24)
                ->setPicoloPos(27)
                ->setPicoloNeg(30)
                // Abondance
                ->setAbon9Pos(33)
                ->setAbon9Neg(39)
                ->setAbon10Pos(42)
                ->setAbon10Neg(51)
                ->setAbon11Pos(60)
                ->setAbon11Neg(72)
                // Abondance sur table
                ->setAbonst9Pos(33)
                ->setAbonst9Neg(39)
                ->setAbonst10Pos(42)
                ->setAbonst10Neg(51)
                ->setAbonst11Pos(60)
                ->setAbonst11Neg(72)
                // Grande misère
                ->setGmisPos(36)
                ->setGmisNeg(42)
                ->setGmstPos(48)
                ->setGmstNeg(54)
                ->setGmstaPos(48)
                ->setGmstaNeg(54)
                ->setGmsttPos(48)
                ->setGmsttNeg(54)
                // Le reste
                ->setCapot(30)
                ->setTrou(16)
                ->setGdsm(60)
                ->setPtsm(54)
                
        ;
        $contrat->setTitre('Nico');
        $manager->persist($contrat);
        $manager->flush();
    }
}
