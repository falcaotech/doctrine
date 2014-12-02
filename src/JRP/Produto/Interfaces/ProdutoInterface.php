<?php

namespace JRP\Produto\Interfaces;


interface ProdutoInterface {
    public function setId($id);
    public function setNome($nome);
    public function setDescricao($descricao);
    public function setValor($valor);
} 