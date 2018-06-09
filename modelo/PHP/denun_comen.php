<?php
//abre base de datos, recibe de un ajax un número id_comen
//cambia al atributo denuncia_c a 1
    include "funciones.php";
    $db = conexion();
    checar_con($db);
    $idComen = validar($_POST["comenID"],"",$db);

    //actualiza el estado de un comentario, y cambia a 1 el atributo denuncia
    $upd = "UPDATE comentario SET denuncia_c = '1' WHERE id_comen='$idComen'";
    mysqli_query($db,$upd);
    echo $upd;
    mysqli_close($db);

?>
