<?php
include 'connections/conn.php';
echo '<center><h3 class="text-primary">Doenças mais comuns</h3></center>
<hr class="bg-primary" style="height: 2px;">
<div class="row">';
$doenca = mysqli_query($conn, "SELECT esp_nome, doenca_desc FROM doenca inner join especie on especie.esp_id = doenca.doenca_esp where doenca_desc != ''");
while($doe = mysqli_fetch_array($doenca)){
    echo '<div class="row">
            <h4>'.$doe["esp_nome"].'</h4>
            <div class="col">';
            if (strlen($doe["doenca_desc"])-10 > 50){
                echo '<details class="mostra">
                    <summary>
                        Ver Doença:
                    </summary>
                    '.$doe["doenca_desc"].'
                </details>';
            }else{
                echo $doe["doenca_desc"];
            }
    echo '</div>
    </div>';
}
echo '</div>';