<?php
include 'connections/conn.php';
echo '<center><h3 class="text-primary">Perguntas Frequentes</h3></center>
<hr class="bg-primary" style="height: 2px;">
<div class="row">';
$faqs = mysqli_query($conn, "SELECT faq_pergunta, faq_resposta FROM faqs where faq_resposta != ''");
while($faq = mysqli_fetch_array($faqs)){
    echo '<div class="row">
            <h4>'.$faq["faq_pergunta"].'</h4>
            <div class="col">';
            if (strlen($faq["faq_resposta"])-10 > 50){
                echo '<details class="mostra">
                    <summary>
                        Ver Passo a Passo:
                    </summary>
                    '.$faq["faq_resposta"].'
                </details>';
            }else{
                echo $faq["faq_resposta"];
            }
    echo '</div>
    </div>';
}
echo '</div>';