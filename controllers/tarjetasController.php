<?php
require_once '../models/tarjetasModel.php';
class tarjetasController extends tarjetasModel {
  public function obtener_tarjetas_controller() {
    $tipo = mainModel::limpiar_cadena($_POST['tipo'], 1);
    $resultado = tarjetasModel::obtener_tarjetas_model($tipo);
    $tarjetas = [];
    while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
      $tarjetas['data'][] = [
        'id' => $row['id'],
        'marca' => $row['marca'],
        'nombre' => $row['nombre'],
        'precio_normal' => $row['precio_normal'],
        'precio_oferta' => $row['precio_oferta'],
        'oferta' => $row['oferta'],
        'popularidad' => $row['popularidad'],
        'imagen' => $row['imagen'],
        'fecha' => $row['fecha']
      ];
    }
    return $tarjetas;
  }
}
?>