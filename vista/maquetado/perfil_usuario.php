<?php include '../../modelo/PHP/perfil_usuario.php'?>
<html>
  <head>
    <title>Perfil</title>
    <?php include 'head.html'; ?>
    <link rel='stylesheet' href='../estilo/perfil.css'/>
  </head>
  <body>
    <?php include 'navbar.php';?>
    <div id='muro'>
      <div id='imagen'>
        <?php echo '<img id="pic" src="../../'.$perfil['imagen'].'" />'; ?>
      </div>
      <div class='container'>
        <?php echo "<h2 id='nombre' class='display-2'>".$perfil['nomus']."</h2>"; ?>
        <div class='col-sm-10'>
          <button type='submit' id='chat' class='btn btn-primary'>Enviar mensaje</button>
          <!-- <button type='submit' id='actualizacion' class='btn btn-primary'>Actualizar Información</button> -->
          <div class='dropdown' id='vete'>
            <a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='actualizacion' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
              Actualizar Información
            </a>
            <ul class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
              <li class='dropdown-item' data-toggle='modal' data-target='#nuevaimagen' id='Imagendeperfil'>Imagen de perfil</li>
              <li class='dropdown-item' data-toggle='modal' data-target='#nuevonomus' id='Nombredeusuario'>Nombre de usuario</li>
              <li class='dropdown-item' data-toggle='modal' data-target='#kk' id='Contraseña'>Contraseña</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class='container' id='contenedorPubli'></div>
    <div id='nuevaimagen' class='modal fade' tabindex='-1' role='dialog' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <div class='modal-header alertHeaderForm'>
            <h5 class='modal-title'>Actualizar Imagen</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          <div id= 'contenidoModal' class='modal-body alertForm'>
            <form method='POST' enctype='multipart/form-data' action = '../../modelo/PHP/actualizar_imagen.php'>
              <label>Elige una imagen</label>
  						<input id='novaImagem' type='file' name='imagen' accept='image/png' class='form-control-file ' />
              <small>Si no seleccionas una imagen, tu foto de perfil será la que está por default.</small>
              <button class='btn btn-dark' type='submit'>Actualizar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div id='nuevonomus' class='modal fade' tabindex='-1' role='dialog' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <div class='modal-header alertHeaderForm'>
            <h5 class='modal-title'>Actualizar Nombre de Usuario</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          <div id= 'contenidoModal' class='modal-body alertForm'>
            <form method='POST' enctype='multipart/form-data' id='regis'>
              <label>Escribe tu nuevo nombre de usuario</label>
              <input id='user' type='text' class='form-control' name='user' pattern='[A-Za-z\d]{6,30}$' required/>
              <div></div>
              <small class='text-muted'>
                Debe comenzar con mayúsculas, mínimo 6 caracteres.
              </small>
            </form>
            <button class='btn btn-dark' id='NuevoUsuario'>Actualizar</button>
          </div>
        </div>
      </div>
    </div>
    <div class='modal fade' id='kk' tabindex='-1' role='dialog' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title'>Confirmación</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          <div class='modal-body'>
            <p>Antes de cambiar su contraseña por favor ingrese sus datos.</p>
            <?php include '../../vista/maquetado/inicio_sesion.html';?>
          </div>
        </div>
      </div>
    </div>
    <div id='nuevacontra' class='modal fade' tabindex='-1' role='dialog' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <div class='modal-header alertHeaderForm'>
            <h5 class='modal-title'>Actualizar Contraseña</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          <div id= 'contenidoModal' class='modal-body alertForm'>
            <form method='POST' enctype='multipart/form-data' id='formContra'>
              <div class='form-group'>
    						<label class='formtexto'>Nueva contraseña :</label>
    						<input class='form-control mx-sm-3' type='password' class='form-control contrasena' name='contra' id='pass1' required/>
    						<div></div>
    						<small class='text-muted'>
    							De 8-20 caracteres, al menos una mayúscula, una minúscula, un número y un caracter especial.
    						</small>
    					</div>
    					<div class='form-group'>
    						<label class='formtexto'>Confirma contraseña :</label>
    						<input class='form-control mx-sm-3' type='password' class='form-control contrasena' name='contra2'  id='pass2' required/>
    						<div></div>
    					</div>
              <div id='msj'>
    						<input value='Actualizar' class='btn btn-success' id='novasenha' class='btn btn-primary btn-l' type='button'>
    					</div>
          </div>
        </div>
      </div>
    </div>
      <?php include 'modal.html'; ?>
      <?php include 'denuncia.html';?>
      <!-- <?php include 'footer.html';?> -->
  </body>
  <script type= 'text/javascript' src='../../controlador/JS/actualizar.js'></script>
  <script type= 'text/javascript' src='../../controlador/JS/revisa.js'></script>
  <script type= 'text/javascript' src='../../controlador/JS/nav_eventos.js'></script>
  <script type= 'text/javascript' src='../../controlador/JS/publis_usuario.js'></script>
  <script type= 'text/javascript' src='../../controlador/JS/funciones.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
  <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
</html>
