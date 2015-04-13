<?php

namespace JRP\Produto\Mapper;

use JRP\Interfaces\MapperAbstract;
use JRP\Produto\Entity\Produto;

class ProdutoMapper extends MapperAbstract {

    public function read($id = null)
    {
        $repo = $this->em
                ->getRepository("JRP\Produto\Entity\Produto");
        
        return is_null($id) ? $repo->findAll() : $repo->find($id);
    }

    public function insert(Produto $produto)
    {
        try {
            $this->em->persist($produto);
            $this->em->flush();
        } catch(\Exception $error) {
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
        $this->em->persist($produto);
        $this->em->flush();

        return [
            'success' => true,
            'msg' => 'Produto atualizado com sucesso!'
        ];
    }    

    public function delete(Produto $produto)
    {
        $produto = $this->read($produto->getId());

        if(!$produto)
        {
            throw new \Exception("Produto ID: {$produto->getId()} não encontrado");
        }

        $this->em->remove($produto);
        $this->em->flush();

        return [
            'success' => true,
            'msg' => 'Produto excluído com sucesso!'
        ];
    }

} 