<!DOCTYPE html>
<html>
  <head>
    <?php include 'head.html'; ?>
    <title>Trueque P6</title>
    <link rel='stylesheet' href='../estilo/botonCambio.css'/>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' integrity='sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB' crossorigin='anonymous'>
    <script type='text/javascript' src='../../librerias/jquery-3.3.1.min.js'></script>
    <style>
        i{
            padding: 2px;
        }
    </style>
</head>
  <body>
    <?php include 'navbar.php'; ?>
    <div id='contenedor'>
      <div id="izquierda"></div>
      <div id="derecha"></div>
      <button id='cambio' class='cambio boton0 btn btn-light'><div id='contenedorBoton'>IR A <br/>PÉRDIDAS</div></button>
    </div>
    <div class='container' id='contenedorPubli'>
      <div id='publicaciones' >
          <h2 styel='text-align: center;'>Aquí podrás encontrar todas las publicaciones.</h4>
      </div>
    </div>
    <?php include 'denuncia.html';?>
    <?php include 'modal.html';?>
    <?php include 'footer.html';?>
  </body>
  <?php include '../../modelo/PHP/notif_bienve.php' ?>
  <script type= 'text/javascript' src='../../controlador/JS/funciones.js'></script>
  <script type= 'text/javascript' src='../../controlador/JS/main.js'></script>
  <script type= 'text/javascript' src='../../controlador/JS/nav_eventos.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
  <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
</html>
