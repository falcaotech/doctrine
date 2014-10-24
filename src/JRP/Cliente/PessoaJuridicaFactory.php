<?php

namespace JRP\Cliente;

class PessoaJuridicaFactory {

    public static function create($nome, $mail, $cnpj)
    {
        $cliente = new Cliente();

        $cliente->setNome($nome);
        $cliente->setMail($mail);
        $cliente->setCnpj($cnpj);

        return $cliente;
    }

} 