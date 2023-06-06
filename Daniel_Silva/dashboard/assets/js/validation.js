$(document).ready(function () {
    // Validações do lado do cliente
    $('form').submit(function (e) {
        e.preventDefault(); // Impede o envio do formulário
        var titulo = $('#name').val();
        var descricao = $('#inputdesc').val();
        var data = $('input[name="dateRange"]').val();
        var foto = $('#inputImg').val();

        if (titulo === '') {
            alert('Por favor, preencha o campo Título.');
            return;
        }

        if (descricao === '') {
            alert('Por favor, preencha o campo Descrição.');
            return;
        }

        // Verifica se o campo Título não excede 50 caracteres
        if (titulo.length > 50) {
            alert('O campo Título deve ter no máximo 50 caracteres.');
            return;
        }

        // Verifica se o campo Descrição não excede 250 caracteres
        if (descricao.length > 250) {
            alert('O campo Descrição deve ter no máximo 250 caracteres.');
            return;
        }

        if (foto === '') {
            alert('Por favor, selecione uma foto.');
            return;
        }

        // Verifica a extensão do arquivo selecionado
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        if (!allowedExtensions.exec(foto)) {
            alert('Formato de imagem inválido. Por favor, selecione uma imagem JPEG, PNG ou JPG.');
            return;
        }

        // Se todas as validações passarem, o formulário pode ser enviado
        $(this).unbind('submit').submit();
    });
});
