<?php 
require_once '../config/mainModel.php';
class usuarioModel extends mainModel {
  protected function registrar_usuario_model($usuario) {
    $nombre = utf8_decode($usuario['nombre']);
    $apellidos = utf8_decode($usuario['apellidos']);
    $referencial = utf8_decode($usuario['referencial']);
    $email = utf8_decode($usuario['email']);
    $direccion = utf8_decode($usuario['direccion']);

    $query = "INSERT INTO usuarios (rol_id, region_id, provincia_id, comuna_id, rut, nombre, apellidos, nombre_referencial, email, password, direccion) VALUES (:rol, :region, :provincia, :comuna, :rut, :nombre, :apellidos, :referencial, :email, :password, :direccion)";
    $query = parent::conectar()->prepare($query);

    $query->bindParam(":rol", $usuario['rol']);
    $query->bindParam(":region", $usuario['region']);
    $query->bindParam(":provincia", $usuario['provincia']);
    $query->bindParam(":comuna", $usuario['comuna']);
    $query->bindParam(":rut", $usuario['rut']);
    $query->bindParam(":nombre", $nombre);
    $query->bindParam(":apellidos", $apellidos);
    $query->bindParam(":referencial", $referencial);
    $query->bindParam(":email", $email);
    $query->bindParam(":password", $usuario['password']);
    $query->bindParam(":direccion", $direccion);

    $query->execute();

    return $query;
  }


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