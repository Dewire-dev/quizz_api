<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\State\Processor\PostUserStateProcessor;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Ulid;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            security: 'is_granted(\'ROLE_GET_USER\', object)'
        ),
        new Post(
            denormalizationContext: ['groups' => ['user:post']],
            processor: PostUserStateProcessor::class,
        ),
        new Put(
            denormalizationContext: ['groups' => ['user:put']],
            security: 'is_granted(\'ROLE_PUT_USER\', object)'
        ),
    ],
    normalizationContext: ['groups' => ['user:item:get']],
)]
#[UniqueEntity('ulid')]
class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('user:item:get')]
    private ?int $id = null;

    #[ORM\Column(length: 26, unique: true)]
    #[Groups(['user:item:get', 'user:post'])]
    private ?string $ulid = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['user:item:get', 'user:post', 'user:put'])]
    private ?Avatar $avatar = null;

    public function __construct(string $ulid = null)
    {
        $this->ulid = $ulid ?? new Ulid();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUlid(): ?string
    {
        return $this->ulid;
    }

    public function setUlid(string $ulid): self
    {
        $this->ulid = $ulid;

        return $this;
    }

    public function getAvatar(): ?Avatar
    {
        return $this->avatar;
    }

    public function setAvatar(?Avatar $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials()
    {
        return;
    }

    public function getUserIdentifier(): string
    {
        return $this->ulid;
    }
}
