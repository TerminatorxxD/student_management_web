<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FullName;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DoB;

    /**
     * @ORM\OneToMany(targetEntity=Score::class, mappedBy="StudentID")
     */
    private $scores;

    /**
     * @ORM\ManyToOne(targetEntity=Major::class, inversedBy="students")
     * @ORM\JoinColumn(nullable=false)
     */
    private $MajorID;

    public function __construct()
    {
        $this->scores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->FullName;
    }

    public function setFullName(string $FullName): self
    {
        $this->FullName = $FullName;

        return $this;
    }

    public function getDoB(): ?\DateTimeInterface
    {
        return $this->DoB;
    }

    public function setDoB(?\DateTimeInterface $DoB): self
    {
        $this->DoB = $DoB;

        return $this;
    }

    /**
     * @return Collection<int, Score>
     */
    public function getScores(): Collection
    {
        return $this->scores;
    }

    public function addScore(Score $score): self
    {
        if (!$this->scores->contains($score)) {
            $this->scores[] = $score;
            $score->setStudentID($this);
        }

        return $this;
    }

    public function removeScore(Score $score): self
    {
        if ($this->scores->removeElement($score)) {
            // set the owning side to null (unless already changed)
            if ($score->getStudentID() === $this) {
                $score->setStudentID(null);
            }
        }

        return $this;
    }

    public function getMajorID(): ?Major
    {
        return $this->MajorID;
    }

    public function setMajorID(?Major $MajorID): self
    {
        $this->MajorID = $MajorID;

        return $this;
    }



}
