<?php
require_once '../models/smartphoneModel.php';
class smartphoneController extends smartphoneModel {
  public function obtener_smartphones_controller() {
    $tipo = mainModel::limpiar_cadena($_POST['tipo'], 1);
    $resultado = smartphoneModel::obtener_smartphones_model($tipo);
    $smartphones = [];
    while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
      $smartphones['data'][] = [
        'stock' => utf8_decode($row['stock']),
        'nombre' => utf8_decode($row['nombre']),
        'oferta' => utf8_decode($row['oferta']),
        'popularidad' => utf8_decode($row['popularidad']),
        'codigo' => utf8_decode($row['codigo']),
        'marca' => utf8_decode($row['marca']),
        'precio_normal' => utf8_decode($row['precio_normal']),
        'precio_oferta' => utf8_decode($row['precio_oferta']),
        'imagen' => utf8_decode($row['imagen']),
        'fecha' => utf8_decode($row['fecha'])
      ];
    }
    return $smartphones;
  }

  public function obtener_smartphone_controller() {
    $codigo = mainModel::limpiar_cadena($_POST['codigo'], 1);
    $resultado = smartphoneModel::obtener_smartphone_model($codigo);
    $smartphone = $resultado->fetch();
    $smartphone = [
      'codigo' => utf8_decode($smartphone['codigo']),
      'stock' => utf8_decode($smartphone['stock']),
      'marca' => utf8_decode($smartphone['marca']),
      'nombre' => utf8_decode($smartphone['nombre']),
      'precio_normal' => utf8_decode($smartphone['precio_normal']),
      'precio_oferta' => utf8_decode($smartphone['precio_oferta']),
      'oferta' => utf8_decode($smartphone['oferta']),
      'popularidad' => utf8_decode($smartphone['popularidad']),
      'imagen' => utf8_decode($smartphone['imagen']),
      'fecha' => utf8_decode($smartphone['fecha']),
      'descripcion' => utf8_decode($smartphone['descripcion'])
      
    ];
    return $smartphone;
  }
}
?>