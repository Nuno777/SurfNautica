// Função para validar o formulário
function validateForm(event) {
    event.preventDefault(); // Impede o envio do formulário

    // Limpa as mensagens de erro
    document.getElementById('nameError').innerHTML = "";
    document.getElementById('descError').innerHTML = "";
    document.getElementById('imgError').innerHTML = "";

    // Obtém os valores dos campos
    var title = document.getElementById('inputname').value.trim();
    var description = document.getElementById('inputdesc').value.trim();
    var image = document.getElementById('inputImg').value.trim();

    // Validação do campo "titulo"
    if (title === "") {
        document.getElementById('nameError').innerHTML = "O campo título é obrigatório";
        return; // Sai da função em caso de erro
    } else if (title.length < 3) {
        document.getElementById('nameError').innerHTML = "O campo título deve ter pelo menos 3 caracteres";
        return; // Sai da função em caso de erro
    } else if (title.length > 50) {
        document.getElementById('nameError').innerHTML = "O campo título deve ter no máximo 50 caracteres";
        return; // Sai da função em caso de erro
    }

    // Validação do campo "descrição"
    if (description === "") {
        document.getElementById('descError').innerHTML = "O campo descrição é obrigatório";
        return; // Sai da função em caso de erro
    } else if (description.length < 10) {
        document.getElementById('descError').innerHTML = "O campo descrição deve ter pelo menos 10 caracteres";
        return; // Sai da função em caso de erro
    } else if (description.length > 500) {
        document.getElementById('descError').innerHTML = "O campo descrição deve ter no máximo 500 caracteres";
        return; // Sai da função em caso de erro
    }

    // Validação do campo "foto"
    if (image === "") {
        document.getElementById('imgError').innerHTML = "O campo foto é obrigatório";
        return; // Sai da função em caso de erro
    }

    // Verifica a extensão do arquivo
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if (!allowedExtensions.exec(image)) {
        document.getElementById('imgError').innerHTML = "Apenas arquivos JPEG, PNG e JPG são permitidos";
        return; // Sai da função em caso de erro
    }

    // Envie o formulário se todas as validações passarem
    document.getElementById('myForm').submit();
}

// Vincula o evento de envio do formulário à função de validação
document.getElementById('myForm').addEventListener('submit', validateForm);
