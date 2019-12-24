var seMuestra = false;
var seBusca = false;

$(window).resize(function () {
  if ($(window).width() > 768 && $('body').css('overflow') === 'hidden') {
    $('body').css('overflow', 'auto');
  }
  if ($(window).width() <= 768 && seMuestra || $(window).width() <= 768 && seBusca) {
    if ( $(window).scrollTop() > 0 ) {
      seMuestra = false;
      seBusca = false;
      $('#ocultarFondo').fadeOut(300);
      $('#navegacionResponsive').removeClass('show');
      $('#txtBuscar').fadeOut(300);
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
    let buscar = $('#txtBuscar');
    if (!buscar.is(e.target) && buscar.has(e.target).length === 0) {
      $('#ocultarFondo').fadeOut(300);
      $('#txtBuscar').fadeOut(300);
      $('body').css('overflow', 'auto');
      seBusca = false;
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
$('#btnBuscar').click(function (e) { 
  e.preventDefault();
  $('#ocultarFondo').fadeIn(400);
  $('#txtBuscar').css("display", "flex");
  $('#txtBuscar input').focus();
  $('body').css('overflow', 'hidden');
  setTimeout(() => {
    seBusca = true;
  }, 200);
});



