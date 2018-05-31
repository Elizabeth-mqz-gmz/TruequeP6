<?php include '../../modelo/PHP/perfil_usuario.php'?>
<html>
  <head>

    <title>Perfil</title>
    <meta charset='utf-8' />

  </head>
  <body>

      <!--?php include 'navbar.html' ?-->
      <?php echo "<img src='../../".$perfil["imagen"]."' />"; ?>
      <?php echo "<h2>".$perfil["nomus"]."</h2>"; ?>
      <!--?php include 'footer.html'-->
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h2 class="card-title">Card title</h2>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>

  </body>
</html>
