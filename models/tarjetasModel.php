<?php 
require_once '../config/mainModel.php';
class tarjetasModel extends mainModel {
  protected function obtener_tarjetas_model($tipo) {
    $query = 
      "SELECT prod.id, UPPER(cat.nombre) AS marca, prod.nombre, CONCAT('$ ', REPLACE(FORMAT(prod.precio, 0), ',', '.')) AS precio_normal, CONCAT('$ ', REPLACE(FORMAT(prod.precio - IFNULL(prod.precio * prod.oferta, 0), 0), ',', '.')) AS precio_oferta, ROUND(prod.oferta * 100) AS oferta, popu.popularidad, prod.imagen, prod.fecha FROM productos prod INNER JOIN categorias cat ON prod.categoria_id = cat.id INNER JOIN productos_popularidad popu ON prod.id = popu.producto_id";

    if ($tipo == "populares") {
      $query.= " ORDER BY popu.popularidad desc, prod.id LIMIT 8";
    }
    if ($tipo == "todos") {
      $query.= " ORDER BY prod.fecha DESC";
    }
    $listaBlanca = [
      'samsung', 'apple', 'huawei', 'xiaomi', 'lg', 'nokia', 'motorola'
    ];
    if (in_array($tipo, $listaBlanca)) {
      $query.= " WHERE cat.nombre = '".ucfirst($tipo)."' ORDER BY prod.fecha DESC";
    }

    $query = parent::conectar()->prepare($query);
    $query->execute();
    return $query;
  }
}
?>