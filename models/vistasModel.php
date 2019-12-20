<?php 

class vistasModel {
  protected function obtener_vistas_model($vista) {
    $listaBlanca = [
      'inicio', 'samsung', 'apple', 'huawei', 'xiaomi', 'lg', 'nokia', 'motorola'
    ];

    if (in_array($vista, $listaBlanca)) {
      if (is_file("./views/contents/".$vista."-view.php")) {
        $contenido = "./views/contents/".$vista."-view.php";
      } else {
        $contenido = "./views/contents/404-view.php";
      }
    } else {
      $contenido = "./views/contents/404-view.php";
    }

    return $contenido;
  }
}

?>