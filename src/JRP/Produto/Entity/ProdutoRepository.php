<?php

namespace JRP\Produto\Entity;


use Doctrine\ORM\EntityRepository;

class ProdutoRepository extends EntityRepository
{

    public function getProdutosOrdenados()
    {
        return $this->createQueryBuilder("p")
                    ->orderBy('p.nome', 'asc')
                    ->getQuery()
                    ->getResult();
    }

    public function getProdutosDesc()
    {
        $dql = "SELECT p FROM JRP\Produto\Entity\Produto p
        ORDER BY p.nome DESC";

        return $this->getEntityManager()
                    ->createQuery($dql)
                    ->getResult();
    }

}