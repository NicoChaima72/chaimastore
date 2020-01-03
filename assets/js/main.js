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

// LLAMANDO A TARJETAS

if (directorioPadre == "inicio" && $('#tarjetasPopulares')) {
  obtenerTarjetas('populares', 'tarjetasPopulares');
}
function obtenerTarjetas(tipo, padre) {
  $.ajax({
    type: "POST",
    url: "../ajax/tarjetasAjax.php",
    data: {tipo},
    dataType: "json",
    success: function (res) {
      let mensaje = llenarTarjetas(res);
      $(`#${padre}`).html(mensaje);
    }
  });
}
function llenarTarjetas(tarjetas) {
  let mensaje = `<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4">`;
  tarjetas.data.forEach(tarjeta => {
    let imagen = "null";
    if (tarjeta.imagen) {
      imagen = `../assets/img/smartphones/${tarjeta.imagen}`;
      console.log(imagen);
    } else {
      imagen = "https://media.metrolatam.com/2019/09/04/huaweimate30pror-9648e46b6384aa1b48bfee84a1c60125-0x1200.jpg";
    }
    mensaje += `
      <div class="col mb-4">
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
            <div class="card__agregar mt-2 d-none d-md-block">
              <button class="btn btn-success btn-block" producto="${tarjeta.id}">Agregar al carrito</button>
            </div>
          </div>
        </a>
      </div>
    `;
  });
  mensaje += `
    </div>
    <button class="btn btn-block btn-success w-25 mx-auto">Ver Mas</button>  
  `;
  return mensaje;
  // console.log(mensaje);
}