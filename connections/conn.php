<?php
$conn = mysqli_connect("localhost", "root", "");
if(!$conn){
    die("Erro de ligação". mysqli_connect_error());
}
mysqli_select_db($conn, "bluebird");
mysqli_set_charset($conn, "utf8");