<div class="container my-4">
  <h1 class="d-block d-md-none font-weight-bold h2">Registrarme</h1>
  <h1 class="d-none d-md-block font-weight-bold">Registrarme</h1>
  <p class="d-block d-md-none">Entra ya a este mundo de tecnologia y cambia tu vida</p>
  <p class="d-none d-md-block lead">Entra ya a este mundo de tecnologia y cambia tu vida</p>
  <hr>
  <form id="formRegistrar">
    <div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
      <p id="errorGeneral1" class="m-0">Las contraseñas no coinciden.</p>
      <button id="alertCerrar1" type="button" class="close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group m-0">
          <label for="txtEmail">Email <span class="text-danger font-weight-bold">*</span></label>
          <input type="email" class="form-control mb-3 mb-md-4 campo-requerido campo-email" id="txtEmail" placeholder="Email" required>
          <small id="errorEmail" class="form-text text-danger text-right"></small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group m-0">
          <label for="txtConfirmarEmail">Confirmar email <span class="text-danger font-weight-bold">*</span></label>
          <input type="email" class="form-control mb-3 mb-md-4 campo-requerido campo-email" id="txtConfirmarEmail" placeholder="Confirmar email" required>
          <small id="errorConfirmarEmail" class="form-text text-danger text-right"></small>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group m-0">
          <label for="txtPassword">Contraseña <span class="text-danger font-weight-bold">*</span></label>
          <input type="password" class="form-control mb-3 mb-md-4 campo-requerido" id="txtPassword" placeholder="Contraseña" required>
          <small id="errorPassword" class="form-text text-danger text-right"></small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group m-0">
          <label for="txtConfirmarPassword">Confirmar contraseña <span class="text-danger font-weight-bold">*</span></label>
          <input type="password" class="form-control mb-3 mb-md-4 campo-requerido" id="txtConfirmarPassword" placeholder="Confirmar contraseña" required>
          <small id="errorConfirmarPassword" class="form-text text-danger text-right"></small>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group m-0">
          <label for="txtNombre">Nombre <span class="text-danger font-weight-bold">*</span></label>
          <input type="text" class="form-control mb-3 mb-md-4 campo-requerido" id="txtNombre" placeholder="Nombre" required>
          <small id="errorNombre" class="form-text text-danger text-right"></small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group m-0">
          <label for="txtApellidos">Apellidos <span class="text-danger font-weight-bold">*</span></label>
          <input type="text" class="form-control mb-3 mb-md-4 campo-requerido" id="txtApellidos" placeholder="Apellidos" required>
          <small id="errorApellidos" class="form-text text-danger text-right"></small>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group m-0">
          <label for="txtReferencial">Nombre referencial <span class="text-danger font-weight-bold">*</span></label>
          <input type="text" class="form-control mb-3 mb-md-4 campo-requerido" id="txtReferencial" placeholder="Nombre referencial" required>
          <small id="errorReferencial" class="form-text text-danger text-right"></small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group m-0">
          <label for="txtRut">Rut <span class="text-danger font-weight-bold">*</span></label>
          <input type="text" class="form-control mb-3 mb-md-4 campo-requerido solo-rut" id="txtRut" placeholder="Rut" maxlength="10" required>
          <small id="errorRut" class="form-text text-danger text-right"></small>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-xl-4">
        <div class="form-group m-0">
          <label for="txtDireccion">Direccion <span class="text-danger font-weight-bold">*</span></label>
          <input type="text" class="form-control mb-3 mb-md-4 campo-requerido" id="txtDireccion" placeholder="Direccion" required>
          <small id="errorDireccion" class="form-text text-danger text-right"></small>
        </div>
      </div>
      <div class="col-md-6 col-xl-2">
        <div class="form-group m-0">
          <label for="txtNumero">Numero <span class="text-danger font-weight-bold">*</span></label>
          <input type="text" class="form-control mb-3 mb-md-4 solo-numeros campo-requerido" id="txtNumero" placeholder="Numero" required>
          <small id="errorNumero" class="form-text text-danger text-right"></small>
        </div>
      </div>
      <div class="col-md-4 col-xl-2">
        <div class="form-group m-0">
          <label for="txtEdificio">Detalle direccion</label>
          <input type="text" class="form-control mb-1 mb-md-4" id="txtEdificio" placeholder="Villa / Edificio">
        </div>
      </div>
      <div class="col-md-4 col-xl-2">
        <div class="form-group m-0">
          <label for="txtDepartamento"></label>
          <input type="text" class="form-control mb-1 mb-md-4 mt-md-2" id="txtDepartamento" placeholder="Departamento">
        </div>
      </div>
      <div class="col-md-4 col-xl-2">
        <div class="form-group m-0">
          <label for="txtBlock"></label>
          <input type="text" class="form-control mb-4 mb-md-4 mt-md-2" id="txtBlock" placeholder="Block">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group m-0">
          <label for="cmbRegion">Region <span class="text-danger font-weight-bold">*</span></label>
          <select id="cmbRegion" class="form-control mb-3 mb-md-4">
            <option selected disabled>--</option>
            <option>...</option>
          </select>
          <small id="errorRegion" class="form-text text-danger text-right"></small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group m-0">
          <label for="cmbProvincia">Provincia <span class="text-danger font-weight-bold">*</span></label>
          <select id="cmbProvincia" class="form-control mb-3 mb-md-4">
            <option selected disabled>--</option>
            <option>...</option>
          </select>
          <small id="errorProvincia" class="form-text text-danger text-right"></small>
        </div>
      </div>
    </div>
    <div class="row">
    <div class="col-md-6">
        <div class="form-group m-0">
          <label for="cmbComuna">Comuna <span class="text-danger font-weight-bold">*</span></label>
          <select id="cmbComuna" class="form-control mb-3 mb-md-4">
            <option selected disabled>--</option>
            <option>...</option>
          </select>
          <small id="errorComuna" class="form-text text-danger text-right"></small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group m-0">
          <label for="txtTelefono">Telefono <span class="text-danger font-weight-bold">*</span></label>
          <input type="text" class="form-control mb-3 mb-md-4 solo-numeros campo-requerido" id="txtTelefono" placeholder="912345678" minlength="7" maxlength="11" required>
          <small id="errorTelefono" class="form-text text-danger text-right"></small>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 mt-4"></div>
      <div class="col-md-4 mb-5">
        <button type="submit" class="btn btn-success btn-carrito btn-block" id="btnRegistrar">REGISTRARME</button>
      </div>
    </div>
  </form>
</div>