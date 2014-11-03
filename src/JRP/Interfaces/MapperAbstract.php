<?php

namespace JRP\Interfaces;


use Aura\Di\Container;

abstract class MapperAbstract implements MapperInterface {

    protected $conn;

    public function __construct(Container $diC)
    {
        $this->setConn($diC->get('db.conn'));
    }

    private function setConn(\PDO $pdo)
    {
        $this->conn = $pdo;
    }

}