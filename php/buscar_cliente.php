<?php
include_once 'connect/conexao.php'; // Conexão com Oracle

$id = $_GET['id'] ?? null; // Obtém o ID do cliente passado via URL

if (!$id) {
    die(json_encode(["erro" => "ID inválido."]));
}

// Busca os dados do cliente pelo ID
$sql = "SELECT nome, email, telefone FROM clientes WHERE id = :id";
$stmt = oci_parse($conn, $sql);
oci_bind_by_name($stmt, ":id", $id);
oci_execute($stmt);

$row = oci_fetch_assoc($stmt);

oci_free_statement($stmt);
oci_close($conn);

// Retorna os dados do cliente como JSON
header('Content-Type: application/json');
echo json_encode($row);
