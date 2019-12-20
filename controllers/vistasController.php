<?php 
require_once './models/vistasModel.php';

class vistasController extends vistasModel {

  public function obtener_plantilla_controller() {
    return require_once "./views/plantilla.php";
  }

  public function obtener_vistas_controller() {
    if (isset($_GET['view'])) {
      $ruta = explode("/", $_GET['view']);
      $respuesta = vistasModel::obtener_vistas_model($ruta[0]);
    } else {
      header('location:'.SERVER_URL.'inicio');
      $respuesta = "./views/contents/inicio-view.php";
    }

    return $respuesta;
  }
}

?>