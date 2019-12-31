<header class="d-flex justify-content-between align-items-center px-4 px-lg-5 py-3 py-lg-4">
  <div class="header__brand d-flex align-items-center">
    <div id="menuHamburguesa" class="header__brand__hamburguesa d-block d-md-none mr-3">
      <i class="fas fa-bars"></i>
    </div>
    <a class="text-white" href="<?php echo SERVER_URL; ?>inicio/">
      <h1 class="d-block d-lg-none h3 m-0">ChaimaStore</h1>
      <h1 class="d-none d-lg-block h1 m-0">ChaimaStore</h1>
    </a>
  </div>
  <div class="header__buscar d-none d-md-block bg-primary">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="¿Qué buscas?">
      <div class="input-group-append">
        <button class="btn btn-success" type="button">Buscar</button>
      </div>
    </div>
  </div>
  <div class="header__iconos d-flex align-items-center">
    <div class="header__icono__buscar d-flex align-items-center d-block d-md-none">
      <i class="fas fa-search" id="btnBuscar"></i>
      <div id="txtBuscar" class="icono__buscar__buscar input-group">
        <input type="text" class="form-control" placeholder="¿Qué buscas?" autofocus>
        <div class="input-group-append">
          <button class="btn btn-success" type="button">Buscar</button>
        </div>
      </div>
    </div>
    <?php
    if (!isset($principal_email)) :
    ?>
      <div class="header__icono__usuario d-flex align-items-center mx-2 mx-lg-4">
        <div class="d-flex align-items-center" data-toggle="modal" data-target="#modalUsuario">
          <i class="fas fa-user mx-2"></i>
          <p class="d-none d-lg-block m-0">Iniciar Sesion</p>
        </div>

        <div class="header__usuario__modal modal fade p-0" id="modalUsuario" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form id="formLogin">
                <div class="modal-header">
                  <h5 class="modal-title text-dark" id="exampleModalLabel">Iniciar Sesion</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body text-dark">
                  <div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                    <p id="errorGeneral" class="m-0">Las contraseñas no coinciden.</p>
                    <button id="alertCerrar" type="button" class="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="form-group m-0">
                    <label for="txtLoginEmail">Email</label>
                    <input type="email" class="form-control mb-3 mb-md-4 campo-requerido campo-email" id="txtLoginEmail" required>
                    <small class="form-text text-danger text-right" id="errorLoginEmail"></small>
                  </div>
                  <div class="form-group m-0">
                    <label for="txtLoginPassword">Contraseña</label>
                    <input type="password" class="form-control campo-requerido" id="txtLoginPassword">
                  </div>
                  <div class="form-group form-check mt-3 mb-0">
                    <input type="checkbox" class="form-check-input" id="chbLoginRecuerdame">
                    <label class="form-check-label" for="chbLoginRecuerdame">Recuerdame</label>
                  </div>
                </div>
                <div class="modal-footer d-flex flex-column">
                  <button type="submit" id="btnLogin" class="btn btn-success btn-block m-0">Iniciar Sesion</button>
                  <div class="modal-footer__extras mt-3">
                    <p class="text-dark mb-1" style="font-size: 14px">¿No tienes cuenta? <a href="<?php echo SERVER_URL; ?>registrar/">Registrate.</a></p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php
    else :
      $iniciales = strtoupper(substr($principal_nombre, 0, 1) . substr($principal_apellidos, 0, 1));
      $nombre = $principal_nombre . ' ' . substr($principal_apellidos, 0, strpos($principal_apellidos . ' ', ' '));
    ?>


      <div class="header__icono__usuario d-flex align-items-center mx-2 mx-lg-4">
        <span class="d-flex align-items-center" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="icono__usuario__iniciales mx-2 bg-success rounded-circle text-white font-weight-bold p-1"><?php echo $iniciales; ?></span>
          <p class="d-none d-lg-block m-0"><?php echo $nombre; ?></p>
        </span>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <p class="p-2 pb-1 m-0 ml-1 mr-5">Nicolas Chaima</p>
          <div class="dropdown-divider m-0 mb-2"></div>
          <a class="dropdown-item" href="#">Mi perfil</a>
          <a class="dropdown-item" href="#">Historial</a>
          <a class="dropdown-item text-danger mt-2" id="btnLogout" data="<?php echo $principal_token;?>">Cerrar Sesion</a>
        </div>
      </div>
    <?php
    endif;
    ?>
    <div class="header__icono__carrito d-flex">
      <i class="fas fa-shopping-cart"></i>
      <span class="badge badge-pill badge-success">3</span>
    </div>
  </div>
</header>


<div class="navegacion">
  <nav class="navegacion__principal d-none d-md-flex justify-content-around px-4 px-lg-5 text-center">
    <a class="w-100 py-3">Samsung</a>
    <a class="w-100 py-3">Apple</a>
    <a class="w-100 py-3">Huawei</a>
    <a class="w-100 py-3">Xiaomi</a>
    <a class="w-100 py-3">Lg</a>
    <a class="w-100 py-3">Nokia</a>
    <a class="w-100 py-3">Motorola</a>
  </nav>
  <nav id="navegacionResponsive" class="navegacion__responsive d-md-none flex-column">
    <a href="<?php echo SERVER_URL; ?>inicio/" class="d-block navegacion__responsive__titulo py-4 px-2 font-weight-bold m-0" style="font-size: 25px">ChaimaStore</a>
    <a class="w-100 d-block p-3 border">Samsung</a>
    <a class="w-100 d-block p-3 border">Apple</a>
    <a class="w-100 d-block p-3 border">Huawei</a>
    <a class="w-100 d-block p-3 border">Xiaomi</a>
    <a class="w-100 d-block p-3 border">Lg</a>
    <a class="w-100 d-block p-3 border">Nokia</a>
    <a class="w-100 d-block p-3 border">Motorola</a>
  </nav>
</div>

<div id="ocultarFondo" class="ocultar-fondo d-md-none">
  <div class="ocultar-fondo__capa"></div>
  <div class="ocultar-fondo__header"></div>
</div>