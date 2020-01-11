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
  obtenerTarjetas('populares', 'tarjetasPopulares', 1);
}
if (directorioPadre == "smartphones" && $('#tarjetasSmartphones')) {
  let urlBase = `${serverUrl + directorioPadre}/`;
  let parametro = "todos";
  if (urlBase.length !== url.length) {
    parametro = url.substring(urlBase.length, url.length -1);
  }
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

  $(document).on('change', '#cmbOrden', function (e) {
    e.preventDefault();
    obtenerTarjetas(parametro, 'tarjetasSmartphones', $('#cmbOrden').val());
  });
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
      $(`#cmbOrden option[value="${orden}"]`).attr("selected",true);
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
  if (orden == 0) {
    tarjetas = tarjetas.data.sort((a,b) => {
      if (a.fecha > b.fecha)
        return -1;
      if (a.fecha < b.fecha)
        return 1;
      return 0;
    });
  }
  if (orden == 1) {
    tarjetas = tarjetas.data.sort((a,b) => {
      if (a.popularidad > b.popularidad)
        return -1;
      if (a.popularidad < b.popularidad)
        return 1;
      return 0;
    });
  }
  if (orden == 2) {
    tarjetas = tarjetas.data.sort((a,b) => {
      if (a.precio_oferta < b.precio_oferta)
        return -1;
      if (a.precio_oferta > b.precio_oferta)
        return 1;
      return 0;
    });
  }
  if (orden == 3) {
    tarjetas = tarjetas.data.sort((a,b) => {
      if (a.precio_oferta > b.precio_oferta)
        return -1;
      if (a.precio_oferta < b.precio_oferta)
        return 1;
      return 0;
    });
  }
  console.log(tarjetas);
  let mensaje = "";
  if (tipo !== "populares") {
    mensaje += `
      <label class="mr-2" for="cmbOrden">Ordenar por: </label>
      <select class="mb-4" id="cmbOrden">
        <option value=0>Más nuevos</option>
        <option value=1>Popularidad</option>
        <option value=2>Precio menor a mayor</option>
        <option value=3>Precio mayor a menor</option>
      </select>
    `;
  }
  mensaje += `
    <div class="mt-2 d-flex justify-content-center">
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4">`;
  tarjetas.forEach(tarjeta => {
    let imagen = "null";
    if (tarjeta.imagen) {
      imagen = `${raiz}assets/img/smartphones/${tarjeta.imagen}`;
    } else {
      imagen = "https://media.metrolatam.com/2019/09/04/huaweimate30pror-9648e46b6384aa1b48bfee84a1c60125-0x1200.jpg";
    }
    mensaje += `
      <div class="col mb-3 px-1 px-xl-2">
        <a href="${serverUrl}/smartphone/" class="card text-dark h-100 hidden">
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
          </div>
        </a>
      </div>
    `;
  });
  mensaje += `
      </div>
    </div>
  `;
  if (tipo === "populares") {
    mensaje += `
      <a href="${serverUrl}smartphones/" class="btn btn-block btn-success w-50 mx-auto">Ver Todos</a>  
    `;
  }
  return mensaje;
}