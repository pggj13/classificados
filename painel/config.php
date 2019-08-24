<?php

require './environment.php';
$config = array();
global $config;

if (ENVIRONMENT == "prodution") {

    $config['dbname'] = "vendasonline";
    $config['host'] = "localhost";
    $config['dbuser'] = "root";
    $config['dbpass'] = "";
    
    
} else {
    $config['dbname'] = "u162389255_venda";
    $config['host'] = "mysql.hostinger.com.br";
    $config['dbuser'] = "u162389255_venda";
    $config['dbpass'] = "lau13061992";
}
$config['status_pgto'] = array(
    '1' => 'Aguardando pagamento',
    '2' => 'Aprovado',
    '3' => 'Cancelado'
);
