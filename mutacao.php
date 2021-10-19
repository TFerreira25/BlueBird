<?php
//recebe os dados do jquery e envia preenche o html
include 'connections/conn.php';
$mutacao=intval($_REQUEST["variedade"]);
$mutacoes= mysqli_query($conn, "SELECT * FROM mutacao where mut_var_id = '$mutacao' and mut_id != 98");
echo '<option disabled selected value="0">Mutação</option>
<option value="98">Ancestral</option>';
while($mut = mysqli_fetch_array($mutacoes)){
    echo '<option value="'.$mut["mut_id"].'">'.$mut["mut_nome"].'</option>';
}
include 'connections/deconn.php';