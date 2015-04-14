<?php

namespace JRP\Produto\Service;

use Doctrine\ORM\EntityManager;
use JRP\Produto\Entity\Produto;

class ProdutoService {

    private $produto;

    public function __construct(EntityManager $em, Produto $produto)
    {
        $this->em = $em;
        $this->produto = $produto;
    }

    public function read($id = null)
    {
        $repo = $this->em->getRepository("JRP\Produto\Entity\Produto");

        return is_null($id) ? $repo->findAll() : $repo->find($id);
    }

    public function insert(array $data = array())
    {
        $valor = str_replace('.', '', $data['valor']);
        $valor = floatval(str_replace(',', '.', $valor));

        $this->produto->setNome($data['nome']);
        $this->produto->setValor($valor);
        $this->produto->setDescricao($data['descricao']);

        try {
            $this->em->persist($this->produto);
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
                'id' => $this->produto->getId()
            ]
        ];
    }

    public function update(array $data = array())
    {
        $id = (int) $data['id'];
        $nome = $data['nome'];
        $valor = floatval(str_replace(',', '.', $data['valor']));
        $descricao = $data['descricao'];

        $this->produto->setId($id);
        $this->produto->setNome($nome);
        $this->produto->setValor($valor);
        $this->produto->setDescricao($descricao);

        $this->em->persist($this->produto);
        $this->em->flush();

        return [
            'success' => true,
            'msg' => 'Produto atualizado com sucesso!'
        ];
    }

    public function delete($id)
    {
        $this->produto->setId((int) $id);

        $produto = $this->read($this->produto->getId());

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