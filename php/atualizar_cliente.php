<?php

include_once 'connect/conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

$id = $_POST['id'];//Captura o ID do cliente.

//$_POST['nome'], $_POST['email'], $_POST['telefone'] → Capturam os novos valores.
$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$telefone = trim($_POST['telefone']);

 // Validações
 if (empty($id) || empty($nome) || empty($email) || empty($telefone)) {
    echo "Erro: Todos os campos são obrigatórios!";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Erro: E-mail inválido!";
    exit;
}

if (!preg_match('/^\d{10,11}$/', $telefone)) {
    echo "Erro: O telefone deve ter 10 ou 11 dígitos!";
    exit;
}

//Atualiza os dados do cliente no banco.
$sql = "UPDATE clientes SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id";
$stmt = oci_parse($conn, $sql);
oci_bind_by_name($stmt, ":nome", $nome);// Substitui :nome pelo valor real da variável $nome.
oci_bind_by_name($stmt, ":email", $email);
oci_bind_by_name($stmt, ":telefone", $telefone);
oci_bind_by_name($stmt, ":id", $id);
$resultado = oci_execute($stmt); //Executa a atualização.

if($resultado){
header("Location: listar_clientes.php?mensagem=atualizado");//Redireciona para a página de listagem após atualizar o cliente.
exit; //Garante que o código pare de executar após o redirecionamento.
}else{
    $erro = oci_error($stmt);
    header("Location: listar_clientes.php?mensagem=não foi possível Atualizar o Cliente !" .$erro['message']);//Redireciona para a página de listagem após atualizar o cliente.
exit; //Garante que o código pare de executar após o redirecionamento.

}
oci_free_statement($stmt);
oci_close($conn);
}