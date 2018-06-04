<!DOCTYPE html>
<html>
  <head>
    <?php include 'head.html' ?>
    <title>Trueque P6</title>
    <link rel='stylesheet' href='../estilo/botonCambio.css'/>
</head>
  <body>
    <?php include 'navbar.html' ?>
    <div id="contenedor">
      <button id="cambio" class="cambio boton0 btn btn-light"><div id="contenedorBoton"></div></button>
    </div>
    <div class='container' id='contenedorPubli'>
      <div id="publicaciones">
        <div class='container'>
          <h2>Bienvenido a Trueque P6!!!</h2>
          <p>Utiliza esta plataforma para encontrar tus cosas perdidas. Puedes buscar a tus amigos conociendo su número de cueta.</p>
          <br />
          <p> Tus datos están seguros, nunca compartiremos nada de tu informacion.</p>
          <p>Esperamos te guste, lo hicimos con mucho cariño</p>
          <img src="../../modelo/imagenes_pub/Nosotros.jpg"></img>
        </div>
      </div>
    </div>
    <!--?php include 'footer.html' ?-->
  </body>
  <?php include '../../modelo/PHP/notif_bienve.php' ?>
  <script type= 'text/javascript' src='../../controlador/JS/funciones.js'></script>
  <script type= 'text/javascript' src='../../controlador/JS/nav_eventos.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
  <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
</html>
