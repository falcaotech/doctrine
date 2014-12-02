<?php

namespace JRP\Interfaces;

use Doctrine\ORM\EntityManager;

abstract class MapperAbstract implements MapperInterface {

    protected  $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

}