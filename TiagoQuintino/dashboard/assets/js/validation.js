// Validate Name
$("#name").hide();
let nameError = true;
$("#inputname").keyup(function () {
    validateName();
});
function validateName() {
    let nameValue = $("#inputname").val();
    do
        if (nameValue.length == "") {
            $("#name").show();
            nameError = true;
            return false;
        } else if (nameValue.length < 3 || nameValue.length > 25) {
            $("#name").show();
            $("#name").html("Tamanho do nome deverá ter entre 3 e 25 caracteres!");
            nameError = true;
            return false;
        } else {
            $("#name").hide();
            nameError = false;
        }
    while (nameError == true) {

    }
}

// Validate Desc
$("#desc").hide();
let descError = true;
$("#inputdesc").keyup(function () {
    validateDesc();
});
function validateDesc() {
    let descValue = $("#inputdesc").val();
    do
        if (descValue.length == "") {
            $("#desc").show();
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
        }
    while (descError == true) {

    }
}

//Validate Parceria
$("#partner").hide();
let partnererror = true;
$("#inputpartner").keyup(function () {
    validatePartner();
});
function validatePartner() {
    let partnerValue = $("#inputpartner").val();
    if (partnerValue == "") {
        $("#partner").show();
        partnererror = true;
        return true;
    }
    else {
        $("#partner").hide();
        partnererror = false;
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
    if (imgValue == "") {
        $("#img").show();
        imgError = true;
        return true;
    } else {
        $("#img").hide();
        imgError = false;
    }
};

// Submit button
$("#submitbtn").click(function () {
    validateName();
    validatePartner();
    validateDesc();
    validateImg();
    if (
        nameError == true &&
        partnerError == true &&
        descError == true &&
        imgError == true
    ) {
        return true;
    } else {
        return false;
    }
});