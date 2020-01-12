<?php 
$peticionAjax = true;
require_once '../config/configGeneral.php';
if (isset($_POST)) {
  require_once '../controllers/smartphoneController.php';
  $smartphone = new smartphoneController();

  
  if (isset($_POST['tipo'])) {
    echo json_encode($smartphone->obtener_smartphones_controller());
  }

  if (isset($_POST['codigo'])) {
    echo json_encode($smartphone->obtener_smartphone_controller());
  }
}
?>