var serverUrl = "http://localhost/chaimastore/";
var seMuestra = false;
var seBusca = false;
var muestraCarrito = false;

$(window).resize(function () {
  if ($(window).width() > 768 && $('body').css('overflow') === 'hidden' && muestraCarrito === false) {
    $('body').css('overflow', 'auto');
  }
  if ($(window).width() <= 768 && seMuestra || $(window).width() <= 768 && seBusca) {
    if ( $(window).scrollTop() > 0 ) {
      seMuestra = false;
      seBusca = false;
      $('#ocultarFondo').fadeOut(300);
      $('#navegacionResponsive').removeClass('show');
      $('#containerBuscar').fadeOut(300);
    } else {
      $('body').css('overflow', 'hidden');
    }
  }
});

$(document).click(function (e) { 
  if (seMuestra) {
    let navegacion = $('#navegacionResponsive');
    if (!navegacion.is(e.target) && navegacion.has(e.target).length === 0) {
      $('#ocultarFondo').fadeOut(300);
      $('#navegacionResponsive').removeClass('show');
      $('body').css('overflow', 'auto');
      seMuestra = false;
    }
  }
  if (seBusca) {
    let buscar = $('#containerBuscar');
    if (!buscar.is(e.target) && buscar.has(e.target).length === 0) {
      $('#ocultarFondo').fadeOut(300);
      $('#containerBuscar').fadeOut(300);
      $('body').css('overflow', 'auto');
      seBusca = false;
    }
  }
  if (muestraCarrito) {
    let carrito = $('#carritoCompra');
    if (!carrito.is(e.target) && carrito.has(e.target).length === 0) {
      $('#ocultarFondoCarrito').fadeOut(300);
      $('#carritoCompra').fadeOut(300);
      $('body').css('overflow', 'auto');
      muestraCarrito = false;
    }
  }
});

$('#menuHamburguesa').click(function (e) { 
  e.preventDefault();
  if (!seMuestra) {
    $('#ocultarFondo').fadeIn(400);
    $('#navegacionResponsive').addClass('show');
    $('body').css('overflow', 'hidden');
    setTimeout(() => {
      seMuestra = true;
    }, 200);
  }
});
$('#iconoBuscar').click(function (e) { 
  e.preventDefault();
  $('#ocultarFondo').fadeIn(400);
  $('#containerBuscar').css("display", "flex");
  $('#containerBuscar input').focus();
  $('body').css('overflow', 'hidden');
  setTimeout(() => {
    seBusca = true;
  }, 200);
});













$('#iconoCarrito').click(function (e) { 
  e.preventDefault();
  $('#ocultarFondoCarrito').css("display", "block");
  $('#ocultarFondoCarrito').fadeIn(400);
  $('#carritoCompra').fadeIn(400);
  $('body').css('overflow', 'hidden');
  setTimeout(() => {
    muestraCarrito = true;
  }, 200);
});
$('#cerrarCarrito').click(function (e) { 
  e.preventDefault();
  $('#ocultarFondoCarrito').fadeOut(300);
  $('#carritoCompra').fadeOut(300);
  $('body').css('overflow', 'auto');
  muestraCarrito = false;
});













$('#txtBuscar, #txtBuscar1').keyup(function (e) { 
  input = $(this);
  let padre = $(this).parent();
  let mensajeError = padre.children('small.error__buscar');
  if (input.val().length != 0) {
    input.parent().children('span').show();
  } else {
    input.parent().children('span').hide();
  }
  if (e.which == 13) {
    validarBuscar(padre, input, mensajeError);
  }
});
$('.header__buscar span, .header__icono__buscar span').click(function (e) { 
  e.preventDefault();
  $(this).parent().children('input').val("");
  $(this).hide();
});

$('#btnBuscar, #btnBuscar1').click(function (e) { 
  let padre = $(this).parent().parent();
  let input = padre.children('input');
  let mensajeError = padre.children('small.error__buscar');
  validarBuscar(padre, input, mensajeError);
});

function validarBuscar(padre, input, mensajeError) {
  let mensaje = "";
  let texto = input.val();
  let caracteresProhibidos = '<>-_./,!"#$%&/()=?¿¡';
  let esValido = true;
  if (texto.length == 0) {
    esValido = false;
    mensaje = "Campo requerido";
  }
  for (i = 0; i < texto.length; i++) {
    for (j = 0; j < caracteresProhibidos.length; j++) {
      if (texto.charAt(i) == caracteresProhibidos.charAt(j)) {
        esValido = false;
        mensaje = "Contiene caracteres invalidos";
      }
    }
  }
  if (!esValido) {
    setTimeout(() => {
      input.addClass('input-error');
      mensajeError.html(mensaje);
      mensajeError.fadeIn(200);
      setTimeout(() => {
        input.removeClass('input-error');
        mensajeError.html("");
        mensajeError.fadeOut(150);
      }, 7000);
    }, 200);
  } else {
    texto = texto.trim();
    texto = texto.replace(/ /gi, '-');
    window.location.href = `${serverUrl}buscar/${texto}/`;
  }
}
