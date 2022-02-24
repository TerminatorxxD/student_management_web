<?php

namespace App\Entity;

use App\Repository\MajorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MajorRepository::class)
 */
class Major
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
    private $MajorName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Batch;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="MajorID")
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity=Subject::class, mappedBy="MajorID")
     */
    private $subjects;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->subjects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMajorName(): ?string
    {
        return $this->MajorName;
    }

    public function setMajorName(string $MajorName): self
    {
        $this->MajorName = $MajorName;

        return $this;
    }

    public function getBatch(): ?string
    {
        return $this->Batch;
    }

    public function setBatch(?string $Batch): self
    {
        $this->Batch = $Batch;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setMajorID($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getMajorID() === $this) {
                $student->setMajorID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Subject>
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    public function addSubject(Subject $subject): self
    {
        if (!$this->subjects->contains($subject)) {
            $this->subjects[] = $subject;
            $subject->setMajorID($this);
        }

        return $this;
    }

    public function removeSubject(Subject $subject): self
    {
        if ($this->subjects->removeElement($subject)) {
            // set the owning side to null (unless already changed)
            if ($subject->getMajorID() === $this) {
                $subject->setMajorID(null);
            }
        }

        return $this;
    }
}
