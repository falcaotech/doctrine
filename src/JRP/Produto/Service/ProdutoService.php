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

    public function read($id = null)
    {
        return $this->produtoMapper->read($id);
    }

    public function insert(array $data = array())
    {
        $valor = str_replace('.', '', $data['valor']);
        $valor = floatval(str_replace(',', '.', $valor));

        $this->produto->setNome($data['nome']);
        $this->produto->setValor($valor);
        $this->produto->setDescricao($data['descricao']);

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

    public function delete($id)
    {
        $this->produto->setId((int) $id);

        return $this->produtoMapper->delete($this->produto);
    }

} 