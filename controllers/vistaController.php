<?php
require_once './models/vistaModel.php';

class vistaController extends vistaModel {

  public function obtener_plantilla_controller() {
    return require_once "./views/plantilla.php";
  }

  public function obtener_vistas_controller() {
    if (isset($_GET['view'])) {
      $ruta = explode("/", $_GET['view']);
      $respuesta = vistaModel::obtener_vistas_model($ruta[0]);
    } else {
      // header('location:'.SERVER_URL.'inicio/');
      $respuesta = "inicio";
    }

    return $respuesta;
  }
}

?>