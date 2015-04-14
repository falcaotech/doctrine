<?php


namespace JRP\Produto\Serializer;


use JRP\Interfaces\EntityInterface;
use JRP\Interfaces\SerializerInterface;

class ProdutoSerializer implements SerializerInterface {

    public function serialize(EntityInterface $entity)
    {
        return [
            'id' => $entity->getId(),
            'nome' => $entity->getNome(),
            'descricao' => $entity->getDescricao(),
            'valor' => $entity->getValor()
        ];
    }

    public function serializeAll(array $entitiesArray = array())
    {
        $data = [];

        foreach($entitiesArray as $entity)
        {
            array_push($data, [
                'id' => $entity->getId(),
                'nome' => $entity->getNome(),
                'descricao' => $entity->getDescricao(),
                'valor' => $entity->getValor()
            ]);
        }

        return $data;
    }

}