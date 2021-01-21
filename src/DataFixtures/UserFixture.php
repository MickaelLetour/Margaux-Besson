<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager) // permet de creer un utilisateur dans la table user en base de donnée et de hash le passwprd
    {
        $user = new User();
        $user->setUsername('pseudo');
        $user->setPassword($this->encoder->encodePassword($user, 'password'));
        $manager->persist($user);
        $manager->flush();
    }
}
