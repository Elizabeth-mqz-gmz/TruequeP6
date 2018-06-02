<nav class='navbar sticky-top navbar-expand-lg navbar-light bg-light'>

  <a class='navbar-brand mb-0 h1' href='main.php'>
    <h1 class='display-4'>Trueque P6</h1>
  </a>

  <form class='form-inline my-2 my-lg-0'>
    <div class='input-group'>
      <div class='input-group-prepend'>
        <span class='input-group-text' id='basic-addon1'>#</span>
      </div>
      <input class='form-control mr-sm-2' type='search' placeholder='Número de Cuenta' aria-label='Search'>
    </div>
    <button class='btn btn-outline-success my-2 my-sm-0' type='submit'>Buscar</button>
  </form>

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
        <ul class='navbar-nav mr-auto nav-tabs'>
          <li class='nav-item active'>
            <div class="dropdown"  id="botonEvento">
              <a  class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Calendario
              </a>
              <div  id="evento"  class="dropdown-menu p-4 text-muted" aria-labelledby="dropdownMenuLink">
                <span class='navbar-text' id='fechaHoy'></span>
                <script>
                let hoy = new Date ();
                $("<h4>Hoy: "+hoy.getDate()+"/"+hoy.getMonth()+"/"+hoy.getFullYear()+"</h4>").appendTo("#fechaHoy");
                </script>
              </div>
            </div>

          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownNotif" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </a>
            <script>
                <?php include '../../prunotif.php';?>
                var notifNum = '<?php echo $num;?>';
                $("#navbarDropdownNotif").html("Notificaciones<span class='badge badge-light'>"+notifNum+"</span>");
            </script>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              aquí van las notificaciones :)
            </div>
          </li>
          <li class='nav-item dropdown'>
            <a class='nav-link dropdown-toggle' id='mensajes'  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chat</a>
            <a href='chat.php'><div class="dropdown-menu" aria-labelledby="navbarDropdown">
              Personas con las que has chateado
            </div></a>
          </li>
          <li class='nav-item active'>
            <a class='nav-link' id='perfil' href='perfil_usuario.php'>Perfil</a>
          </li>
          <li class='nav-item active'>
            <a class='nav-link' id='mensajes' href='publica.html'>Publicar</a>
          </li>
        </ul>
      </div>
    </div>

  </div>
</nav>
