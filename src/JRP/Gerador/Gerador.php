<?php

namespace JRP\Gerador;

use Faker\Factory;
use JRP\Cliente\PessoaFisicaFactory;
use JRP\Cliente\PessoaJuridicaFactory;
use Psr\Log\InvalidArgumentException;

class Gerador {

    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create("pt_BR");

        $this->clientes();
    }

    function mod($dividendo,$divisor)
 	{
 	 	return round($dividendo - (floor($dividendo/$divisor)*$divisor));
 	}

	function cpf($comPontos = true)
	{
	 	$n1 = rand(0,9);
 	 	$n2 = rand(0,9);
	 	$n3 = rand(0,9);
 	 	$n4 = rand(0,9);
 	 	$n5 = rand(0,9);
	 	$n6 = rand(0,9);
	 	$n7 = rand(0,9);
	 	$n8 = rand(0,9);
	 	$n9 = rand(0,9);
	 	$d1 = $n9*2+$n8*3+$n7*4+$n6*5+$n5*6+$n4*7+$n3*8+$n2*9+$n1*10;
	 	$d1 = 11 - ($this->mod($d1,11) );

 	 	if ( $d1 >= 10 )
	 	{
            $d1 = 0;
	 	}

	 	$d2 = $d1*2+$n9*3+$n8*4+$n7*5+$n6*6+$n5*7+$n4*8+$n3*9+$n2*10+$n1*11;
	 	$d2 = 11 - ($this->mod($d2,11) );

	   	if ($d2>=10) { $d2 = 0 ;}
	 	 	$retorno = '';
	 	if ($comPontos) {
            $retorno = ''.$n1.$n2.$n3.".".$n4.$n5.$n6.".".$n7.$n8.$n9."-".$d1.$d2;
        }
 	 	else {
            $retorno = ''.$n1.$n2.$n3.$n4.$n5.$n6.$n7.$n8.$n9.$d1.$d2;
        }

	 	return $retorno;
	 }

 	function cnpj($comPontos = true)
 	{
 	 	$n1 = rand(0,9);
 	 	$n2 = rand(0,9);
 	 	$n3 = rand(0,9);
 	 	$n4 = rand(0,9);
 	 	$n5 = rand(0,9);
 	 	$n6 = rand(0,9);
 	 	$n7 = rand(0,9);
 	 	$n8 = rand(0,9);
 	 	$n9 = 0;
 	 	$n10= 0;
 	 	$n11= 0;
 	 	$n12= 1;
 	 	$d1 = $n12*2+$n11*3+$n10*4+$n9*5+$n8*6+$n7*7+$n6*8+$n5*9+$n4*2+$n3*3+$n2*4+$n1*5;
 	 	$d1 = 11 - ($this->mod($d1,11));

 	 	if ($d1 >= 10)
 	 	{
            $d1 = 0 ;
 	 	}

 	 	$d2 = $d1*2+$n12*3+$n11*4+$n10*5+$n9*6+$n8*7+$n7*8+$n6*9+$n5*2+$n4*3+$n3*4+$n2*5+$n1*6;
 	 	$d2 = 11 - ($this->mod($d2,11));

 	 	if ($d2>=10) {
            $d2 = 0;
        }

 	 	$retorno = '';

	 	if ($comPontos) {
            $retorno = ''.$n1.$n2.".".$n3.$n4.$n5.".".$n6.$n7.$n8."/".$n9.$n10.$n11.$n12."-".$d1.$d2;
        } else {
            $retorno = ''.$n1.$n2.$n3.$n4.$n5.$n6.$n7.$n8.$n9.$n10.$n11.$n12.$d1.$d2;
        }

 	 	return $retorno;
 	}

    public function clientes($quantidade = 50)
    {
        if(!is_int($quantidade) || $quantidade == 0)
        {
            throw new InvalidArgumentException("A quantidade deve ser um valor inteiro e maior que zero!");
        }

        $clientes = [];

        for($i = 0; $i < $quantidade; $i++)
        {
            $nome = $this->faker->name;
            $mail = $this->faker->email;
            $cpf = $this->cpf();
            $cnpj = $this->cnpj();

            if(rand(0, 1))
            {
                $cliente = PessoaFisicaFactory::create($nome, $mail, $cpf);
            } else {
                $cliente = PessoaJuridicaFactory::create($nome, $mail, $cnpj);
            }

            array_push($clientes, $cliente);
        }

        return $clientes;
    }

} 