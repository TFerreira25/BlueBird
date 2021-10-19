<?php
echo '
    <h1 style="text-align:center">FAQS:</h1>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-6 col-xxl-6">';
        //painel para criar produtos
            if(!isset($_POST["btn_faq"])){
                echo '<form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <h3 style="text-align:center">Insira FAQS</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Pergunta:</label>
                        <input type="text" name="faq_pergunta" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col">
                        <label>Resposta:</label>
                        <textarea id="textarea_bluebird" class="form-control" name="faq_resposta" rows="15"></textarea>
                    </div>
                </div>
                <br><button type="submit" name="faq_inserir" class="form-control mt-2 btn bg-primary text-white">Inserir FAQ</button><br>
                </form><br>';
            }
            //painel para editar categorias
            if(isset($_POST["btn_faq"])){
                $faq = mysqli_fetch_array(mysqli_query($conn, "SELECT * from faqs where faq_id = '$_POST[faq_id]'"));
                echo '<form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <h3 style="text-align:center">Atualizar FAQS</h3>
                    </div>
                    <div class="col">
                        <button type="submit" name="voltar" class="form-control mt-2 btn bg-primary text-white">Voltar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Pergunta:</label>
                        <input type="text" name="faq_pergunta" value="'.$faq["faq_pergunta"].'" class="form-control">
                    </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col">
                        <label>Resposta:</label>
                        <textarea id="textarea_bluebird" class="form-control" name="faq_resposta" rows="15">'.$faq["faq_resposta"].'</textarea>
                    </div>
                </div>
                <input type="hidden" value="'.$faq["faq_id"].'" name="faq_id">
                <br><button type="submit" name="faq_atualizar" class="form-control mt-2 btn bg-primary text-white">Atualizar FAQ</button><br>
                <br><button type="submit" name="faq_eliminar" class="form-control mt-2 btn bg-danger text-white">Eliminar FAQ</button><br>
                </form><br>';
            }
        echo '</div>
        <div class="col-sm-12 col-md-12 col-xl-6 col-xxl-6">
            <div class="row">
                <div class="col-md-3">
                    <label>Pergunta:</label>
                </div>
                <div class="col-md-9">
                    <label>Resposta:</label>
                </div>
            </div>
                <hr>
                <div class="row mt-2">
                    <div class="col-md-12 scroll">
                        ';
                        //verifica qual a categoria a filtrar
                        $faqs = mysqli_query($conn, "SELECT * from faqs");
                        while($faq = mysqli_fetch_array($faqs)){
                            echo '
                            <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-3">
                                    '.$faq["faq_pergunta"].'
                                </div>
                            <div class="col-md-9">';
                                if (strlen($faq["faq_resposta"])-10 > 50){
                                    echo '<details>
                                        <summary>
                                            Ver Resposta:
                                        </summary>
                                        '.$faq["faq_resposta"].'
                                    </details>';
                                }else{
                                    echo $faq["faq_resposta"];
                                }
                            echo '</div>
                        <input type="hidden" value="'.$faq["faq_id"].'" name="faq_id">
                                    <button type="submit" name="btn_faq" class="form-control btn bg-primary text-white mt-2">Atualizar faq</button><br>
                        </div></form><hr>';
                    }
                echo '
                </div>
            </div>
        </div>
    </div>';
//adiciona aves
if(isset($_POST["faq_inserir"])){
    include 'connections/conn.php';
    mysqli_query($conn, "INSERT INTO faqs(faq_pergunta, faq_resposta) VALUES ('$_POST[faq_pergunta]','$_POST[faq_resposta]')");
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&action=1">';
}
//atualiza aves
if(isset($_POST["faq_atualizar"])){
    include 'connections/conn.php';
    mysqli_query($conn, "UPDATE faqs SET faq_pergunta='$_POST[faq_pergunta]', faq_resposta='$_POST[faq_resposta]' WHERE faq_id = '$_POST[faq_id]'"); 
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&action=1">';
    
}
//elimina aves
if(isset($_POST["faq_eliminar"])){
    mysqli_query($conn, "DELETE FROM faqs WHERE faq_id = '$_POST[faq_id]'");
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&action=1">';
}
?>