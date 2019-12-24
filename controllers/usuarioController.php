<?php 
require_once '../models/usuarioModel.php';
class usuarioController extends usuarioModel {
  public function obtener_regiones_controller() {
    $resultado = usuarioModel::obtener_regiones_model();
    return $resultado;
  }
  public function obtener_provincias_controller($region) {
    $resultado = usuarioModel::obtener_provincias_model($region);
    return $resultado;
  }
  public function obtener_comunas_controller($provincia) {
    $resultado = usuarioModel::obtener_comunas_model($provincia);
    return $resultado;
  }
}

?>