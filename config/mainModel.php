<?php 
if ($peticionAjax) {
  require_once "../config/configAPP.php";
} else {
  require_once "./config/configAPP.php";
}

class mainModel {
  protected function conectar() {
    $conn = new PDO(SGBD, USER, PASSWORD);
    $conn->query("SET NAMES 'utf-8'");
    return $conn;
  }

  protected function ejecutar_consulta_simple($query) {
    $result = self::conectar()->prepare($query);
    $result->execute();

    return $result;
  }

  public function encryption($string) {
    $output=false;
    $key=hash('sha256', SECRET_KEY);
    $iv=substr(hash('sha256', SECRET_IV), 0, 16);
    $output=openssl_encrypt($string, METHOD, $key, 0, $iv);
    $output=base64_encode($output);
    return $output;
  }

  public function decryption($string) {
    $key=hash('sha256', SECRET_KEY);
    $iv=substr(hash('sha256', SECRET_IV), 0, 16);
    $output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
    return $output;
  }

  protected function limpiar_cadena($cadena, $tipo = 0) {
    $cadena = trim($cadena);
    $cadena = stripslashes($cadena); // Quita las barras invertidas
    $cadena = str_ireplace("<script>", "", $cadena);
    $cadena = str_ireplace("</script>", "", $cadena);
    $cadena = str_ireplace("<script src", "", $cadena);
    $cadena = str_ireplace("<script type", "", $cadena);
    $cadena = str_ireplace("SELECT * FROM", "", $cadena);
    $cadena = str_ireplace("DELETE FROM", "", $cadena);
    $cadena = str_ireplace("INSERT INTO", "", $cadena);
    $cadena = str_ireplace("--", "", $cadena);
    $cadena = str_ireplace("^", "", $cadena);
    $cadena = str_ireplace("[", "", $cadena);
    $cadena = str_ireplace("]", "", $cadena);
    $cadena = str_ireplace("==", "", $cadena);
    $cadena = str_ireplace(";", "", $cadena);
    if ($tipo == 1) {
      $cadena = strtolower($cadena);
    } else if ($tipo == 2) {
      $cadena = strtoupper($cadena);
    } else if ($tipo == 3) {
      $cadena = ucfirst($cadena);
    } else if ($tipo == 4) {
      $cadena = ucwords(strtolower($cadena));
    } else {
      $cadena = $cadena;
    }
    return $cadena;
  }
}

?>