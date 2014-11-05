<?php

/*
 * Alterar os parâmetros para conexão no arquivo boostrap.php
 */

require 'bootstrap.php';

$dbh = $db->getConn();
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

$sql = file_get_contents('data.sql');

try {
    $stmt = $dbh->prepare($sql);

    if(!$stmt->execute())
    {
        echo "Erro ao executar fixtures.\r\nPor favor, cheque os parâmetros de conexão!\r\n";
    }

    echo "Fixtures executadas com sucesso!\r\n";
} catch (PDOException $e)
{
    exit("Erro ao executar fixtures: {$e->getMessage()}");
}