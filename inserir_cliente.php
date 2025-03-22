<?php

include_once "connect/conexao.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){ //Verifica se os dados foram enviados por um formulário via método POST.
    $nome = $_POST['nome']; //Obtém o valor do campo nome do formulário.
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql = " INSERT INTO clientes(nome, email, telefone) 
             VALUES (:nome, :email, :telefone)"; //São placeholders (valores dinâmicos que serão preenchidos depois). Isso impede ataques de SQL Injection.
    $stmt = oci_parse($conn, $sql); //Prepara a consulta SQL antes de ser executada.

    oci_bind_by_name($stmt, ":nome", $nome); //Substitui :nome pelo valor da variável $nome.
    oci_bind_by_name($stmt, ":email", $email);
    oci_bind_by_name($stmt, ":telefone", $telefone);

    $resultado = oci_execute($stmt); //Executa a consulta SQL no banco de dados.

    if($resultado){ //Verifica se a execução foi bem-sucedida.
        echo"Cliente foi cadastrado com sucesso";
    }else{
        $erro = oci_erro($stmt); //Caso contrário, captura e exibe o erro do Oracle.
        echo("Erro ao cadastrar"). $erro['message'];
    }
    oci_free_statement($stmt); // Libera a memória usada pelo comando SQL.
    oci_close($conn); //Fecha a conexão com o banco de dados.

}