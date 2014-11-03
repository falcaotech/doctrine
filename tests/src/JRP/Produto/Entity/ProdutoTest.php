<?php

namespace JRP\Produto\Entity;


class ProdutoTest extends \PHPUnit_Framework_TestCase {

    public function testVerificaEncapsulamentoSetId()
    {
        $produto = new Produto();
        $produto->setId(1);

        $this->assertEquals(1, $produto->getId());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSeMetodoSetIdRetornaExcecaoAoSetarValorNaoInteiro()
    {
        $produto = new Produto();
        $produto->setId('id');
    }

    public function testVerificaEncapsulamentoSetValor()
    {
        $produto = new Produto();
        $produto->setValor(100);

        $this->assertEquals(100, $produto->getValor());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testVerificaSeMetodoSetValorRetornaExcecaoAoSetarValorNaoNumerico()
    {
        $produto = new Produto();
        $produto->setValor('valor');
    }

    public function testVerificaEncapsulamentoSetNome()
    {
        $produto = new Produto();
        $produto->setNome('nome');

        $this->assertEquals('nome', $produto->getNome());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testVerificaSeMetodoSetNomeRetornaExcecaoAoSetarNomeVazio()
    {
        $produto = new Produto();
        $produto->setNome('');
    }

    public function testVerificaEncapsulamentoSetDescricao()
    {
        $produto = new Produto();
        $produto->setDescricao('descrição');

        $this->assertEquals('descrição', $produto->getDescricao());
    }

}