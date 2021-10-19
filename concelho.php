<?php
//recebe os dados do jquery e envia preenche o html
include 'connections/conn.php';
$distrito=intval($_REQUEST["distrito"]);
$concelhos = mysqli_query($conn, "SELECT * FROM concelhos where distritoid = '$distrito'");
//echo '<option disabled selected value>Concelho</option>';
echo '<option disabled selected value="0">Concelho</option>';
while($concelho = mysqli_fetch_array($concelhos)){
    echo '<option value="'.$concelho["concelhoid"].'">'.$concelho["concelho"].'</option>';
}
include 'connections/deconn.php';