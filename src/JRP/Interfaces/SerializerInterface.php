<?php

namespace JRP\Interfaces;


interface SerializerInterface {

    public function serialize(EntityInterface $entity);
    public function serializeAll(array $entitiesArray = array());

}