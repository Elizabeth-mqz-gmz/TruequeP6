<?php
    $db = mysqli_connect("localhost","root","","truequep6");
    $busq = "SELECT * FROM usuario";
    $resp =mysqli_query($db,$busq);
    $row=mysqli_fetch_assoc($resp);
    foreach($row as $i => $v)
        echo " ".$i." => ".utf8_encode($v);
?>
