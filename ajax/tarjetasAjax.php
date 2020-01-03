<?php 
$peticionAjax = true;
require_once '../config/configGeneral.php';
if (isset($_POST['tipo'])) {
  require_once '../controllers/tarjetasController.php';
  $tarjetas = new tarjetasController();
  echo json_encode($tarjetas->obtener_tarjetas_controller());
}
?>