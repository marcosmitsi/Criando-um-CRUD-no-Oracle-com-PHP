<?php
include_once 'connect/conexao.php';// Inclui a conexão com o banco

$sql = "SELECT id, nome, email, telefone FROM clientes";// Define a consulta SQL para buscar todos os clientes
$stmt = oci_parse($conn, $sql);// Prepara a consulta SQL
oci_execute($stmt);// Executa a consulta SQL no banco
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Lista de Clientes</title>
</head>

<body>
    <?php
    if (isset($_GET['mensagem'])) {
        if ($_GET['mensagem'] == "sucesso") {
            echo "<p style='color: green;'>Cliente cadastrado com sucesso!</p>";
        } elseif ($_GET['mensagem'] == "atualizado") {
            echo "<p style='color: blue;'>Cliente atualizado com sucesso!</p>";
        } elseif ($_GET['mensagem'] == "excluido") {
            echo "<p style='color: red;'>Cliente excluído com sucesso!</p>";
        }
    }
    ?>
    <h2>Lista de Clientes</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
        <?php
        // Percorre os resultados e exibe cada cliente em uma linha da tabela
        while ($row = oci_fetch_assoc($stmt)) {//oci_fetch_assoc($stmt); → Retorna os resultados em um array associativo, onde cada coluna do banco vira uma chave do array.
            echo "<tr>";
            echo "<td>" . $row['ID'] . "</td>";// Exibe os dados do cliente dentro da tabela.
            echo "<td>" . $row['NOME'] . "</td>";
            echo "<td>" . $row['EMAIL'] . "</td>";
            echo "<td>" . $row['TELEFONE'] . "</td>";
            echo "<td>
                    <a href='editar_cliente.php?id=" . $row['ID'] . "'>Editar</a> |
                    <a href='excluir_cliente.php?id=" . $row['ID'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este cliente?\")'>Excluir</a>
                    
                 </td>";//Adiciona links para editar ou excluir o cliente.
                 //onclick="return confirm('Tem certeza que deseja excluir este cliente?');" Exibe uma caixa de confirmação antes de excluir o cliente. Se o usuário cancelar, a exclusão não ocorre.
            echo "</tr>";
        }
        ?>
    </table>
    <br><br>
    <a href='exportar_clientes_csv.php' class= 'botao'>Exportar para CSV</a> | <a href="exportar_clientes_pdf.php" class="botao">Exportar para PDF</a>
</body>

</html>
<?php
oci_free_statement($stmt); // Libera a memória usada pela consulta
oci_close($conn); // Fecha a conexão com o banco
?>