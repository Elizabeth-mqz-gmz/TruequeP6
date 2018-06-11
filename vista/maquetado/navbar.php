<nav class='navbar sticky-top navbar-expand-lg navbar-light'>
  <a class="navbar-brand" href="#">
    <img src="../recursos/tpfon.png" width="90%"alt="Trueque P6">
  </a>
  <a class='navbar-brand mb-0 h1' href='main.php'>
    <h1 id='TP6' class='display-4'>Trueque P6</h1>
  </a>

  <div class='form-inline my-2 my-lg-0'>
    <div class='input-group'>
      <div class='input-group-prepend'>
        <span class='input-group-text' id='basic-addon1'><i class="fa fa-users"></i></span>
      </div>
      <input class='form-control mr-sm-2' type='search'id="buscado" placeholder='Nombre de Usuario' aria-label='Search'>
        <ul id="buscadillo" role="menu" aria-labelledby="navbarDropdown">
        </ul>
    </div>
    <button class='btn btn-light my-2 my-sm-0' id="buscar" type='submit'><i class="fa fa-search" style="font-size:24px"></i>
</button>
  </div>

  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
  </button>

  <div class='collapse navbar-collapse' id='navbarSupportedContent'>

    <div class='container'>
      <div class='container'>
        <span class='navbar-text'>
          ¿Perdiste algo?
        </span>
      </div>
      <div class='container'>
        <ul id="navbar" class='navbar-nav mr-auto nav-tabs'>
          <li class='nav-item active'>
            <div class="dropdown"  id="botonEvento">
              <a  class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- Calendario -->
                <i class="fa fa-calendar" style="font-size:24px;color:#3D343F"></i>
              </a>
              <div  id="evento" id="MuchosEventos" class="dropdown-menu p-4 text-muted" aria-labelledby="dropdownMenuLink">
                <span class='navbar-text' id='fechaHoy'></span>
                <script>
                let hoy = new Date ();
                let mes = hoy.getMonth()+1;
                $("<span style='color:#E98836;'><h4>Hoy: "+hoy.getDate()+"/"+mes.toString()+"/"+hoy.getFullYear()+"</h4></span>").appendTo("#fechaHoy");
                </script>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownNotif" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <!-- Notificaciones -->
                <i class="fa fa-bell-o" style="font-size:24px;color:#3D343F"></i>
            </a>
            <ul class="dropdown-menu scroll" id="notifis" role="menu" aria-labelledby="navbarDropdown">
            </ul>
          </li>
          <li class='nav-item dropdown'>
            <a class='nav-link dropdown-toggle' id="navbarDropdownChat"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- Chat -->
                <i class="fa fa-wechat" style="font-size:24px;color:#3D343F"></i>
            </a>
            <ul class="dropdown-menu" id="verChats" role="menu" aria-labelledby="navbarDropdown">
              <button id='nuevoChat' class='btn btn-outline-secondary'  data-toggle='modal' data-target='#buscarParaNuevoChat' type='button'>Iniciar una nueva conversación</button>
            </ul>
          </li>
          <li class='nav-item active'>
            <a class='nav-link' id='perfil' href='perfil_usuario.php'>
                <!-- Perfil -->
                <i class="fa fa-user-circle" style="font-size:24px;color:#3D343F"></i>
            </a>
          </li>
          <li class='nav-item active'>
            <a class='nav-link' id='mensajes' href='publicar.php'>
                <!-- Publicar -->
                <i class="fa fa-pencil-square-o" style="font-size:24px;color:#3D343F"></i>
            </a>
          </li>
          <li class='nav-item active'>
            <a class='nav-link' id='cerrar_sesion' href='../../cerrar_sesion.php'>
                <!-- Cerrar Sesión -->
                <i class="fa fa-sign-out" style="font-size:24px;color:#3D343F"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<div class="modal fade" id="buscarParaNuevoChat" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header headerForm">
        <h5 class="modal-title">Nueva conversación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class='form-group formtexto'>
            <label>Nombre de usuario:</label>
            <input type='text' class='form-control' id='usuarioParaChatear' name='id_usuario' required />
            <ul id="mostrarPers" role="menu" aria-labelledby="navbarDropdown">
            </ul>
          </div>
          <div class='form-group formtexto'>
            Da click en el nombre del usuario con el que quieres empezar a chismear
          </div>
          <!-- <button id="comenzarConver" class="btn btn-primary"  type="button">Iniciar conversación</button> -->
      </div>
    </div>
  </div>
</div>
<?php include 'modal.html'; ?>
<script src='../../controlador/JS/num_notif.js'></script>
<script src='../../controlador/JS/notif.js'></script>
