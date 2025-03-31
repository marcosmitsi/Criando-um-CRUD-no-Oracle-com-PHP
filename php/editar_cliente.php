<?php

include_once 'connect/conexao.php';// Inclui a conexão com o banco

$id = $_GET['id']; // Obtém o ID do cliente passado via URL quando clicamos em Editar na listagem.

// Busca os dados do cliente pelo ID
$sql = "SELECT nome, email, telefone FROM clientes WHERE id = :id";

$stmt = oci_parse($conn, $sql); //Prepara a consulta.
oci_bind_by_name($stmt, ":id", $id); //Substitui :id pelo valor real da variável $id.
oci_execute($stmt); // Executa a consulta.

// Obtém os dados do cliente
$row = oci_fetch_assoc($stmt); //Obtém os dados do cliente em um array associativo.
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
    <title>editar Clientes</title>
</head>

<body>
    <div class="container">
        <h2>Editar Clientes</h2>
        <form action="atualizar_cliente.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <!--/*Mantém o ID do cliente oculto no formulário.*/-->
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $row['NOME']; ?>" required><br>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $row['EMAIL']; ?>" required><br>
            <label>Telefone:</label>
            <input type="text" name="telefone" value="<?php echo $row['TELEFONE']; ?>" required><br>
            <input type="submit" value="Atualizar">
        </form>
    </div>
</body>

</html>

<?php
oci_free_statement($stmt); //Libera a memória utilizada pela consulta.
oci_close($conn); //Fecha a conexão com o banco.
?>