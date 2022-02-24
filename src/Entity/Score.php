<?php

namespace App\Entity;

use App\Repository\ScoreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScoreRepository::class)
 */
class Score
{
//    /**
//     * @ORM\Id
//     * @ORM\GeneratedValue
//     * @ORM\Column(type="integer")
//     */
//    private $id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="scores")
     * @ORM\JoinColumn(nullable=false, name="student_id", referencedColumnName="id")
     */
    private $StudentID;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity=Subject::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $SubjectID;

    /**
     * @ORM\Column(type="float")
     */
    private $Score;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentID(): ?int
    {
        return $this->StudentID;
    }

    public function setStudentID(?Student $StudentID): self
    {
        $this->StudentID = $StudentID;

        return $this;
    }

    public function getSubjectID(): ?int
    {
        return $this->SubjectID;
    }

    public function setSubjectID(Subject $SubjectID): self
    {
        $this->SubjectID = $SubjectID;

        return $this;
    }

    public function getScore(): ?float
    {
        return $this->Score;
    }

    public function setScore(float $Score): self
    {
        $this->Score = $Score;

        return $this;
    }
}
