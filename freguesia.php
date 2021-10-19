<?php
//recebe os dados do jquery e envia preenche o html
include 'connections/conn.php';
$concelho=intval($_REQUEST["concelho"]);
$freguesias = mysqli_query($conn, "SELECT * FROM freguesias where concelhoid = '$concelho'");
echo '<option disabled selected value="0">Freguesia</option>';
while($freguesia = mysqli_fetch_array($freguesias)){
    echo '<option value="'.$freguesia["freguesiaid"].'">'.$freguesia["freguesia"].'</option>';
}
include 'connections/deconn.php';