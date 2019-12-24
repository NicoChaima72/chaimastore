<?php 

class vistaModel {
  protected function obtener_vistas_model($vista) {
    $listaBlanca = [
      'inicio', 'registrar', 'samsung', 'apple', 'huawei', 'xiaomi', 'lg', 'nokia', 'motorola'
    ];

    if (in_array($vista, $listaBlanca)) {
      if (is_file("./views/contents/".$vista."-view.php")) {
        $contenido = $vista;
      } else {
        $contenido = "404";
      }
    } else {
      $contenido = "404";
    }

    return $contenido;
  }
}

?>