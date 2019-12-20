<!DOCTYPE html>
<html lang="en">
<?php
require_once './views/modules/head.php';
?>

<body>
  <?php 
  require_once './controllers/vistasController.php';
  $vista = new vistasController();
  $vistaResult = $vista->obtener_vistas_controller();

  require_once $vistaResult;
  
  
  require_once './views/components/footer.php';
  require_once './views/modules/scripts.php';
  ?>
</body>