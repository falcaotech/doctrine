<?php

namespace JRP\Produto\Entity;


use Psr\Log\InvalidArgumentException;

class Produto {
    private $id;
    private $nome;
    private $descricao;
    private $valor;

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        if(!is_int($id))
        {
            throw new InvalidArgumentException("O ID do produto deve ser numérico!");
        }

        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        if(empty($nome))
        {
            throw new InvalidArgumentException("O nome do produto não pode ser vazio!");
        }

        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     */
    public function setValor($valor)
    {
        if(!is_numeric($valor))
        {
            throw new InvalidArgumentException("O valor do produto deve ser numérico!");
        }

        $this->valor = $valor;
    }

} 