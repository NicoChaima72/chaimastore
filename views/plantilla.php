<?php
$peticionAjax = false;
session_start();
?>
<?php
if (isset($_SESSION['chaimastore__email'])) {
  include_once './config/mainModel.php';
  $model = new mainModel();
  $principal_rol = utf8_encode($model->decryption($_SESSION['chaimastore__rol']));
  $principal_region = utf8_encode($model->decryption($_SESSION['chaimastore__region']));
  $principal_provincia = utf8_encode($model->decryption($_SESSION['chaimastore__provincia']));
  $principal_comuna = utf8_encode($model->decryption($_SESSION['chaimastore__comuna']));
  $principal_rut = utf8_encode($model->decryption($_SESSION['chaimastore__rut']));
  $principal_nombre = utf8_encode($model->decryption($_SESSION['chaimastore__nombre']));
  $principal_apellidos = utf8_encode($model->decryption($_SESSION['chaimastore__apellidos']));
  $principal_referencia = utf8_encode($model->decryption($_SESSION['chaimastore__referencia']));
  $principal_email = utf8_encode($model->decryption($_SESSION['chaimastore__email']));
  $principal_direccion = utf8_encode($model->decryption($_SESSION['chaimastore__direccion']));
  $principal_telefono = utf8_encode($model->decryption($_SESSION['chaimastore__telefono']));
  $principal_token = utf8_encode($model->decryption($_SESSION['chaimastore__token']));
?>
<?php }?>
<!DOCTYPE html>
<html lang="en">
<?php
require_once './views/modules/head.php';
?>
<body>
  <?php 
  require_once './controllers/vistaController.php';
  $vista = new vistaController();
  $vistaResult = $vista->obtener_vistas_controller();

  require_once './views/components/header.php';

  require_once "./views/contents/".$vistaResult."-view.php";
  
  require_once './views/components/footer.php';
  require_once './views/modules/scripts.php';
  ?>
</body>