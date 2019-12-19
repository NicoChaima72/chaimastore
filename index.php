<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once './views/modules/head.php';
  ?>
</head>

<body>
  <?php
  require_once './views/components/header.php';
  ?>
  <?php
  require_once './views/components/carrousel.php';
  ?>

  <section class="container my-5">
    <h2 class="h3 d-block d-md-none">Celulares más populares</h2>
    <h2 class="h1 d-none d-md-block">Celulares más populares</h2>
    <hr>
    <div class="row row-cols-2 row-cols-md-4">
      <div class="col mb-4">
        <a href="#" class="card text-dark">
          <img src="https://media.metrolatam.com/2019/09/04/huaweimate30pror-9648e46b6384aa1b48bfee84a1c60125-0x1200.jpg" class="card-img-top" height="250" alt="...">
          <div class="card-body">
            <div class="card__marca d-flex align-items-center">
              <p class="m-0">HUAWEI</p>
              <span href="#" class="badge badge-success ml-2">-25%</span>
            </div>
            <h5 class="card__titulo">Huawei Mate 30 Pro (256 Gb)</h5>
            <div class="card__precio-internet d-flex align-items-center">
              <p class="font-weight-bold m-0">$ 250.000</p>
              <small class="text-muted ml-1">Internet</small>
            </div>
            <div class="card__precio-normal d-flex align-items-center">
              <p class="font-weight-bold m-0 text-muted">$ 300.000</p>
              <small class="text-muted ml-1">Normal</small>
            </div>
            <div class="card__agregar mt-2">
              <button class="btn btn-success btn-block">Agregar al carrito</button>
            </div>
          </div>
        </a>
      </div>
    </div>
  </section>
  <?php
  require_once './views/modules/scripts.php';
  ?>
  <?php
  require_once './views/components/footer.php';
  ?>
</body>

</html>