var serverUrl = "http://localhost/chaimastore/";
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
// LLAMANDO A smartphones

if (directorioPadre == "inicio" && $('#smartphonesPopulares')) {
  obtenerSmartphones('populares', 'smartphonesPopulares', 1);
}


if (directorioPadre == "smartphones" && $('#listaSmartphones')) {
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
    $('#listaSmartphones').html(`
      <div class="text-center mt-5">
        <p class="lead text-uppercase">Categoria no encontrada</p>
        <a href="${serverUrl}inicio/" class="btn btn-danger">VOLVER A INICIO</a>
      </div>
    `);
  } else {
    obtenerSmartphones(parametro, 'listaSmartphones');
  }

  $(document).on('change', '#cmbOrden', function (e) {
    e.preventDefault();
    obtenerSmartphones(parametro, 'listaSmartphones', $('#cmbOrden').val());
  });
}


if (directorioPadre == "smartphone") {
  let parametro = url.substring(0, url.length -1);
  parametro = parametro.substring(parametro.lastIndexOf('/') + 1);
  obtenerSmartphone(parametro, 'smartphone');
}

if (directorioPadre == "buscar") {
  let urlBase = `${serverUrl + directorioPadre}/`;
  let parametro = "todos";
  if (urlBase.length !== url.length) {
    parametro = url.substring(urlBase.length, url.length -1);
  }
  parametro = parametro.split('-');
  parametro = parametro.join(' ');
  $('#buscarTitulo').text(parametro);
  parametro = parametro = parametro.split(' ');
  parametro = parametro.join('-');
  parametro = parametro.toLowerCase();
  console.log(parametro);
  obtenerSmartphones('buscar', 'listaSmartphones', 0, parametro);
}



function obtenerSmartphone(codigo, padre) {
  $.ajax({
    type: "POST",
    url: `${serverUrl}ajax/smartphoneAjax.php`,
    data: {codigo},
    dataType: "json",
    success: function (res) {
      console.log(res);
      let mensaje = llenarSmartphone(res);
      $(`#${padre}`).html(mensaje);
    },
    error: function () {
      $(`#${padre}`).html(`
        <div class="text-center mt-5">
          <p class="lead text-uppercase">Smartphone no encontrado</p>
          <a href="${serverUrl}inicio/" class="btn btn-danger">VOLVER A INICIO</a>
        </div>
      `);
    }
  });
}

function llenarSmartphone(smartphone) {
  console.log(smartphone);
  let imagen = "null";
  if (smartphone.imagen) {
    imagen = `${raiz}assets/img/smartphones/${smartphone.imagen}`;
  } else {
    imagen = "https://media.metrolatam.com/2019/09/04/huaweimate30pror-9648e46b6384aa1b48bfee84a1c60125-0x1200.jpg";
  }
  let mensaje = `
    <div class="smartphone__informacion my-3 my-md-4">
      <div class="row flex-column-reverse flex-md-row w-100">
        <div class="col-md-6 smartphone__imagen p-3">
          <img src=${imagen} width="100" alt="" class="">`;
  if (smartphone.oferta != 0) {
    mensaje += `
          <span class="smartphone__oferta badge badge-success">-25%</span>`;
  }
  mensaje += `
        </div>
        <div class="col-md-6">
          <div class="pt-3 px-3 px-md-2 p-lg-4">
            <span class="text-muted">${smartphone.marca}</span>`;
  if (smartphone.oferta != 0) {
    mensaje += `
            <h1 class="d-none d-md-block font-weight-bold m-0">${smartphone.nombre.toUpperCase()}</h1>
            <h1 class="d-block d-md-none m-0 h3 font-weight-bold">${smartphone.nombre.toUpperCase()}</h1>`;
  } else {
    mensaje += `
            <strike><h1 class="d-none d-md-block font-weight-bold m-0">${smartphone.nombre.toUpperCase()}</h1></strike>
            <strike><h1 class="d-block d-md-none m-0 h3 font-weight-bold">${smartphone.nombre.toUpperCase()}</h1></strike>`;
  }
  mensaje += `
            <div class="d-none d-md-block">
              <div class="smartphone__precios">
                <hr class="mb-4 pb-3">`;
  if (smartphone.oferta != 0) {
    mensaje += `
                <div class="precio d-flex align-items-center">
                  <p class="font-weight-bold m-0 text-success">${smartphone.precio_oferta}</p>
                  <small class="ml-1 text-success">Oferta</small>
                </div>`;
  }
  mensaje += `
                <div class="precio d-flex align-items-center">
                  <p class="font-weight-bold m-0 text-muted">${smartphone.precio_normal}</p>
                  <small class="ml-1 text-muted">Normal</small>
                </div>
              </div>`;
  if (smartphone.oferta != 0) {
    mensaje += `
              <button class="btn btn-success d-flex align-items-center py-2 px-4 mt-4"><i class="fas fa-plus mr-2"></i>Agregar al carrito</button>`;
  } else {
    mensaje += `
              <span class="smartphone__agotado py-2 px-4 mt-4 d-inline-block text-white">AGOTADO</span>`;
  }
  mensaje +=`
              <div class="d-flex justify-content-left alignt-items-center border-top border-bottom mt-5 py-3">
                <div class="smartphone__domicilio rounded-circle p-2 d-flex align-items-center justify-content-center">
                  <i class="fas fa-home fa-2x text-white"></i>
                </div>
                <div class="ml-2">
                  <p class="m-0 lead">Despacho a domicilio</p>`;
    if (smartphone.stock != 0) {
      mensaje += `
                  <span class="text-success font-weight-bold">Disponible</span>
                </div>
                <div class="d-md-none d-lg-flex ml-auto mr-4 d-flex align-items-center"><i class="fas fa-check text-muted"></i></div>`;
    } else {
      mensaje += `
                  <span class="text-muted font-weight-bold">No disponible</span>
                </div>
                <div class="d-md-none d-lg-flex ml-auto mr-4 d-flex align-items-center"><i class="fas fa-times text-muted"></i></div>`;
    }
    mensaje += `;
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="px-4 d-md-none">
        <div class="smartphone__precios">
          <hr class="mb-4 pb-3">`;
    if (smartphone.oferta != 0) {
    mensaje += `
          <div class="precio d-flex align-items-center">
            <p class="font-weight-bold m-0 text-success">${smartphone.precio_oferta}</p>
            <small class="ml-1 text-success">Oferta</small>
          </div>`;
    }
    mensaje += `
          <div class="precio d-flex align-items-center">
            <p class="font-weight-bold m-0 text-muted">${smartphone.precio_normal}</p>
            <small class="ml-1 text-muted">Normal</small>
          </div>
        </div>
        <div class="d-flex justify-content-left border-top border-bottom mt-4 py-3">
          <div class="smartphone__domicilio rounded-circle p-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-home fa-2x text-white"></i>
          </div>
          <div class="ml-2">
            <p class="m-0 lead">Despacho a domicilio</p>`;
    if (smartphone.stock != 0) {
      mensaje += `
            <span class="text-success font-weight-bold">Disponible</span>
          </div>
          <div class="d-md-none d-lg-flex ml-auto mr-4 d-flex align-items-center"><i class="fas fa-check text-muted"></i></div>`;
        } else {
          mensaje += `
          <span class="text-muted font-weight-bold">No disponible</span>
          </div>
          <div class="d-md-none d-lg-flex ml-auto mr-4 d-flex align-items-center"><i class="fas fa-times text-muted"></i></div>`;
    }
    mensaje += `
        </div>
      </div>

      <div class="w-100 mt-4 pt-4 mt-md-1 pt-md-1 mb-5">
        <div class="accordion" id="smartphoneExtras">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button class="extras__titulo btn btn-link text-dark w-100 text-left font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Descripcion <i class="fas fa-plus text-dark"></i>
                </button>
              </h2>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#smartphoneExtras">
              <div class="card-body">
                ${smartphone.descripcion}
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="extras__titulo btn btn-link collapsed text-dark w-100 text-left font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Especificaciones tecnicas <i class="fas fa-plus text-dark"></i>
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#smartphoneExtras">
              <div class="card-body">
                Proximamente...
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="smartphone__carrito d-md-none">
      <div class="py-3 px-5">`;
  if (smartphone.oferta != 0) {
    mensaje += `
        <button class="btn btn-success btn-block py-2">Agregar al carrito</button>`;
  } else {
    mensaje += `
        <span class="smartphone__agotado d-block py-2 text-white text-center">AGOTADO</span>`;
  }
  mensaje += `
      </div>
    </div>
  `;
  return mensaje;
}








function obtenerSmartphones(tipo, padre, orden = 0, buscar = "") {
  if (tipo == "buscar") {
    text = "No se han encontrado resultados";
  } else {
    text = "Categoria no encontrada";
  }
  $.ajax({
    type: "POST",
    url: `${serverUrl}ajax/smartphoneAjax.php`,
    data: {tipo, buscar},
    dataType: "json",
    success: function (res) {
      if (res.data) {
        let mensaje = llenarSmartphones(res, tipo, orden);
        $(`#${padre}`).html(mensaje);
        $(`#cmbOrden option[value="${orden}"]`).attr("selected",true);
      } else {
        $(`#${padre}`).html(`
        <div class="text-center mt-5">
          <p class="lead text-uppercase">${text}</p>
          <a href="${serverUrl}inicio/" class="btn btn-danger">VOLVER A INICIO</a>
        </div>
      `);
      }
    },
    error: function (e) {
      console.log(e);
      $(`#${padre}`).html(`
        <div class="text-center mt-5">
          <p class="lead text-uppercase">${text}</p>
          <a href="${serverUrl}inicio/" class="btn btn-danger">VOLVER A INICIO</a>
        </div>
      `);
    }
  });
}
function llenarSmartphones(smartphones, tipo, orden) {
  if (orden == 0) {
    smartphones = smartphones.data.sort((a,b) => {
      if (a.fecha > b.fecha)
        return -1;
      if (a.fecha < b.fecha)
        return 1;
      return 0;
    });
  }
  if (orden == 1) {
    console.log('entando');
    smartphones = smartphones.data.sort((a,b) => {
      if (a.popularidad < b.popularidad)
        return -1;
      if (a.popularidad > b.popularidad)
        return 1;
      return 0;
    });
  }
  if (orden == 2) {
    smartphones = smartphones.data.sort((a,b) => {
      if (a.precio_oferta < b.precio_oferta)
        return -1;
      if (a.precio_oferta > b.precio_oferta)
        return 1;
      return 0;
    });
  }
  if (orden == 3) {
    smartphones = smartphones.data.sort((a,b) => {
      if (a.precio_oferta > b.precio_oferta)
        return -1;
      if (a.precio_oferta < b.precio_oferta)
        return 1;
      return 0;
    });
  }
  console.log(smartphones);
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
  smartphones.forEach(tarjeta => {
    let imagen = "null";
    if (tarjeta.imagen) {
      imagen = `${raiz}assets/img/smartphones/${tarjeta.imagen}`;
    } else {
      imagen = "https://media.metrolatam.com/2019/09/04/huaweimate30pror-9648e46b6384aa1b48bfee84a1c60125-0x1200.jpg";
    }
    mensaje += `
      <div class="col mb-3 px-1 px-xl-2">
        <a href="${serverUrl}smartphone/${tarjeta.codigo}/" class="card text-dark h-100 hidden">
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