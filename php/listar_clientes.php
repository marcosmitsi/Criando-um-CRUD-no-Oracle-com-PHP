<?php
header('Content-type: application/json');// Define o tipo de resposta como JSON
header('Access-Control-Allow-Origin: *'); // Libera acesso externo
include_once 'connect/conexao.php';// Inclui a conexão com o banco

$sql = "SELECT id, nome, email, telefone FROM clientes";// Define a consulta SQL para buscar todos os clientes
$stmt = oci_parse($conn, $sql);// Prepara a consulta SQL
oci_execute($stmt);// Executa a consulta SQL no banco

$clientes = [];
while ($row = oci_fetch_assoc($stmt)) {
    $clientes[] = [
        'id' => $row['ID'],
        'nome' => $row['NOME'],
        'email' => $row['EMAIL'],
        'telefone' => $row['TELEFONE']
    ];
}
oci_free_statement($stmt); // Libera a memória usada pela consulta
oci_close($conn); // Fecha a conexão com o banco
echo json_encode($clientes, JSON_UNESCAPED_UNICODE); // Retorna os dados no formato JSON