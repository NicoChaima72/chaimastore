var serverUrl = "http://localhost/php/chaimastore/";
var url = window.location.href;
if (url.indexOf(serverUrl) === -1) {
  window.location.href = serverUrl;
}
var nuevaUrl = url.replace(serverUrl, '');
nuevaUrl = nuevaUrl.replace('/', '');
nuevaUrl = nuevaUrl.trim();

if (nuevaUrl.length === 0) {
  window.location.href = `${serverUrl}inicio/`;
}
if (url.substring(url.length -1).indexOf('/') == -1) {
  window.location.href = `${url}/`;
}

var directorioPadre = url.substr(serverUrl.length);
if (directorioPadre.indexOf('/') != -1) {
  directorioPadre = directorioPadre.substr(0, directorioPadre.indexOf('/')).trim();
}

var extra = url.substring(serverUrl.length, url.length -1);
var raiz = "";
extra.split('/').forEach(pleca => {
  raiz += "../";
});
// LLAMANDO A TARJETAS

if (directorioPadre == "inicio" && $('#tarjetasPopulares')) {
  obtenerTarjetas('populares', 'tarjetasPopulares');
}
if (directorioPadre == "smartphones" && $('#tarjetasSmartphones')) {
  let urlBase = `${serverUrl + directorioPadre}/`;
  let parametro = "todos";
  if (urlBase.length !== url.length) {
    parametro = url.substring(urlBase.length, url.length -1);
  }
  console.log(parametro);
  $('#tipoCategoria, #tipoCategoriaResponsive').html(parametro);
  let listaBlanca = [
    'samsung', 'apple', 'huawei', 'xiaomi', 'lg', 'nokia', 'motorola', 'todos'
  ];
  if (listaBlanca.indexOf(parametro) === -1) {
    $('#tarjetasSmartphones').html(`
      <div class="text-center mt-4">
        <p class="lead text-uppercase">Categoria no encontrada</p>
        <a href="${serverUrl}inicio/" class="btn btn-success">VOLVER A INICIO</a>
      </div>
    `);
  } else {
    obtenerTarjetas(parametro, 'tarjetasSmartphones');
  }
}

function obtenerTarjetas(tipo, padre, orden = 0) {
  $.ajax({
    type: "POST",
    url: `${raiz}ajax/tarjetasAjax.php`,
    data: {tipo},
    dataType: "json",
    success: function (res) {
      let mensaje = llenarTarjetas(res, tipo, orden);
      $(`#${padre}`).html(mensaje);
    },
    error: function () {
      $(`#${padre}`).html(`
        <div class="text-center mt-4">
          <p class="lead text-uppercase">Ha ocurrido un error</p>
          <a href="${serverUrl}inicio/" class="btn btn-danger">VOLVER A INICIO</a>
        </div>
      `);
    }
  });
}
function llenarTarjetas(tarjetas, tipo, orden) {
  let mensaje = `<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4">`;
  tarjetas.data.forEach(tarjeta => {
    let imagen = "null";
    if (tarjeta.imagen) {
      imagen = `${raiz}assets/img/smartphones/${tarjeta.imagen}`;
    } else {
      imagen = "https://media.metrolatam.com/2019/09/04/huaweimate30pror-9648e46b6384aa1b48bfee84a1c60125-0x1200.jpg";
    }
    mensaje += `
      <div class="col mb-4 px-1 px-xl-3">
        <a href="#" class="card text-dark">
          <img src="${imagen}" class="card-img-top border" height="250" alt="...">
          <div class="card-body">
            <div class="card__marca d-flex align-items-center">
              <p class="m-0">${tarjeta.marca}</p> `;
    if (tarjeta.oferta) {
      mensaje += `
              <span href="#" class="badge badge-success ml-2">-${tarjeta.oferta}%</span>`
    }
    mensaje += `
            </div>
            <h5 class="card__titulo">${tarjeta.nombre}</h5>`;
    if (tarjeta.oferta) {
      mensaje += `
            <div class="card__precio-internet d-flex align-items-center">
              <p class="font-weight-bold m-0">${tarjeta.precio_oferta}</p>
              <small class="text-muted ml-1">Internet</small>
            </div>
              `
    }
    mensaje += `       
            <div class="card__precio-normal d-flex align-items-center">
              <p class="font-weight-bold m-0 text-muted">${tarjeta.precio_normal}</p>
              <small class="text-muted ml-1">Normal</small>
            </div>
            <div class="card__agregar mt-2 d-none d-lg-block">
              <button class="btn btn-success btn-block" producto="${tarjeta.id}">Agregar al carrito</button>
            </div>
          </div>
        </a>
      </div>
    `;
  });
  mensaje += `
    </div>`;
  if (tipo === "populares") {
    mensaje += `
      <a href="${serverUrl}smartphones/" class="btn btn-block btn-success w-25 mx-auto">Ver Todos</a>  
    `;
  }
  return mensaje;
}