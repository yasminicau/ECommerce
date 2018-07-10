<?php

$server = 'localhost' ;
$usuario = 'root';
$senhaUsuario ='' ;
$nameBD ='Ecommerce' ;

$connect =mysqli_connect($server, $usuario, $senhaUsuario, $nameBD) or
        die('Não foi possivel conectar'. mysqli_error($connect));


