// Função para buscar clientes e atualizar a tabela
function carregarClientes() {
    fetch('../php/listar_clientes.php')
        .then(response => response.json())
        .then(clientes => {
            let tabela = document.getElementById('tabela-clientes');
            tabela.innerHTML = ''; // Limpa a tabela antes de preencher

            clientes.forEach(cliente => {
                let row = `
                    <tr>
                        <td>${cliente.id}</td>
                        <td>${cliente.nome}</td>
                        <td>${cliente.email}</td>
                        <td>${cliente.telefone}</td>
                        <td>
                            <a href='../html/editar_cliente.html?id=${cliente.id}'>Editar</a> |
                            <a href='../php/excluir_cliente.php?id=${cliente.id}' onclick='return confirm("Tem certeza que deseja excluir este cliente?")'>Excluir</a>
                        </td>
                    </tr>
                `;
                tabela.innerHTML += row;
            });
        })
        .catch(error => console.error('Erro ao carregar clientes:', error));
}

// Carrega os clientes quando a página abre
document.addEventListener("DOMContentLoaded", carregarClientes);