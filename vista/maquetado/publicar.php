<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicacion</title>
    <script type='text/javascript' src='../../librerias/jquery-3.3.1.min.js'></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <style>
        section{
            margin: 10%;
            width: 80%;
            border: 1px solid #8FCED0;
            padding: 5%;
            border-radius: 1%;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <section>
        <form method='POST' action='../../modelo/PHP/publica.php' enctype='multipart/form-data'>
            <div class="form-group">
                <label class="custom-file-label" for="exampleFormControlFile2">Elige una imagen</label>
                <input type="file" name="imagen" accept="image/jpg" class="form-control-file" id="exampleFormControlFile2"required>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Tipo de Publicación</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input radioTrue" type="radio" name='tipoPub' value='trueque'>
                            <label class="form-check-label" for="gridRadios1">
                               Trueque
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name='tipoPub' id='radioPerd' value='perdida'>
                            <label class="form-check-label" for="gridRadios2">
                                Perdida
                            </label>
                        </div>
                        <fieldset class="form-group display-none" id='perd'>
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">Tipo de Pérdida</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input radioNoCred" type="radio" name='tipoPer' value='ropa'>
                                        <label class="form-check-label" for="gridRadios1">
                                           Ropa
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input radioNoCred" type="radio" name='tipoPer' value='cuaderno'>
                                        <label class="form-check-label" for="gridRadios2">
                                            Cuadernos
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name='tipoPer' id='radioCred' value='credencial'>
                                        <label class="form-check-label" for="gridRadios2">
                                            Credencial
                                        </label>
                                    </div>
                                    <div class="form-group" id='numCred'>
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Inserta el Número de cuenta de la credencial</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='numCred'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </fieldset>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Mensaje</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword3" name='menPub'>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Publicar</button>
                </div>
            </div>
        </form>
    </section>
</body>
<script type='text/javascript' src='../animaciones/publica.js'></script>
<script type='text/javascript' src='../../controlador/JS/nav_eventos.js'></script>

</html>
