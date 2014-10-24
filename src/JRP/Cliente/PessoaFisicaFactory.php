<?php

namespace JRP\Cliente;

class PessoaFisicaFactory {

    public static function create($nome, $mail, $cpf)
    {
        $cliente = new Cliente();

        $cliente->setNome($nome);
        $cliente->setMail($mail);
        $cliente->setCpf($cpf);

        return $cliente;
    }

} 