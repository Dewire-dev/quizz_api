<?php

namespace App\DataFixtures;

use App\Entity\Avatar;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpFoundation\File\File;

class AvatarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $codesAvatars = [
            'bearded-man',
            'boy',
            'gamer-man',
            'women-1',
            'women-2',
            'women-3',
            'man-1',
            'man-2',
            'man-3',
            'man-4',
        ];

        foreach ($codesAvatars as $code) {
            $avatar = new Avatar();
            $avatar->setCode($code);
            $manager->persist($avatar);
            $this->setReference('avatar-' . $code, $avatar);
        }

        $manager->flush();
    }
}
