<?php 
require_once '../config/configGeneral.php';
if (isset($_POST['accion'])) {
  require_once '../controllers/usuarioController.php';
  $usuario = new usuarioController();
  
  if ($_POST['accion'] == 'obtener_regiones') {
    echo $usuario->obtener_regiones_controller();
    
  } else if ($_POST['accion'] == 'obtener_provincias') {
    if (isset($_POST['region'])) {
      echo $usuario->obtener_provincias_controller($_POST['region']);
    } else {
      respuesta_error();
    }

  } else if ($_POST['accion'] == 'obtener_comunas') {
    if (isset($_POST['provincia'])) {
      echo $usuario->obtener_comunas_controller($_POST['provincia']);
    } else {
      respuesta_error();
    }

  } else {
    respuesta_error();
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