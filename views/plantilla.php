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