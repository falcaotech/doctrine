<?php

namespace JRP\Produto\Mapper;

use JRP\Interfaces\MapperAbstract;
use JRP\Produto\Entity\Produto;
use SebastianBergmann\Exporter\Exception;

class ProdutoMapper extends MapperAbstract {

    public function read($id = null)
    {
        $sql = "SELECT * FROM produtos" . (!is_null($id) ? " WHERE id = :id" : "");
        $stmt = $this->em->getConnection()->prepare($sql);

        if(!is_null($id))
        {
            $stmt->bindValue("id", $id, \PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert(Produto $produto)
    {
        try {
            $this->em->persist($produto);
            $this->em->flush();
        } catch(Exception $error) {
            return [
                'success' => false,
                'msg' => 'Erro ao inserir produto!'
            ];
        }

        return [
            'success' => true,
            'msg' => 'Produto inserido com sucesso!',
            'produto' => [
                'id' => $produto->getId()
            ]
        ];
    }

    public function update(Produto $produto)
    {
        if(!$this->count($produto->getId()))
        {
            throw new Exception("Produto não encontrado!");
        }

        $this->em->getConnection()->update('produtos', [
            'nome' => $produto->getNome(),
            'descricao' => $produto->getDescricao(),
            'valor' => $produto->getValor()
        ], ['id' => $produto->getId()]);

        return [
            'success' => true,
            'msg' => 'Produto atualizado com sucesso!'
        ];
    }

    public function updateColumn(array $data = array())
    {
        $id = $data['id'];
        $column = $data['column'];
        $value = $data['value'];

        $update = $this->em->getConnection()->update('produtos', [
            $column => $value
        ], ['id' => $id]);

        if(!$update)
        {
            return ['success' => false];
        }

        return ['success' => true];
    }

    public function delete(Produto $produto)
    {
        $produto = $this->em->find(get_class($produto), $produto->getId());

        if(is_null($produto))
        {
            throw new Exception("Nenhum produto encontrado com esse Id!");
        }

        $this->em->remove($produto);
        $this->em->flush();

        return [
            'success' => true,
            'msg' => 'Produto excluído com sucesso!'
        ];
    }

    public function count($id = null)
    {
        return count($this->read($id));
    }

} 