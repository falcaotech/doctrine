<?php

namespace JRP\Util;


trait MoneyFormatter {

    public function stringToMoney($data)
    {
        $valor = str_replace('.', '', $data);
        $valor = floatval(str_replace(',', '.', $valor));

        return $valor;
    }

}