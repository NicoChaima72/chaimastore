<?php 
require_once '../config/configGeneral.php';
if (isset($_POST['accion'])) {
  require_once '../controllers/usuarioController.php';
  $usuario = new usuarioController();
  if ($_POST['accion'] == 'registrar_usuario') {
    if (
      isset($_POST['email']) && isset($_POST['confirmarEmail']) && isset($_POST['password']) && isset($_POST['confirmarPassword']) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['referencial']) && isset($_POST['rut']) && isset($_POST['direccion']) && isset($_POST['telefono']) 
    ) {
      echo json_encode($usuario->registrar_usuario_controller());
    } else {
      respuesta_error();
    }
  }
  if ($_POST['accion'] == 'obtener_regiones') {
    echo $usuario->obtener_regiones_controller();
  }
  if ($_POST['accion'] == 'obtener_provincias') {
    if (isset($_POST['region'])) {
      echo $usuario->obtener_provincias_controller($_POST['region']);
    } else {
      respuesta_error();
    }
  }
  if ($_POST['accion'] == 'obtener_comunas') {
    if (isset($_POST['provincia'])) {
      echo $usuario->obtener_comunas_controller($_POST['provincia']);
    } else {
      respuesta_error();
    }
  }
} else {
  respuesta_error();
}
function respuesta_error() {
  $respuesta = [
    'error' => 'Ha ocurrido un error, intenta más tarde'
  ];
  echo json_encode($respuesta);
}
?>