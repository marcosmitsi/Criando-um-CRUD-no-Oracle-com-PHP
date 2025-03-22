<?php
$usuario = 'system';
$senha ='243156';
$tns = "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=192.168.0.169)(PORT=1521)))(CONNECT_DATA=(SID=xe)))";

$conn = oci_connect($usuario, $senha, $tns);

if (!$conn){
    $erro = oci_error();
    die("Erro na conexão com o Oracle: ". $erro['message']);    
}else{
    echo"Conexão com o Oracle Bem sucedida";
}

oci_close($conn);
