$(document).ready(function () {
  // Validate Data
  $("#data").hide();
  let dataError = true;
  $("#inputdata1").keyup(function () {
    validateData();
  });
  function validateData() {
    let dataValue = $("#inputdata1").val().trim();
    let dataV = $("#inputdata1").val();
    var regex = /^[^\s].*$/;
    dataError = false;

    if (dataValue === "" || !regex.test(dataV)) {
      $("#data").show();
      $("#data").html("Data inválida! Tem de escolher uma data.");
      dataError = true;
      return false;
    } else {
      $("#data").hide();
      dataError = false;
      return true;
    }
  }

  // Validate Titulo
  $("#titulo").hide();
  let tituloError = true;
  $("#inputtitulo").keyup(function () {
    validateTitulo();
  });
  function validateTitulo() {
    let tituloValue = $("#inputtitulo").val().trim();
    let tituloV = $("#inputtitulo").val();
    var regex = /^[^\s].*$/;
    tituloError = false;

    if (tituloValue === "" || !regex.test(tituloV)) {
      $("#titulo").show();
      $("#titulo").html(
        "Titulo inválido! Não pode estar vazio ou começar com espaço."
      );
      tituloError = true;
      return false;
    } else if (tituloValue.length < 3 || tituloValue.length > 50) {
      $("#titulo").show();
      $("#titulo").html("Tamanho do titulo deve ter entre 3 e 50 caracteres!");
      tituloError = true;
      return false;
    } else {
      $("#titulo").hide();
      tituloError = false;
      return true;
    }
  }

  // Validate Horas
  $("#horas").hide();
  let horasError = true;
  $("#inputhoras").keyup(function () {
    validateHoras();
  });
  function validateHoras() {
    let horasValue = $("#inputhoras").val().trim();
    let horasV = $("#inputhoras").val();
    var regex = /^[^\s].*$/;
    horasError = false;

    if (horasValue === "" || !regex.test(horasV)) {
      $("#horas").show();
      $("#horas").html(
        "Horas inválidas! Não pode estar vazio ou começar com espaço."
      );
      horasError = true;
      return false;
    } else if (horasValue.length < 3 || horasValue.length > 25) {
      $("#horas").show();
      $("#horas").html(
        "Tamanho do campo horas deve ter entre 3 e 25 caracteres!"
      );
      horasError = true;
      return false;
    } else {
      $("#horas").hide();
      horasError = false;
      return true;
    }
  }

  // Validate Professor
  $("#professor").hide();
  let professorError = true;
  $("#inputid_prof").keyup(function () {
    validateProf();
  });
  function validateProf() {
    let profValue = $("#inputid_prof").val().trim();
    let profV = $("#inputid_prof").val();
    var regex = /^[^\s].*$/;
    professorError = false;

    if (profValue === "" || !regex.test(profV)) {
      $("#professor").show();
      $("#professor").html(
        "Professor inválido! Não pode estar vazia ou começar com espaço."
      );
      professorError = true;
      return false;
    } else {
      $("#professor").hide();
      professorError = false;
      return true;
    }
  }

  // Submit button
  $("#submitbtn").click(function () {
    let dataValid = validateData();
    let tituloValid = validateTitulo();
    let horasValid = validateHoras();
    let profValid = validateProf();

    if (dataValid && tituloValid && horasValid && profValid) {
      return true;
    } else {
      return false;
    }
  });
});
