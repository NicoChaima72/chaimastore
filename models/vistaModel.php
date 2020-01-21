<?php 

class vistaModel {
  protected function obtener_vistas_model($vista) {
    $listaBlanca = [
      'inicio', 'registrar', 'smartphones', 'smartphone', 'buscar'
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