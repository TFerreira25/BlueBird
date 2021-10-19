<?php
include 'connections/conn.php';
$id=intval($_REQUEST["query"]);
$sql = mysqli_fetch_array(mysqli_query($conn, "Select log_status from login where log_id = '$id'"));
switch($sql['log_status']){
    case '0':
        echo '<p style="color: green">Online</p>';
        break;
    case '1':
        echo '<p style="color: red">Offline</p>';
        break;
}
include 'connections/deconn.php';