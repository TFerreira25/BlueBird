<?php
    include 'connections/conn.php';
    $cargo = intval($_REQUEST["cargo"]);
    $id = intval($_REQUEST["num"]);
    $altera_cargo = mysqli_fetch_array(mysqli_query($conn, "UPDATE login SET log_type='$cargo' WHERE log_id = '$id'"));
    if($altera_cargo){
        echo '<meta http-equiv="Refresh" content="0;index.php?opt=1&admin=1">';
    }