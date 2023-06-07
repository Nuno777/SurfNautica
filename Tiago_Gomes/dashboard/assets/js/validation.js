$(document).ready(function () {
    // Validações do lado do cliente
    $('form').submit(function (e) {
        e.preventDefault(); // Impede o envio do formulário
        var titulo = $('#inputtitulo').val();
        /* $("#data1").val($.format.date(new Date(), 'YYYY-MM-DD'));    */     
        var data = $('input[name="dateRange"]').val();
        var horas = $('#inputhoras').val();
        var prof = $('#inputid_prof').val();

        if (titulo === '') {
            alert('Por favor, preencha o campo do Título.');
            return;
        }

      /*   if (data1 === '') {
            alert('Por favor, preencha o campo da Data.');
            return;
        } */
        if (horas === '') {
            alert('Por favor, preencha o campo das horas.');
            return;
        }

        // Verifica se o campo Título não excede 50 caracteres
        if (titulo.length > 50) {
            alert('O campo Título deve ter no máximo 50 caracteres.');
            return;
        }
        if (prof === '') {
            alert('Por favor, selecione uma prof.');
            return;
        }

        // Se todas as validações passarem, o formulário pode ser enviado
        $(this).unbind('submit').submit();
    });
});

