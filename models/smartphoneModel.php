<?php 
require_once '../config/mainModel.php';
class smartphoneModel extends mainModel {
  protected function obtener_smartphones_model($tipo, $buscar = "") {
    $query = 
      "SELECT CONCAT(SUBSTR(REPLACE(REPLACE(REPLACE(LOWER(prod.nombre), ' ', ''), '+', 'plus'), '.', ''), 1, INSTR(REPLACE(REPLACE(REPLACE(LOWER(prod.nombre), ' ', ''), '+', 'plus'), '.', ''), '(') -1), prod.id + 2020) as codigo, prod.stock, UPPER(cat.nombre) AS marca, prod.nombre, CONCAT('$ ', REPLACE(FORMAT(prod.precio, 0), ',', '.')) AS precio_normal, CONCAT('$ ', REPLACE(FORMAT(prod.precio - IFNULL(prod.precio * prod.oferta, 0), 0), ',', '.')) AS precio_oferta, ROUND(prod.oferta * 100) AS oferta, popu.popularidad, prod.imagen, prod.fecha FROM productos prod INNER JOIN categorias cat ON prod.categoria_id = cat.id INNER JOIN productos_popularidad popu ON prod.id = popu.producto_id";
    if ($tipo == "populares") {
      $query.= " ORDER BY popu.popularidad desc, prod.fecha LIMIT 8";
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
    if ($tipo == "buscar") {
      $query.= " WHERE LOWER(REPLACE(CONCAT(cat.nombre, ' ', prod.nombre),' ', '-')) LIKE :buscar";
    }

    $query = parent::conectar()->prepare($query);
    if ($tipo == "buscar") {
      $buscar = '%'.$buscar.'%';
      $query->bindParam(":buscar", $buscar);
    }
    $query->execute();
    return $query;
  }

  protected function obtener_smartphone_model($codigo) {
    $query = 
      "SELECT CONCAT(SUBSTR(REPLACE(REPLACE(REPLACE(LOWER(prod.nombre), ' ', ''), '+', 'plus'), '.', ''), 1, INSTR(REPLACE(REPLACE(REPLACE(LOWER(prod.nombre), ' ', ''), '+', 'plus'), '.', ''), '(') -1), prod.id + 2020) as codigo, prod.stock, UPPER(cat.nombre) AS marca, prod.nombre, CONCAT('$ ', REPLACE(FORMAT(prod.precio, 0), ',', '.')) AS precio_normal, CONCAT('$ ', REPLACE(FORMAT(prod.precio - IFNULL(prod.precio * prod.oferta, 0), 0), ',', '.')) AS precio_oferta, ROUND(prod.oferta * 100) AS oferta, popu.popularidad, prod.imagen, prod.fecha, prod.descripcion FROM productos prod INNER JOIN categorias cat ON prod.categoria_id = cat.id INNER JOIN productos_popularidad popu ON prod.id = popu.producto_id WHERE CONCAT(SUBSTR(REPLACE(REPLACE(REPLACE(LOWER(prod.nombre), ' ', ''), '+', 'plus'), '.', ''), 1, INSTR(REPLACE(REPLACE(REPLACE(LOWER(prod.nombre), ' ', ''), '+', 'plus'), '.', ''), '(') -1), prod.id + 2020) = :codigo";
    
    $query = parent::conectar()->prepare($query);
    $query->bindParam(":codigo", $codigo);
    $query->execute();
    return $query;
  }
}
?>