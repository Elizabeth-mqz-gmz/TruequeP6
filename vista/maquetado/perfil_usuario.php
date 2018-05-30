<?php include '../../modelo/PHP/perfil_usuario.php'?>
<html>
  <head>

    <title>Perfil</title>
    <meta charset='utf-8' />

  </head>
  <body>

      <!--?php include 'navbar.html' ?-->
      <?php echo "<h2>".$perfil["nomus"]."</h2>"; ?>
      <?php echo "<img src='../../".$perfil["imagen"]."' />"; ?>

      <!--?php include 'footer.html'-->

  </body>
</html>
