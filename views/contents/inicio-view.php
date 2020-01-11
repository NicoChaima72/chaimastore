<?php
require_once './views/components/carrousel.php';
?>

<section class="container my-5 populares">
  <h2 class="h3 d-block d-md-none">Celulares más populares</h2>
  <h2 class="h1 d-none d-md-block">Celulares más populares</h2>
  <hr>
  <div id="tarjetasPopulares">
    <i class="fas fa-spinner fa-2x fa-spin text-center d-block w-100 mt-4"></i>
  </div>
</section>
<section class="marcas mt-5">
  <a href="<?php echo SERVER_URL;?>smartphones/samsung/" class="marcas__samsung">
    <h4>Samsung</h4>
    <div class="marcas__fondo"></div>
  </a>
  <a href="<?php echo SERVER_URL;?>smartphones/apple/" class="marcas__apple">
    <h4>Apple</h4>
    <div class="marcas__fondo"></div>
  </a>
  <a href="<?php echo SERVER_URL;?>smartphones/huawei/" class="marcas__huawei">
    <h4>Huawei</h4>
    <div class="marcas__fondo"></div>
  </a>
  <a href="<?php echo SERVER_URL;?>smartphones/xiaomi/" class="marcas__xiaomi">
    <h4>Xiaomi</h4>
    <div class="marcas__fondo"></div>
  </a>
  <a href="<?php echo SERVER_URL;?>smartphones/lg/" class="marcas__lg">
    <h4>Lg</h4>
    <div class="marcas__fondo"></div>
  </a>
  <a href="<?php echo SERVER_URL;?>smartphones/nokia/" class="marcas__nokia">
    <h4>Nokia</h4>
    <div class="marcas__fondo"></div>
  </a>
  <a href="<?php echo SERVER_URL;?>smartphones/motorola/" class="marcas__motorola">
    <h4>Motorola</h4>
    <div class="marcas__fondo"></div>
  </a>
</section>
