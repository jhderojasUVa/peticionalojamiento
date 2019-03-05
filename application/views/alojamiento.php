<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?=base_url()?>">Petición Alojamientos</a>
    <!-- Small -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?=base_url()?>index.php/principal/login" role="link">Resumen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url()?>index.php/principal/new" role="link">Nueva</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url()?>index.php/principal/salir" role="link">Salir <i class="fas fa-sign-out-alt"></i></a>
        </li>
        <? if ((isset($_SESSION["fueAdmin"])) && ($_SESSION["fueAdmin"] == true)) { ?>
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url()?>index.php/doc/admin/cambiarderopa">Ir a la zona de administraci&oacute;n</a>
        </li>
        <? } ?>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
        <button class="btn btn-light my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
      </form>
    </div>
  </nav>
  <div class="container h-100 margin-top-1 margin-bottom-1">
    <div id="verAlojamiento"></div>
    <script type="text/babel" src="<?=base_url()?>js/components/verAlojamientoComponent.js"></script>
  </div>
</body>
