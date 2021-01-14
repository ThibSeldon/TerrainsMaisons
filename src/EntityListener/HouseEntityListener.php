<?php

namespace App\EntityListener;

use App\Entity\House;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class HouseEntityListener
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(House $house, LifecycleEventArgs $event): void
    {
        $house->computeSlug($this->slugger);
    }

    public function preUpdate(House $house, LifecycleEventArgs $event): void
    {
        $house->computeSlug($this->slugger);
    }

}
