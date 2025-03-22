<?php

include_once 'connect/conexao.php';

$id = $_POST['id'];//Captura o ID do cliente.

//$_POST['nome'], $_POST['email'], $_POST['telefone'] → Capturam os novos valores.
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

//Atualiza os dados do cliente no banco.
$sql = "UPDATE clientes SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id";
$stmt = oci_parse($conn, $sql);
oci_bind_by_name($stmt, ":nome", $nome);// Substitui :nome pelo valor real da variável $nome.
oci_bind_by_name($stmt, ":email", $email);
oci_bind_by_name($stmt, ":telefone", $telefone);
oci_bind_by_name($stmt, ":id", $id);
oci_execute($stmt); //Executa a atualização.

header("Location: listar_clientes.php");//Redireciona para a página de listagem após atualizar o cliente.
exit; //Garante que o código pare de executar após o redirecionamento.

oci_free_statement($stmt);
oci_close($conn);