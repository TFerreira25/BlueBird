<?php
include '../connections/conn.php';
/*$conn = mysqli_connect("localhost", "root", "");
if(!$conn){
    die("Erro de ligação". mysqli_connect_error());
}
mysqli_select_db($conn, "bluebird");
mysqli_set_charset($conn, "utf8");*/
session_start();
$sql = mysqli_query($conn, "UPDATE login SET log_status = 1 WHERE log_id='$_SESSION[log_id]'");
if($sql){
    session_unset();
    session_destroy();
}
/*mysqli_close($conn);*/
include '../connections/deconn.php';
echo '<meta http-equiv="Refresh" content="0;url=../index.php">';
