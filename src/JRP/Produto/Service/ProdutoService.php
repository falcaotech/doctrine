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
        $valor = $data['valor'];
        $descricao = $data['descricao'];

        $this->produto->setNome($nome);
        $this->produto->setValor($valor);
        $this->produto->setDescricao($descricao);

        return $this->produtoMapper->insert($this->produto);
    }

} 