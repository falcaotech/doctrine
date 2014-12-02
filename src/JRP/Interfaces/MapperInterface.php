<?php

namespace JRP\Interfaces;

use Doctrine\ORM\EntityManager;

interface MapperInterface {

    public function __construct(EntityManager $em);

} 