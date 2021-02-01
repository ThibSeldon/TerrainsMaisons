<?php

namespace App\EntityListener;

use App\Entity\Land\Allotment;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class AllotmentEntityListener
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Allotment $allotment, LifecycleEventArgs $event): void
    {
        $allotment->computeSlug($this->slugger);
    }

    public function preUpdate(Allotment $allotment, LifecycleEventArgs $event): void
    {
        $allotment->computeSlug($this->slugger);
    }

}
