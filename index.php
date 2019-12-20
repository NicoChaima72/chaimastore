<?php 

require_once './config/configGeneral.php';
require_once './controllers/vistasController.php';

$plantilla = new vistasController();
$plantilla->obtener_plantilla_controller();

?>