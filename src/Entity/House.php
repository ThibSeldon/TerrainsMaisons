<?php

namespace App\Entity;

use App\Entity\Admin\House\HouseBrand;
use App\Entity\Admin\House\HouseModel;
use App\Entity\Admin\House\HouseRoofing;

use App\Repository\HouseRepository;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=HouseRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("name")
 */
class House
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $livingSpace;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $annexSurface;

    /**
     * @ORM\Column(type="integer")
     */
    private $roomNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $bathroomNumber;

    /**
     * @ORM\Column(type="float")
     */
    private $sellingPriceDf;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $length;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $width;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $height;

    /**
     * @ORM\ManyToOne(targetEntity=HouseRoofing::class)
     */
    private $houseRoofing;

    /**
     * @ORM\ManyToOne(targetEntity=HouseBrand::class, inversedBy="houses")
     */
    private $houseBrand;

    /**
     * @ORM\ManyToOne(targetEntity=HouseModel::class)
     */
    private $houseModel;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $sellingPriceAti;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valid;




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

    public function getLivingSpace(): ?float
    {
        return $this->livingSpace;
    }

    public function setLivingSpace(float $livingSpace): self
    {
        $this->livingSpace = $livingSpace;

        return $this;
    }

    public function getAnnexSurface(): ?float
    {
        return $this->annexSurface;
    }

    public function setAnnexSurface(?float $annexSurface): self
    {
        $this->annexSurface = $annexSurface;

        return $this;
    }

    public function getRoomNumber(): ?int
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(int $roomNumber): self
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }

    public function getBathroomNumber(): ?int
    {
        return $this->bathroomNumber;
    }

    public function setBathroomNumber(int $bathroomNumber): self
    {
        $this->bathroomNumber = $bathroomNumber;

        return $this;
    }

    public function getSellingPriceDf(): ?float
    {
        return $this->sellingPriceDf;
    }

    public function setSellingPriceDf(float $sellingPriceDf): self
    {
        $this->sellingPriceDf = $sellingPriceDf;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     * @return $this
     * @throws Exception
     */
    public function setCreatedAt(): self
    {
        $dtz = new \DateTimeZone('Europe/Paris');
        $this->createdAt = new \DateTime('now', $dtz);

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PreUpdate
     * @return $this
     * @throws Exception
     */
    public function setUpdatedAt(): self
    {
        $dtz = new \DateTimeZone('Europe/Paris');
        $this->updatedAt = new \DateTime('now',$dtz);

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(?float $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(?float $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): self
    {
        $this->height = $height;

        return $this;
    }

    
    public function getHouseRoofing(): ?HouseRoofing
    {
        return $this->houseRoofing;
    }
    
    public function setHouseRoofing(?HouseRoofing $houseRoofing): self
    {
        $this->houseRoofing = $houseRoofing;
        
        return $this;
    }
    
    public function getHouseBrand(): ?HouseBrand
    {
        return $this->houseBrand;
    }
    
    public function setHouseBrand(?HouseBrand $houseBrand): self
    {
        $this->houseBrand = $houseBrand;
        
        return $this;
    }
    
    public function getHouseModel(): ?HouseModel
    {
        return $this->houseModel;
    }
    
    public function setHouseModel(?HouseModel $houseModel): self
    {
        $this->houseModel = $houseModel;
        
        return $this;
    }
        
    
    public function getSellingPriceAti(): ?float
    {
        return $this->sellingPriceAti;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @param float $data
     * @return House
     */
    public function setSellingPriceAti($data): self
    {
        if(isset($data))
        {

            $this->sellingPriceAti = $data;
            dump(gettype($data));
            return $this;
        }
        $this->sellingPriceAti = ceil($this->sellingPriceDf*1.2);
        
        return $this;
    }
    
/**
 * FONCTION PERSONNALISEES POUR RECHERCHE
 */
   

    public function getValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): self
    {
        $this->valid = $valid;

        return $this;
    }
    

    
    
}
