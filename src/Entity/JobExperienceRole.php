<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobExperienceRoleRepository")
 */
class JobExperienceRole
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"jobRole"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"jobRole"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"jobRole"})
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     * @Groups({"jobRole"})
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"jobRole"})
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"jobRole"})
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\JobExperience", inversedBy="roles")
     * @ORM\JoinColumn(nullable=false)
     * @MaxDepth(1)
     */
    private $jobExperience;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getJobExperience(): ?JobExperience
    {
        return $this->jobExperience;
    }

    public function setJobExperience(?JobExperience $jobExperience): self
    {
        $this->jobExperience = $jobExperience;

        return $this;
    }
}
