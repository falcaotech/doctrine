<?php

namespace JRP\Produto\Service;

use JRP\Produto\Entity\Produto;
use JRP\Produto\Mapper\ProdutoMapper;

class ProdutoService {

    private $produtoMapper;
    private $produto;

    public function __construct(ProdutoMapper $produtoMapper, Produto $produto)
    {
        $this->produtoMapper = $produtoMapper;
        $this->produto = $produto;
    }

    public function count($id = null)
    {
        return $this->produtoMapper->count($id);
    }

    public function read($id = null)
    {
        return $this->produtoMapper->read($id);
    }

    public function insert(array $data = array())
    {
        $nome = $data['nome'];
        $valor = str_replace('.', '', $data['valor']);
        $valor = floatval(str_replace(',', '.', $valor));
        $descricao = $data['descricao'];

        $this->produto->setNome($nome);
        $this->produto->setValor($valor);
        $this->produto->setDescricao($descricao);

        return $this->produtoMapper->insert($this->produto);
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

        return $this->produtoMapper->update($this->produto);
    }

    public function updateColumn(array $data = array())
    {
        $params = [
            'id' => $data['pk'],
            'column' => $data['name'],
            'value' => $data['value']
        ];

        return $this->produtoMapper->updateColumn($params);
    }

    public function delete($id)
    {
        $id = (int) $id;

        $this->produto->setId($id);

        return $this->produtoMapper->delete($this->produto);
    }

} 