<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.html'; ?>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
    <title>Document</title>
    <style>
    </style>
  </head>
  <body>
    <?php include 'navbar.php';; ?>
    <div class='container'>
      <div id='chat'></div>
      <div class="input-group mb-3">
        <input type="text" id='mensaje' class="form-control" placeholder="..." aria-describedby="basic-addon2" />
        <div class="input-group-append">
          <button id="enviar" class="btn btn-outline-secondary" type="button">Enviar</button>
          <button id="actu" class="btn btn-outline-secondary" type="button">Ver nuevos mensajes</button>
          <button id="evento" class="btn btn-outline-secondary" data-toggle="modal" data-target="#NuevoEvento" type="button">Evento</button>
        </div>
        <div class="modal fade" id="NuevoEvento" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Nuevo evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="formularioEvento">
                  <div class='form-group'>
                    <label>Tipo de Evento :</label>
                    <input type="radio" name="evento" value="trueque" checked/>Trueque
                    <input type="radio" name="evento" value="perdida" />Perdida
                  </div>
                  <div class='form-group'>
                    <label>Lugar:</label>
                    <input type='text' class='form-control' id='lugar' name='id_usuario' required/>
                  </div>
                  <div class='form-group'>
                    <label>Fecha:</label><br /><br />
                    Día<input type="date" class"form-control" id="fechaFE" name="fecha" required />
                    Hora<input type="time" class"form-control" id="horaFE" name="hora" value="06:00" required />
                  </div>
                  <button id="Genial" class="btn btn-primary"  type="button">Registrar Evento</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      <?php include "modal.html";; ?>
  </body>
  <script type='text/javascript' src='../../controlador/JS/chat.js'></script>
  <script type= "text/javascript" src="../../controlador/JS/nav_eventos.js"></script>
</html>
