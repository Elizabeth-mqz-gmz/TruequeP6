<?php include '../../modelo/PHP/perfil_usuario.php'?>
<html>
  <head>
    <title>Perfil</title>
    <?php include 'head.html'; ?>
    <link rel='stylesheet' href='../estilo/perfil.css'/>
  </head>
  <body>
    <?php include 'navbar.php';?>
    <div id="muro">
      <div id="imagen">
        <?php echo "<img id='pic' src='../../".$perfil["imagen"]."' class='rounded float-left img-thumbnail' alt='imagen perfil'/>"; ?>
      </div>
      <div class="container">
        <?php echo "<h2 id='nombre' class='display-2'>".$perfil["nomus"]."</h2>"; ?>
        <div class="col-sm-10">
          <button type="submit" id="chat" class="btn btn-primary">Enviar mensaje</button>
        </div>
      </div>
    </div>
    <div class='container' id='contenedorPubli'>
      <div id="publicaciones">
      </div>
    </div>
    <?php include 'denuncia.html';?>
    <?php include 'modal.html'; ?>
      <!--?php include 'footer.html'-->
  </body>
  <script type= "text/javascript" src="../../controlador/JS/nav_eventos.js"></script>
  <script type= "text/javascript" src="../../controlador/JS/publis_usuario.js"></script>
  <script type= "text/javascript" src="../../controlador/JS/funciones.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
  <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
</html>
