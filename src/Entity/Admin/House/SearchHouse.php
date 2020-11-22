<?php

namespace App\Entity\Admin\House;

use App\Entity\Admin\House\HouseBrand;
use App\Entity\Admin\House\HouseModel;
use App\Entity\Admin\House\HouseRoofing;

use App\Repository\HouseRepository;


class SearchHouse
{

    private $name;


    private $livingSpace;


    private $annexSurface;

    private $roomNumber;

   
    private $bathroomNumber;


    private $sellingPriceDf;

    private $createdAt;

    private $updatedAt;


    private $length;


    private $width;


    private $height;

    private $houseRoofing;


    private $houseBrand;

    private $houseModel;

    private $sellingPriceAti;

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
           

/**
 * FONCTION PERSONNALISEES POUR RECHERCHE
 */

    private $searchSellingPriceAti;


    public function getSearchSellingPriceAti(): ?float
    {
        return $this->searchSellingPriceAti;
    }
    public function setSearchSellingPriceAti(?float $searchSellingPriceAti): self
    {
        $this->searchSellingPriceAti = $searchSellingPriceAti;
        
        return $this;
    }
    
    

    /**
     * Get the value of valid
     */ 
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * Set the value of valid
     *
     * @return  self
     */ 
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }
}
