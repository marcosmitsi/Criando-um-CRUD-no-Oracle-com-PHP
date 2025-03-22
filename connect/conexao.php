<?php
$usuario = 'system';
$senha = '243156';
$tns = "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=192.168.0.169)(PORT=1521)))(CONNECT_DATA=(SID=xe)))"; //Essa string contém as informações de conexão com o Oracle HOST=localhost → O banco está rodando localmente. PORT=1521 → A porta padrão do Oracle. SID=xe → O identificador do banco.
 
$conn = oci_connect($usuario,$senha,$tns); //Função do PHP para conectar ao Oracle. Ela recebe três parâmetros:  Nome de usuário / Senha / String de conexão

if(!$conn){ //Verifica se $conn é falso (ou seja, a conexão falhou).
    $erro = oci_error(); // Obtém a mensagem de erro do Oracle.
    die("Erro na Conexão com Oracle " .$erro['message']); //Exibe a mensagem de erro e encerra o script.
}