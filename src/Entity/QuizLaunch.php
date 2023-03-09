<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\QuizLaunchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizLaunchRepository::class)]
#[ApiResource]
class QuizLaunch
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
    private ?Quiz $quiz = null;

    #[ORM\OneToMany(mappedBy: 'quizLaunch', targetEntity: QuizLaunchParticipant::class)]
    private Collection $quizLaunchParticipants;

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
        $this->quizLaunchParticipants = new ArrayCollection();
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

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): self
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * @return Collection<int, QuizLaunchParticipant>
     */
    public function getQuizLaunchParticipants(): Collection
    {
        return $this->quizLaunchParticipants;
    }

    public function addQuizLaunchParticipant(QuizLaunchParticipant $quizLaunchParticipant): self
    {
        if (!$this->quizLaunchParticipants->contains($quizLaunchParticipant)) {
            $this->quizLaunchParticipants->add($quizLaunchParticipant);
            $quizLaunchParticipant->setQuizLaunch($this);
        }

        return $this;
    }

    public function removeQuizLaunchParticipant(QuizLaunchParticipant $quizLaunchParticipant): self
    {
        if ($this->quizLaunchParticipants->removeElement($quizLaunchParticipant)) {
            // set the owning side to null (unless already changed)
            if ($quizLaunchParticipant->getQuizLaunch() === $this) {
                $quizLaunchParticipant->setQuizLaunch(null);
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
