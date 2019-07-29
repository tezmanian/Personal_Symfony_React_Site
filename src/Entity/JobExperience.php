<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobExperienceRepository")
 */
class JobExperience
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"job"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"job"})
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"job"})
     */
    private $url;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JobExperienceRole", mappedBy="jobExperience", orphanRemoval=true)
     * @MaxDepth(1)
     * @Groups({"job"})
     * @ORM\OrderBy({"startDate" = "DESC"})
     */
    private $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|JobExperienceRole[]
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public static function createRole(): JobExperienceRole
    {
        return new JobExperienceRole();
    }

    public function addRole(JobExperienceRole $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
            $role->setJobExperience($this);
        }

        return $this;
    }

    public function removeRole(JobExperienceRole $role): self
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
            // set the owning side to null (unless already changed)
            if ($role->getJobExperience() === $this) {
                $role->setJobExperience(null);
            }
        }

        return $this;
    }
}
