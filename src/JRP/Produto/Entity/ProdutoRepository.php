<?php

namespace JRP\Produto\Entity;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ProdutoRepository extends EntityRepository
{

    public function countProdutos()
    {
        $query = $this->createQueryBuilder("p")->getQuery()->getResult();

        return count($query);
    }

    public function getProdutos($page = 0, $limit = 5)
    {
        $query =  $this->createQueryBuilder("p")
                    ->orderBy('p.id', 'desc')
                    ->getQuery()
                    ->setFirstResult($page)
                    ->setMaxResults($limit);

        $results = new Paginator($query);
        $totalResults = count($results);

        return [
            'totalResults' => $totalResults,
            'currentPage' => $page,
            'totalPages' => ceil($totalResults / $limit),
            'results' => $results
        ];
    }

    public function searchByName($param, $page = 0, $limit = 5)
    {
        $dql = "SELECT p FROM JRP\Produto\Entity\Produto p WHERE p.nome LIKE :param";
        $query =  $this->getEntityManager()
                    ->createQuery($dql)
                    ->setParameter("param", "%{$param}%")
                    ->setFirstResult($page)
                    ->setMaxResults($limit);

        $results = new Paginator($query);
        $totalResults = count($results);

        return [
            'totalResults' => $totalResults,
            'currentPage' => $page,
            'totalPages' => ceil($totalResults / $limit),
            'results' => $results
        ];
    }

}