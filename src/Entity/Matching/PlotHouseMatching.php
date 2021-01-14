<?php

namespace App\Entity\Matching;

use App\Entity\House;
use App\Entity\Land\Plot;
use App\Repository\Matching\PlotHouseMatchingRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\String\Slugger\SluggerInterface;


/**
 * @ORM\Entity(repositoryClass=PlotHouseMatchingRepository::class)
 * @UniqueEntity("slug")
 * @ORM\HasLifecycleCallbacks
 */
class PlotHouseMatching
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
     * @ORM\Column(type="integer")
     */
    private $sellingPriceAti;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valid;

    /**
     * @ORM\ManyToOne(targetEntity=House::class, inversedBy="plotHouseMatchings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $house;

    /**
     * @ORM\ManyToOne(targetEntity=Plot::class, inversedBy="plotHouseMatchings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plot;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

public function __toString(): string
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

    public function getSellingPriceAti(): ?int
    {
        return $this->sellingPriceAti;
    }

    public function setSellingPriceAti(int $sellingPriceAti): self
    {
        $this->sellingPriceAti = $sellingPriceAti;

        return $this;
    }

    public function getValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): self
    {
        $this->valid = $valid;

        return $this;
    }

    public function getHouse(): ?House
    {
        return $this->house;
    }

    public function setHouse(?House $house): self
    {
        $this->house = $house;

        return $this;
    }

    public function getPlot(): ?Plot
    {
        return $this->plot;
    }

    public function setPlot(?Plot $plot): self
    {
        $this->plot = $plot;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     * @return $this
     */
    public function setCreatedAt(): self
    {
        $this->createdAt = new DateTime('now');

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @return $this
     */
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new DateTime('now');

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    //Mise a jour du slug
    public function computeSlug(SluggerInterface $slugger): void
    {
        if ($this->slug || '-' === $this->slug ){
            $this->slug = (string) $slugger->slug((string) $this)->lower();
        }
    }


}
