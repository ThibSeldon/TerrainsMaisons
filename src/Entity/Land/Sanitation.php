<?php

namespace App\Entity\Land;

use App\Repository\Land\SanitationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=SanitationRepository::class)
 */
class Sanitation
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Allotment::class, mappedBy="sanitation")
     */
    private $allotments;

    #[Pure] public function __construct()
    {
        $this->allotments = new ArrayCollection();
    }

    #[Pure] public function __toString(): string
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Allotment[]
     */
    public function getAllotments(): Collection
    {
        return $this->allotments;
    }

    public function addAllotment(Allotment $allotment): self
    {
        if (!$this->allotments->contains($allotment)) {
            $this->allotments[] = $allotment;
            $allotment->setSanitation($this);
        }

        return $this;
    }

    public function removeAllotment(Allotment $allotment): self
    {
        if ($this->allotments->removeElement($allotment)) {
            // set the owning side to null (unless already changed)
            if ($allotment->getSanitation() === $this) {
                $allotment->setSanitation(null);
            }
        }

        return $this;
    }
}
