<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\QuizzLaunchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizzLaunchRepository::class)]
#[ApiResource]
class QuizzLaunch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 26)]
    private ?string $ulid = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $launcher = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Quizz $quizz = null;

    #[ORM\OneToMany(mappedBy: 'quizzLaunch', targetEntity: QuizzLaunchParticipant::class)]
    private Collection $quizzLaunchParticipants;

    #[ORM\ManyToOne]
    private ?Question $currentQuestion = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $startAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $endAt = null;

    public function __construct()
    {
        $this->quizzLaunchParticipants = new ArrayCollection();
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

    public function getLauncher(): ?User
    {
        return $this->launcher;
    }

    public function setLauncher(?User $launcher): self
    {
        $this->launcher = $launcher;

        return $this;
    }

    public function getQuizz(): ?Quizz
    {
        return $this->quizz;
    }

    public function setQuizz(?Quizz $quizz): self
    {
        $this->quizz = $quizz;

        return $this;
    }

    /**
     * @return Collection<int, QuizzLaunchParticipant>
     */
    public function getQuizzLaunchParticipants(): Collection
    {
        return $this->quizzLaunchParticipants;
    }

    public function addQuizzLaunchParticipant(QuizzLaunchParticipant $quizzLaunchParticipant): self
    {
        if (!$this->quizzLaunchParticipants->contains($quizzLaunchParticipant)) {
            $this->quizzLaunchParticipants->add($quizzLaunchParticipant);
            $quizzLaunchParticipant->setQuizzLaunch($this);
        }

        return $this;
    }

    public function removeQuizzLaunchParticipant(QuizzLaunchParticipant $quizzLaunchParticipant): self
    {
        if ($this->quizzLaunchParticipants->removeElement($quizzLaunchParticipant)) {
            // set the owning side to null (unless already changed)
            if ($quizzLaunchParticipant->getQuizzLaunch() === $this) {
                $quizzLaunchParticipant->setQuizzLaunch(null);
            }
        }

        return $this;
    }

    public function getCurrentQuestion(): ?Question
    {
        return $this->currentQuestion;
    }

    public function setCurrentQuestion(?Question $currentQuestion): self
    {
        $this->currentQuestion = $currentQuestion;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeImmutable $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeImmutable $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }
}
