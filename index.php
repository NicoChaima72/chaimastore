<?php 
require_once './autoload.php';
require_once './config/configGeneral.php';
// require_once './controllers/vistaController.php';

$plantilla = new vistaController();
$plantilla->obtener_plantilla_controller();

?>