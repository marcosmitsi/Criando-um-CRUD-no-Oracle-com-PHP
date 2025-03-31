document.addEventListener("DOMContentLoaded", function(){
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("id");

    if (!id) {
        alert("Erro: ID do cliente não encontrado.");
        return;
    }

    fetch("../php/buscar_cliente.php?id=" + id)
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById("id").value = id;
                document.getElementById("nome").value = data.NOME;
                document.getElementById("email").value = data.EMAIL;
                document.getElementById("telefone").value = data.TELEFONE;
            } else {
                alert("Erro ao carregar os dados do cliente.");
            }
        })
        .catch(error => console.error("Erro ao buscar cliente:", error));
});