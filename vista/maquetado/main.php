<!DOCTYPE html>
<html>
  <head>
    <?php include 'head.html'; ?>
    <title>Trueque P6</title>
    <link rel='stylesheet' href='../estilo/botonCambio.css'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        i{
            padding: 2px;
        }
    </style>
</head>
  <body>
    <?php include 'navbar.php'; ?>
    <div id="contenedor">
      <button id="cambio" class="cambio boton0 btn btn-light"><div id="contenedorBoton">TRUEQUE</div></button>
    </div>
    <div class='container' id='contenedorPubli'>
      <div id="publicaciones">
          <h2>Bienvenido a Trueque P6!!! Pícale en la cosa azul si quieres ver algún tipo de publicación en específico, desliza para ver todas las publicaciones</h2>

      </div>
    </div>
    <!-- con MODAL -->
    <div class="modal fade" id="denuncia" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header headerForm">
            <h3>Denuncia</h3>
            <button type="button" value="cerrar" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <select name="denun" id="Opciondenun" class="custom-select" id="inputGroupSelect01">
                        <option value="Contenido inapropiado para la plataforma">Contenido inapropiado para la plataforma</option>
                        <option value="Me ofende">Me ofende</option>
                        <option value="Eso es mentira">Eso es mentira</option>
                        <option value="La publicación se repite">La publicación se repite</option>
                        <option value="El usuario no pertenece a la Prepa">El usuario no pertenece a la Prepa</option>
                    </select>
                      <br><br>
                      <button type="submit" class="btn btn-outline-dark" id="envia">Denunciar</button>
                </form>
            </div>
        </div>
      </div>
    </div>
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
