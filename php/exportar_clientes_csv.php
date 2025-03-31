<?php

include_once "connect/conexao.php";

// Definir cabeçalhos HTTP para download do arquivo
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="clientes.csv"');
header('Pragma: no-cache');
header('Expires: 0');

// Criar um arquivo temporário na memória
$saida = fopen('php://output','w');


// Escrever o cabeçalho do CSV
fputcsv($saida, ['ID', 'Nome', 'E-mail', 'Telefone'], ',', '"', '"');

// Buscar os dados do banco
$sql = "SELECT * FROM clientes";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);

// Escreve cada linha no CSV
while($row = oci_fetch_assoc($stmt))
{
    fputcsv($saida, [$row['ID'], $row['NOME'], $row['EMAIL'], $row['TELEFONE']], ',', '"', '"');
}

//Fechar recursos
fclose($saida);
oci_free_statement($stmt);
oci_close($conn);