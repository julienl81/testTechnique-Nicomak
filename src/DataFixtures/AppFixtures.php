<?php

namespace App\DataFixtures;

use App\Entity\Thanks;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}

    public function load(ObjectManager $manager): void
    {
        $names = ['Myriam', 'Geoffroy', 'Laura', 'Céline', 'Alice', 'Laétitia'];

        foreach ($names as $name) {

            $user = new User();
            $avatar = $name . '.PNG';

            $plaintextPassword = 'password';
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );

            $user
                ->setName($name)
                ->setPassword($hashedPassword)
                ->setAvatar($avatar);

            $users[] = $user;
            $manager->persist($user);
        }

        for ($i = 0; $i < 30; $i++) {

            $thanks = new Thanks();
            $fromWho = $users[array_rand($users)];
            $toWho = $users[array_rand($users)];
            $message = 'Merci pour tout !';
            $createdAt = new \DateTimeImmutable();
            $updatedAt = new \DateTimeImmutable();

            $thanks
                ->setFromWho($fromWho)
                ->setToWho($toWho)
                ->setMessage($message)
                ->setCreatedAt($createdAt)
                ->setUpdatedAt($updatedAt);

            $manager->persist($thanks);
        }


        $manager->flush();
    }
}
