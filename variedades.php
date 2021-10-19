<?php
//recebe os dados do jquery e envia preenche o html
include 'connections/conn.php';
//intval - protege de sql injection
$variedade=intval($_REQUEST["especie"]);
$variedades= mysqli_query($conn, "SELECT * FROM variedade where var_esp_id = '$variedade'");
echo '<option disabled selected value="0">Variedade</option>';
while($var = mysqli_fetch_array($variedades)){
    echo '<option value="'.$var["var_id"].'">'.$var["var_nome"].'</option>';
}
include 'connections/deconn.php';