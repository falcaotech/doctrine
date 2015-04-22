<?php

namespace JRP\Produto\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use JRP\Interfaces\EntityInterface;
use JRP\Produto\Interfaces\ProdutoInterface;
use Psr\Log\InvalidArgumentException;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="JRP\Produto\Entity\ProdutoRepository")
 * @ORM\Table(name="produtos")
 */

class Produto implements EntityInterface, ProdutoInterface {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nome;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descricao;
    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $valor;

    /**
     * @ORM\OneToOne(targetEntity="JRP\Produto\Entity\ProdutoCategoria")
     * @ORM\JoinColumn(name="produto_categoria", referencedColumnName="id")
     **/
    private $produto_categoria;

    /**
     * @ORM\ManyToMany(targetEntity="JRP\Produto\Entity\Tags")
     * @ORM\JoinTable(name="produtos_tags",
     *      joinColumns={@ORM\JoinColumn(name="produto_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

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

    /**
     * @return mixed
     */
    public function getProdutoCategoria()
    {
        return $this->produto_categoria;
    }

    /**
     * @param mixed $produto_categoria
     */
    public function setProdutoCategoria($produto_categoria)
    {
        $this->produto_categoria = $produto_categoria;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function addTag($tag)
    {
        $this->tags->add($tag);
    }

} 