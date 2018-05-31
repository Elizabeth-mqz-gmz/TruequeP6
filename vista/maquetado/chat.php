<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.html' ?>
    <title>Document</title>
    <style>
        #chat{
            width: 500px;
            height: 500px;
            border: 1px solid black;
        }
    </style>
  </head>
  <body>
    <?php include 'navbar.html' ?>
    <div class='container'>
      <div id='chat'></div>
      <div class="form-row">
        <div class="col-7">
          <input type="text" class="form-control" placeholder="...">
        </div>
        <button>Enviar</button>
      </div>
    </div>

  </body>
</html>
<!--script type='text/javascript' src='../../controlador/JS/chat.js'></script-->
<script type= "text/javascript" src="../../controlador/JS/nav_eventos.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
