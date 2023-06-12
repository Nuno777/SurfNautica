$(document).ready(function () {
    // Validações do lado do cliente
    $('form').submit(function (e) {
        e.preventDefault(); // Impede o envio do formulário
        var titulo = $('#inputtitulo').val();
        var data = $('input[name="dateRange"]').val();
        var horas = $('#inputhoras').val();
        var prof = $('#inputid_prof').val();

        if (titulo === '') {
            alert('Por favor, preencha o campo do Título.');
            return;
        }

        /* if (data1 === '') {
            alert('Por favor, preencha o campo da Data.');
            return;
        } */
        if (horas === '') {
            alert('Por favor, preencha o campo das horas.');
            return;
        }

        // Verifica se o campo Título tem entre 3 e 25 caracteres
        if (titulo.length < 3 || titulo.length > 25) {
            alert('O campo Título deve ter entre 3 e 25 caracteres.');
            return;
        }

        // Verifica se o campo horas tem entre 3 e 25 caracteres
        if (horas.length < 3 || horas.length > 25) {
            alert('O campo Horas deve ter entre 3 e 25 caracteres.');
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


