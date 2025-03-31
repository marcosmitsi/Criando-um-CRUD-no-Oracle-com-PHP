<?php

Include_once 'connect/conexao.php';

$id = $_GET['id']; //Captura o ID do cliente que foi passado na URL pelo link Excluir.

if(!isset($id)||empty($id)){ //Verifica se o ID foi enviado corretamente.
    echo "ID inválido!";
    exit;
}

$sql = "DELETE FROM clientes WHERE id = :id"; //emove o cliente com o ID correspondente.
$stmt = oci_parse($conn, $sql); //Prepara a consulta SQL.
oci_bind_by_name($stmt, ":id", $id); //Associa o parâmetro :id ao valor real do ID do cliente.
oci_execute($stmt); //Executa a exclusão do cliente.

header("Location: listar_clientes.php"); //edireciona para a página de listagem após excluir o cliente.
exit; //Garante que o código pare de executar após o redirecionamento.

oci_free_statement($stmt); //Libera a memória utilizada pela consulta.
oci_close($conn); //Fecha a conexão com o banco.


