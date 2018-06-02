<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicacion</title>
    <script type='text/javascript' src='../../librerias/jquery-3.3.1.min.js'></script>
    <script type='text/javascript' src='../../controlador/JS/funciones.js'></script>
    <link rel='stylesheet' href='../estilo/publicaciones.css'/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
    <?php include "navbar.html" ?>
    <div id='contenedorPubli'></div>
    <div class="container">
        <div class="form-inline row">
            <input type='text' class="form-control" placeholder="Escribe un comentario" id="comentar"/>
            <button type="button" class="btn btn-primary">Comentar</button>
        </div>
    </div>
</body>
<script type='text/javascript' src='../../controlador/JS/publicacion.js'></script>
</html>