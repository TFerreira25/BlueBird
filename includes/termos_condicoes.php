<?php
include 'connections/conn.php';
echo '<center><h3 class="text-primary">Termos e Condições</h3></center>
<hr class="bg-primary" style="height: 2px;">
<div class="row">';
$termos = mysqli_query($conn, "SELECT wb_termos FROM webdados where wb_id = 1");
while($term = mysqli_fetch_array($termos)){
    echo '
        <div class="row">
            '.$term["wb_termos"].'
        </div>
    ';
}
echo '</div>';