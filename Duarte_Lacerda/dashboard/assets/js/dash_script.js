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

// Validate Email
$("#email").hide();
let emailError = true;
$("#inputemail").keyup(function () {
    validateEmail();
});
function validateEmail() {
    let emailValue = $("#inputemail").val().trim();
    let emailV = $("#inputemail").val();
    var regex = /^[^\s].*$/;
    emailError = false;

    if (emailValue === '' || !regex.test(emailV)) {
        $("#email").show();
        $("#email").html("Email inválido! Não pode estar vazio ou começar com espaço.");
        emailError = true;
        return false;
    } else if (emailValue.length < 3 || emailValue.length > 25) {
        $("#email").show();
        $("#email").html("Tamanho do email deve ter entre 3 e 25 caracteres!");
        emailError = true;
        return false;
    } else {
        $("#email").hide();
        emailError = false;
        return true;
    }
}

// Validate Spec
$("#espec").hide();
let especError = true;
$("#inputspec").keyup(function () {
    validateEspec();
});
function validateEspec() {
    let especValue = $("#inputspec").val().trim();
    let especV = $("#inputspec").val();
    var regex = /^[^\s].*$/;
    especError = false;

    if (especValue === '' || !regex.test(especV)) {
        $("#espec").show();
        $("#espec").html("Especialidade inválida! Não pode estar vazio ou começar com espaço.");
        especError = true;
        return false;
    } else if (especValue.length < 3 || especValue.length > 25) {
        $("#espec").show();
        $("#espec").html("Tamanho da especialidade deve ter entre 3 e 25 caracteres!");
        especError = true;
        return false;
    } else {
        $("#espec").hide();
        especError = false;
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

// Validate User
$("#user").hide();
let userError = true;
$("#inputuser").keyup(function () {
    validateUser();
});
function validateUser() {
    let userValue = $("#inputuser").val();
    if (userValue == '') {
        $("#user").show();
        userError = true;
        return false;
    } else {
        $("#user").hide();
        userError = false;
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
    let emailValid = validateEmail();
    let especValid = validateEspec();
    let userValid = validateUser();

    if (nameValid && partnerValid && descValid && imgValid) {
        return true;
    } else if (nameValid && emailValid && especValid && userValid) {
        return true;
    } else {
        return false;
    }
});
