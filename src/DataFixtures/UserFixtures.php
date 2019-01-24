<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setPrenom('Jean-Sébastien')
            ->setNom('Wuilbaut')
            ->setEmail('jesewu@gmail.com')
            ->setHash($this->encoder->encodePassword($user, '|>R$010NEly'))
            ->setRoles(['ROLE_ADMIN']);
        $user1 = new User();
        $user1
            ->setPrenom('Nicolas')
            ->setNom('Bruyère')
            ->setEmail('leduc0808@gmail.com')
            ->setHash($this->encoder->encodePassword($user1, 'laconic..'))
            ->setRoles(['ROLE_USER']);
        $user2 = new User();
        $user2
            ->setPrenom('Florence')
            ->setNom('Marcq')
            ->setEmail('florencemarcq1969@gmail.com')
            ->setHash($this->encoder->encodePassword($user2, 'floflo..'))
            ->setRoles(['ROLE_USER']);
        $manager->persist($user);
        $manager->persist($user1);
        $manager->persist($user2);

        $manager->flush();
    }
}
