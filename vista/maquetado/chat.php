<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.html' ?>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
    <title>Document</title>
    <style>
    </style>
  </head>
  <body>
    <?php include 'navbar.html' ?>
    <div class='container'>
      <div id='chat'></div>
      <div class="input-group mb-3">
        <input type="text" id='mensaje' class="form-control" placeholder="..." aria-describedby="basic-addon2" />
        <div class="input-group-append">
          <button id="enviar" class="btn btn-outline-secondary" type="button">Enviar</button>
          <button id="actu" class="btn btn-outline-secondary" type="button">Ver nuevos mensajes</button>
        </div>
      </div>
    </div>
  </body>
  <script type='text/javascript' src='../../controlador/JS/chat.js'></script>
  <!-- <script type= "text/javascript" src="../../controlador/JS/nav_eventos.js"></script> -->
</html>
