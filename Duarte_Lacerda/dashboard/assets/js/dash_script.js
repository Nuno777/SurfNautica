// Validate Name
$("#name").hide();
let nameError = true;
$("#inputname").keyup(function () {
    validateName();
});
function validateName() {
    let nameValue = $("#inputname").val().trim();
    let nameV = $("#inputname").val();
    var regex = /^[^\s].*$/;
    nameError = false;

    if (nameValue === '' || !regex.test(nameV)) {
        $("#name").show();
        $("#name").html("Nome inválido! Não pode estar vazio ou começar com espaço.");
        nameError = true;
        return false;
    } else if (nameValue.length < 3 || nameValue.length > 25) {
        $("#name").show();
        $("#name").html("Tamanho do nome deve ter entre 3 e 25 caracteres!");
        nameError = true;
        return false;
    } else {
        $("#name").hide();
        nameError = false;
        return true;
    }
}

// Validate Desc
$("#desc").hide();
let descError = true;
$("#inputdesc").keyup(function () {
    validateDesc();
});
function validateDesc() {
    let descValue = $("#inputdesc").val().trim();
    let descV = $("#inputdesc").val();
    var regex = /^[^\s].*$/;
    descError = false;

    if (descValue === '' || !regex.test(descV)) {
        $("#desc").show();
        $("#desc").html("Descrição inválida! Não pode estar vazia ou começar com espaço.");
        descError = true;
        return false;
    } else if (descValue.length < 3 || descValue.length > 250) {
        $("#desc").show();
        $("#desc").html("Tamanho da descrição deverá ter entre 3 e 250 caracteres!");
        descError = true;
        return false;
    } else {
        $("#desc").hide();
        descError = false;
        return true;
    }
}

// Validate Parceria
$("#partner").hide();
let partnerError = true;
$("#inputpartner").keyup(function () {
    validatePartner();
});
function validatePartner() {
    let partnerValue = $("#inputpartner").val();
    if (partnerValue === '') {
        $("#partner").show();
        partnerError = true;
        return false;
    } else {
        $("#partner").hide();
        partnerError = false;
        return true;
    }
}

// Validate Image
$("#img").hide();
let imgError = true;
$("#imputImg").keyup(function () {
    validateImg();
});
function validateImg() {
    let imgValue = $("#imputImg").val();
    if (imgValue === '') {
        $("#img").show();
        imgError = true;
        return false;
    } else {
        $("#img").hide();
        imgError = false;
        return true;
    }
}

// Submit button
$("#submitbtn").click(function () {
    let nameValid = validateName();
    let partnerValid = validatePartner();
    let descValid = validateDesc();
    let imgValid = validateImg();

    if (nameValid && partnerValid && descValid && imgValid) {
        return true;
    } else {
        return false;
    }
});
