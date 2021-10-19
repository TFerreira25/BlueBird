<?php
include 'connections/conn.php';
echo '<center><h3 class="text-primary" >Alimentação Recomendada</h3></center>
    <hr class="bg-primary" style="height: 2px;">
    <div class="row">';
        $alimentacao = mysqli_query($conn, "SELECT aliment_rec_comida, esp_nome from alimentar_recomendada inner join especie on especie.esp_id = alimentar_recomendada.aliment_rec_esp_id where aliment_rec_comida != ''");
        while($alm = mysqli_fetch_array($alimentacao)){
            echo '<div class="row">
                    <h4>'.$alm["esp_nome"].'</h4>
                    <div class="col">';
                    if (strlen($alm["aliment_rec_comida"])-10 > 50){
                        echo '<details class="mostra">
                            <summary>
                                Ver Alimentação:
                            </summary>
                            '.$alm["aliment_rec_comida"].'
                        </details>';
                    }else{
                        echo $alm["aliment_rec_comida"];
                    }
            echo '</div>
            </div>';
        }
    echo '</div>';