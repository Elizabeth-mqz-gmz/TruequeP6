<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "head.html"?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicacion</title>
    <script type='text/javascript' src='../../librerias/jquery-3.3.1.min.js'></script>
    <script type='text/javascript' src='../../controlador/JS/funciones.js'></script>
    <link rel='icon' href='../recursos/favicon.png' type='image/png'>
    <link rel='stylesheet' href='../estilo/publicaciones.css'/>
    <link rel='stylesheet' href='../estilo/navbar.css' />
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' integrity='sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB' crossorigin='anonymous'/>
</head>
<body>
    <?php include "navbar.php";?>
    <div id='contenedorPubli'></div>
    <div id='contenedorComen'class="container">
      <div id="noComen">Esta publicación aún no tiene comentarios</div>
    </div>
    <div class="container">
        <div class="form-inline row">
            <input type='text' class="form-control" placeholder="Escribe un comentario" id="comentar"/>
            <button type="button" id="enviarComen" class="btn btn-primary">Comentar</button>
        </div>
    </div>
    <?php include 'denuncia.html';?>
    <?php include 'modal.html';?>
</body>
<script type= 'text/javascript' src='../../controlador/JS/funciones.js'></script>
<script type= 'text/javascript' src='../../controlador/JS/main.js'></script>
<script type= 'text/javascript' src='../../controlador/JS/nav_eventos.js'></script>
<script type= 'text/javascript' src='../../controlador/JS/publicación.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
</html>
