<?php

namespace App\EntityListener;

use App\Entity\Matching\PlotHouseMatching;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class PlotHouseMatchingEntityListener
{
private SluggerInterface $slugger;

public function __construct(SluggerInterface $slugger)
{
$this->slugger = $slugger;
}

public function prePersist(PlotHouseMatching $plotHouseMatching, LifecycleEventArgs $event): void
{
$plotHouseMatching->computeSlug($this->slugger);
}

public function preUpdate(PlotHouseMatching $plotHouseMatching, LifecycleEventArgs $event): void
{
$plotHouseMatching->computeSlug($this->slugger);
}
}
