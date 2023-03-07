<?php

namespace App\Security\Voter;

use App\Entity\User;use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    const ROLE_GET_USER = 'ROLE_GET_USER';
    const ROLE_PUT_USER = 'ROLE_PUT_USER';

    protected function supports(string $attribute, mixed $subject): bool
    {
        if (!in_array($attribute, [self::ROLE_GET_USER, self::ROLE_PUT_USER])) {
            return false;
        }

        if (!$subject instanceof User) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return match($attribute) {
            self::ROLE_GET_USER, self::ROLE_PUT_USER => $subject->getId() === $user->getId(),
            default => throw new \LogicException('This code should not be reached!')
        };
    }
}