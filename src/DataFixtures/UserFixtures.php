<?php

namespace App\DataFixtures;

use App\Entity\Avatar;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var Avatar $avatarBeardedMan */
        $avatarBeardedMan = $this->getReference('avatar-bearded-man');
        /** @var Avatar $avatarWomen1 */
        $avatarWomen1 = $this->getReference('avatar-women-1');

        $user1 = new User('01GTVM3TZQ5FQPYKDYR8D0Q7VD');
        $user1->setAvatar($avatarBeardedMan);
        $manager->persist($user1);

        $user2 = new User('01GTVM44PSQW5Y7D9K1EVTT2JK');
        $user2->setAvatar($avatarWomen1);
        $manager->persist($user2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AvatarFixtures::class,
        ];
    }
}
