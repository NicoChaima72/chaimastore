const SERVER_URL = "http://localhost/php/chaimastore/";

obtenerRegiones();


$('#formRegistrar').submit(function (e) { 
  e.preventDefault();
  alert("REGISTRADO CON EXITO");
});

$("#btnRegistrar").click(function(e) {
  let validar = validarFormulario();
  if (!validar) {
    e.preventDefault();
  }
});

$('#cmbRegion').change(function (e) { 
  e.preventDefault();
  obtenerProvincias($(this).val());
});

$('#cmbProvincia').change(function (e) { 
  e.preventDefault();
  obtenerComunas($(this).val());
});


function validarFormulario() {
  if (validarRequerido() && validarEmail() && validarRut() && validarSelects() && confirmarEmail() && confirmarPassword()) {
    return true;
  } else{
    mostrarErrorPrincipal("Verifique los campos", 1);
  }
  return false;
}

function obtenerRegiones() {
  $.ajax({
    type: "POST",
    url: `${SERVER_URL}ajax/usuarioAjax.php`,
    data: {accion: 'obtener_regiones'},
    dataType: "json",
    success: function (res) {
      if (!res.error) {
        rellenarSelect('#cmbRegion', res.data);
      } else {
        mostrarErrorPrincipal(res.error);
      }
    },
    error: function() {
      mostrarErrorPrincipal("Ha ocurrido un error, intenta más tarde");
    }
  });
}

function obtenerProvincias(region) {
  $.ajax({
    type: "POST",
    url: `${SERVER_URL}ajax/usuarioAjax.php`,
    data: {accion: 'obtener_provincias', region},
    dataType: "json",
    success: function (res) {
      if (!res.error) {
        rellenarSelect('#cmbProvincia', res.data);
      } else {
        mostrarErrorPrincipal(res.error);
      }
    },
    error: function() {
      mostrarErrorPrincipal("Ha ocurrido un error, intenta más tarde");
    }
  });
}

function obtenerComunas(provincia) {
  $.ajax({
    type: "POST",
    url: `${SERVER_URL}ajax/usuarioAjax.php`,
    data: {accion: 'obtener_comunas', provincia},
    dataType: "json",
    success: function (res) {
      if (!res.error) {
        rellenarSelect('#cmbComuna', res.data);
      } else {
        mostrarErrorPrincipal(res.error);
      }
    },
    error: function() {
      mostrarErrorPrincipal("Ha ocurrido un error, intenta más tarde");
    }
  });
}

function confirmarEmail() {
  let estado = false;
  if ($('#txtEmail').val() == $('#txtConfirmarEmail').val()) {
    estado = true;
  } else {
    setTimeout(() => {
      $('#txtEmail').addClass('input-error');
      $('#txtConfirmarEmail').addClass('input-error');
      $('#txtEmail').removeClass('mb-md-4');
      $('#txtConfirmarEmail').removeClass('mb-md-4');
      $('#txtEmail').addClass('mb-md-0');
      $('#txtConfirmarEmail').addClass('mb-md-0');
      $('#errorConfirmarEmail').text("El email no coincide");
      setTimeout(() => {
        $('#txtEmail').removeClass('input-error');
        $('#txtConfirmarEmail').removeClass('input-error');
        $('#txtEmail').addClass('mb-md-4');
        $('#txtConfirmarEmail').addClass('mb-md-4');
        $('#txtEmail').removeClass('mb-md-0');
        $('#txtConfirmarEmail').removeClass('mb-md-0');
        $(`#errorConfirmarEmail`).text("");
      }, 7000);
    }, 200);
  }
  return estado;
}

function confirmarPassword() {
  let estado = false;
  if ($('#txtPassword').val() == $('#txtConfirmarPassword').val()) {
    estado = true;
  } else {
    setTimeout(() => {
      $('#txtPassword').addClass('input-error');
      $('#txtConfirmarPassword').addClass('input-error');
      $('#txtPassword').removeClass('mb-md-4');
      $('#txtConfirmarPassword').removeClass('mb-md-4');
      $('#txtPassword').addClass('mb-md-0');
      $('#txtConfirmarPassword').addClass('mb-md-0');
      $('#errorConfirmarPassword').text("La contraseña no coincide");
      setTimeout(() => {
        $('#txtPassword').removeClass('input-error');
        $('#txtConfirmarPassword').removeClass('input-error');
        $('#txtPassword').addClass('mb-md-4');
        $('#txtConfirmarPassword').addClass('mb-md-4');
        $('#txtPassword').removeClass('mb-md-0');
        $('#txtConfirmarPassword').removeClass('mb-md-0');
        $(`#errorConfirmarPassword`).text("");
      }, 7000);
    }, 200);
  }
  return estado;
}

function validarRut() {
  let sinErrores = true;
  $(".solo-rut").each(function(e) {
    let valor = $(this)
      .val()
      .replace(".", "");
    valor = valor.replace("-", "");
    cuerpo = valor.slice(0, -1);
    dv = valor.slice(-1).toUpperCase();
    suma = 0;
    multiplo = 2;
    for (i = 1; i <= cuerpo.length; i++) {
      index = multiplo * valor.charAt(cuerpo.length - i);
      suma = suma + index;
      if (multiplo < 7) {
        multiplo = multiplo + 1;
      } else {
        multiplo = 2;
      }
    }
    dvEsperado = 11 - (suma % 11);
    dv = dv == "K" ? 10 : dv;
    dv = dv == 0 ? 11 : dv;
    if (dvEsperado != dv || cuerpo.length < 7) {
      sinErrores = false;
      let id = $(this).attr('id');
      id = id.replace('txt', 'error');
      setTimeout(() => {
        $(this).addClass('input-error');
        $(this).removeClass('mb-md-4');
        $(this).addClass('mb-md-0');
        $(`#${id}`).text("Rut invalido");
        setTimeout(() => {
          $(this).removeClass('input-error');
          $(this).addClass('mb-md-4');
          $(this).removeClass('mb-md-0');
          $(`#${id}`).text("");
        }, 7000);
      }, 200);
    }
  });
  return sinErrores;
}

function validarSelects() {
  let sinErrores = true;
  $('select').each(function(e) {
    if (!$(this).val()) {
      sinErrores = false;
      setTimeout(() => {
        $(this).addClass('input-error');
        setTimeout(() => {
          $(this).removeClass('input-error');
        }, 7000);
      }, 200);
    }
  });
  return sinErrores;
}

function validarRequerido() {
  let sinErrores = true;
  $(".campo-requerido").each(function(e) {
    if ($(this).val().length == 0) {
      sinErrores = false;
      let id = $(this).attr('id');
      id = id.replace('txt', 'error');
      setTimeout(() => {
        $(this).addClass('input-error');
        $(this).removeClass('mb-md-4');
        $(this).addClass('mb-md-0');
        $(`#${id}`).text("Campo requerido");
        setTimeout(() => {
          $(this).removeClass('input-error');
          $(this).addClass('mb-md-4');
          $(this).removeClass('mb-md-0');
          $(`#${id}`).text("");
        }, 7000);
      }, 200);
    }
  });
  return sinErrores;
}

function validarEmail(email) {
  let regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
  let sinErrores = true;
  $('.campo-email').each(function(e) {
    if (!regex.test($(this).val().trim())) {
      sinErrores = false;
      let id = $(this).attr('id');
      id = id.replace('txt', 'error');
      setTimeout(() => {
        $(this).addClass('input-error');
        $(this).removeClass('mb-md-4');
        $(this).addClass('mb-md-0');
        $(`#${id}`).text("Email invalido");
        setTimeout(() => {
          $(this).removeClass('input-error');
          $(this).addClass('mb-md-4');
          $(this).removeClass('mb-md-0');
          $(`#${id}`).text("");
        }, 7000);
      }, 200);
    }
  });
  return sinErrores;
}

function rellenarSelect(select, data) {
  let options = "<option selected disabled>--</option>";
  data.forEach(dato => {
    options += `<option value=${dato.id}>${dato.nombre}</option>`;
  });
  $(select).html(options);
}

function mostrarErrorPrincipal(texto, tipo = 0) {
  let tipos = ['danger', 'warning'];
  if (!$('#errorGeneral').parent().hasClass(`alert-${tipos[tipo]}`)) {
    $('#errorGeneral').parent().removeClass(`alert-${tipos[(tipo - 1) * -1]}`);
    $('#errorGeneral').parent().addClass(`alert-${tipos[tipo]}`);
  }
  $('#errorGeneral').parent().removeClass('d-none');
  $('#errorGeneral').text(texto);
  $(document).scrollTop($('#errorGeneral').scrollTop());
}

$(".solo-numeros").on("input", function() {
  this.value = this.value.replace(/[^0-9]/g, "");
});

$(".solo-rut").on("input", function() {
  this.value = this.value.replace(".", "");
  this.value = this.value.replace("-", "");
  cuerpo = this.value.slice(0, -1);
  dv = this.value.slice(-1).toUpperCase();
  this.value = `${cuerpo}-${dv}`;
});