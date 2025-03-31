<?php

include_once "connect/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Verifica se os dados foram enviados por um formulário via método POST.
    $nome = trim($_POST['nome']); //Obtém o valor do campo nome do formulário. Remove espaços extras no início e fim do texto.
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);

    // Validações
    if (empty($nome) || empty($email) || empty($telefone)) //Verifica se todos os campos estão preenchidos.
    {
        echo "Erro: Todos os campos são obrigatórios!";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) //Valida se o e-mail tem um formato correto.
    {
        echo "Erro: E-mail inválido!";
        exit;

    }

    if (!preg_match('/^\d{10,11}$/', $telefone)) //Confirma que o telefone tem apenas números e 10 ou 11 dígitos.
    {
        echo ("Erro: O telefone deve ter 10 ou 11 dígitos!");
        exit;
    }



    $sql = " INSERT INTO clientes(nome, email, telefone) 
             VALUES (:nome, :email, :telefone)"; //São placeholders (valores dinâmicos que serão preenchidos depois). Isso impede ataques de SQL Injection.
    $stmt = oci_parse($conn, $sql); //Prepara a consulta SQL antes de ser executada.

    oci_bind_by_name($stmt, ":nome", $nome); //Substitui :nome pelo valor da variável $nome.
    oci_bind_by_name($stmt, ":email", $email);
    oci_bind_by_name($stmt, ":telefone", $telefone);

    $resultado = oci_execute($stmt); //Executa a consulta SQL no banco de dados.

    if ($resultado) { //Verifica se a execução foi bem-sucedida.

        header("Location: listar_clientes.php?mensagem=Sucesso");
        exit;
    } else {
        $erro = oci_erro($stmt); //Caso contrário, captura e exibe o erro do Oracle.
        header("Location: cadastro.html?mensagem=Erro ao cadastrar" . $erro['message']);
        exit;
    }
    oci_free_statement($stmt); // Libera a memória usada pelo comando SQL.
    oci_close($conn); //Fecha a conexão com o banco de dados.

}