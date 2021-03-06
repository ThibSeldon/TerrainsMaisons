<?php

namespace App\Entity\Land;

use App\Entity\Matching\PlotHouseMatching;
use App\Repository\Land\PlotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlotRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Plot
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="plot_id", initialValue=1000)
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lot;

    /**
     * @ORM\Column(type="float")
     */
    private $surface;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $facadeWidth;

    /**
     * @ORM\Column(type="float")
     */
    private $sellingPriceAti;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Allotment::class, inversedBy="plots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $allotment;

    /**
     * @ORM\ManyToOne(targetEntity=State::class)
     */
    private ?State $state;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $salesPlan;

    /**
     * @ORM\OneToMany(targetEntity=PlotHouseMatching::class, mappedBy="plot", orphanRemoval=true)
     */
    private $plotHouseMatchings;

    public function __construct()
    {
        $this->plotHouseMatchings = new ArrayCollection();
    }




    public function __toString():string
    {
       return $this->getLot();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLot(): ?string
    {
        return $this->lot;
    }

    public function setLot(string $lot): self
    {
        $this->lot = $lot;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getFacadeWidth(): ?float
    {
        if(!$this->facadeWidth)
        {
            return $this->facadeWidth = 0;
        }
        return $this->facadeWidth;
    }

    public function setFacadeWidth(?float $facadeWidth): self
    {
        $this->facadeWidth = $facadeWidth;

        return $this;
    }

    public function getSellingPriceAti(): ?float
    {
        return $this->sellingPriceAti;
    }

    public function setSellingPriceAti(float $sellingPriceAti): self
    {
        $this->sellingPriceAti = $sellingPriceAti;

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
        $this->createdAt = new \DateTime('now');

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PreUpdate ()
     * @return $this
     */
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new \DateTime('now');

        return $this;
    }

    public function getAllotment(): ?Allotment
    {
        return $this->allotment;
    }

    public function setAllotment(?Allotment $allotment): self
    {
        $this->allotment = $allotment;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getSalesPlan(): ?string
    {
        return $this->salesPlan;
    }

    public function setSalesPlan(?string $salesPlan): self
    {
        $this->salesPlan = $salesPlan;

        return $this;
    }

    /**
     * @return Collection|PlotHouseMatching[]
     */
    public function getPlotHouseMatchings(): Collection
    {
        return $this->plotHouseMatchings;
    }

    public function addPlotHouseMatching(PlotHouseMatching $plotHouseMatching): self
    {
        if (!$this->plotHouseMatchings->contains($plotHouseMatching)) {
            $this->plotHouseMatchings[] = $plotHouseMatching;
            $plotHouseMatching->setPlot($this);
        }

        return $this;
    }

    public function removePlotHouseMatching(PlotHouseMatching $plotHouseMatching): self
    {
        if ($this->plotHouseMatchings->removeElement($plotHouseMatching)) {
            // set the owning side to null (unless already changed)
            if ($plotHouseMatching->getPlot() === $this) {
                $plotHouseMatching->setPlot(null);
            }
        }

        return $this;
    }


}
