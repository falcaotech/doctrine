<?php

namespace JRP\Interfaces;

use Doctrine\ORM\EntityManager;

abstract class MapperAbstract implements MapperInterface {

    /**
     *
     * @var EntityManager
     */
    protected  $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

}