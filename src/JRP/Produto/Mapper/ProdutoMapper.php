<?php

namespace JRP\Produto\Mapper;

use JRP\Interfaces\MapperAbstract;
use JRP\Produto\Entity\Produto;

class ProdutoMapper extends MapperAbstract {

    public function read($id = null)
    {
        $sql = "SELECT * FROM produtos";

        if(!is_null($id) && is_numeric($id))
        {
            $sql .= " WHERE id = {$id}";
        }

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll();
    }

    public function insert(Produto $produto)
    {
        $sql = "INSERT INTO produtos (nome, descricao, valor) VALUES (:nome, :descricao, :valor)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue("nome", $produto->getNome(), \PDO::PARAM_STR);
        $stmt->bindValue("descricao", $produto->getDescricao(), \PDO::PARAM_STR);
        $stmt->bindValue("valor", $produto->getValor(), \PDO::PARAM_STR);

        if($stmt->execute())
        {
            return $this->read($this->conn->lastInsertId());
        }

        return false;
    }

    public function update(Produto $produto)
    {
        $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, valor = :valor WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue("id", $produto->getId());
        $stmt->bindValue("nome", $produto->getNome(), \PDO::PARAM_STR);
        $stmt->bindValue("descricao", $produto->getDescricao(), \PDO::PARAM_STR);
        $stmt->bindValue("valor", $produto->getValor(), \PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function delete(Produto $produto)
    {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute(array($produto->getId()));
    }

    public function count($id = null)
    {
        return count($this->read($id));
    }

} 