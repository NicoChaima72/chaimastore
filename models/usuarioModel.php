<?php 
require_once '../config/mainModel.php';
class usuarioModel extends mainModel {
  protected function obtener_regiones_model() {
    $query = "SELECT id, nombre FROM regiones";
    $query = parent::conectar()->prepare($query);
    $query->execute();

    $resultado = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $resultado['data'][] = [
        "id" => $row['id'],
        "nombre" => utf8_encode($row['nombre'])
      ];
    }
    return json_encode($resultado);
  }
  protected function obtener_provincias_model($region) {
    $query = "SELECT id, nombre FROM provincias WHERE idRegion = :Region";
    $query = parent::conectar()->prepare($query);
    $query->bindParam(":Region", $region);
    $query->execute();

    $resultado = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $resultado['data'][] = [
        "id" => $row['id'],
        "nombre" => utf8_encode($row['nombre'])
      ];
    }
    return json_encode($resultado);
  }
  protected function obtener_comunas_model($provincia) {
    $query = "SELECT id, nombre FROM comunas WHERE idProvincia = :Provincia";
    $query = parent::conectar()->prepare($query);
    $query->bindParam(":Provincia", $provincia);
    $query->execute();

    $resultado = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $resultado['data'][] = [
        "id" => $row['id'],
        "nombre" => utf8_encode($row['nombre'])
      ];
    }
    return json_encode($resultado);
  }
}
?>