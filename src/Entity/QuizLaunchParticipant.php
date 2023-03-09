<?php

namespace App\Entity;

use App\Repository\QuizLaunchParticipantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizLaunchParticipantRepository::class)]
class QuizLaunchParticipant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'quizLaunchParticipants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?QuizLaunch $quizLaunch = null;

    #[ORM\Column(length: 255)]
    private ?string $participantStatus = null;

    #[ORM\Column]
    private ?int $currentScore = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getQuizLaunch(): ?QuizLaunch
    {
        return $this->quizLaunch;
    }

    public function setQuizLaunch(?QuizLaunch $quizLaunch): self
    {
        $this->quizLaunch = $quizLaunch;

        return $this;
    }

    public function getParticipantStatus(): ?string
    {
        return $this->participantStatus;
    }

    public function setParticipantStatus(string $participantStatus): self
    {
        $this->participantStatus = $participantStatus;

        return $this;
    }

    public function getCurrentScore(): ?int
    {
        return $this->currentScore;
    }

    public function setCurrentScore(int $currentScore): self
    {
        $this->currentScore = $currentScore;

        return $this;
    }
}
