<?php
include 'connections/conn.php';
$ave = intval($_REQUEST["contacto"]);
if($ave == null){
    echo 0;
}else{
    $contacto = mysqli_fetch_array(mysqli_query($conn, "SELECT uti_tel from utilizador where uti_log_id = '$ave'"));
    echo $contacto["uti_tel"];
}
include 'connections/deconn.php';