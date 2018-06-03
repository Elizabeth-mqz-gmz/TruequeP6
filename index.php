<!DOCTYPE html >
<html>
  <head>
    <title>Inicio</title>
    <meta charset='UTF-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' integrity='sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB' crossorigin='anonymous'>
    <script type= "text/javascript" src="controlador/JS/calendario.js"></script>
    <script type='text/javascript' src='librerias/jquery-3.3.1.min.js'></script>
    <link rel="stylesheet" href="vista/estilo/inicio.css">
  </head>
  <body>
    <div id="contenedor" class="text-center">
      <div class="botones">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Registro" >Registro</button>
      </div>
      <div class="botones">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Inicio_Sesion">Inicio de Sesión</button>
      </div>
    <div class="modal fade" id="Registro" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Registro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php include "vista/maquetado/regis.html"?>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="Inicio_Sesion" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Inicio Sesión</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php include "vista/maquetado/inicio_sesion.html"?>
          </div>
        </div>
      </div>
    </div>
    </div>
  </body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
<script src="controlador/JS/valida_login.js"></script>
</html>
