<?php
echo '
    <h1 style="text-align:center">Alimentação recomendada:</h1>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-6 col-xxl-6">';
        //painel para criar produtos
            if(!isset($_POST["btn_ave"])){
                echo '<form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <h3 style="text-align:center">Inserir Alimentação</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Espécie:</label>
                        <select name="aliment_especie" id="especie" class="form-select w-100">
                            <option disabled selected value="0">Espécie</option>';
                            lista_especie();
                        echo '</select>
                    </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col">
                        <label>Insira a alimentação recomenda:</label>
                        <textarea id="textarea_bluebird" class="form-control" name="aliment_comida" rows="15"></textarea>
                    </div>
                </div>
                <br><button type="submit" name="comida_adicionar" class="form-control mt-2 btn bg-primary text-white">Inserir</button><br>
                </form><br>';
            }
            //painel para editar categorias
            if(isset($_POST["btn_ave"])){
                $esp = mysqli_fetch_array(mysqli_query($conn, "SELECT * from especie inner join alimentar_recomendada on aliment_rec_esp_id = especie.esp_id where aliment_rec_esp_id = '$_POST[aliment_rec_esp_id]'"));
                echo '<form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <h3 style="text-align:center">Atualizar Alimentação</h3>
                    </div>
                    <div class="col">
                        <button type="submit" name="voltar" class="form-control mt-2 btn bg-primary text-white">Voltar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Espécie:</label>
                        <select name="aliment_especie" id="especie" class="form-select w-100">
                            <option selected value="'.$esp["esp_id"].'">'.$esp["esp_nome"].'</option>';
                            include 'connections/conn.php';
                            $especies = mysqli_query($conn, "SELECT * from especie where esp_id != '$esp[esp_id]'");
                            while ($especie = mysqli_fetch_array($especies)){
                                echo '<option value="'.$especie["esp_id"].'">'.$especie["esp_nome"].'</option>';
                            }
                        echo '</select>
                    </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col">
                        <label>Insira a alimentação recomenda:</label>
                        <textarea id="textarea_bluebird" class="form-control" name="aliment_comida" rows="15">'.$esp["aliment_rec_comida"].'</textarea>
                    </div>
                </div>
                <input type="hidden" value="'.$esp["esp_id"].'" name="aliment_rec_esp_id">
                <br><button type="submit" name="comida_atualizar" class="form-control mt-2 btn bg-primary text-white">Atualizar Alimentação</button><br>
                <br><button type="submit" name="comida_eliminar" class="form-control mt-2 btn bg-danger text-white">Eliminar Alimentação</button><br>
                </form><br>';
            }
        echo '</div>
        <div class="col-sm-12 col-md-12 col-xl-6 col-xxl-6">
            <div class="row">
                <div class="col-md-3">
                    <label>Espécie:</label>
                </div>
                <div class="col-md-9">
                    <label>Alimento:</label>
                </div>
            </div>
                <hr>
            <div class="row mt-2">
                <div class="col-md-12 scroll">
                    ';
                    //verifica qual a categoria a filtrar
                    $especie = mysqli_query($conn, "SELECT * from especie inner join alimentar_recomendada on aliment_rec_esp_id = especie.esp_id");
                    while($esp = mysqli_fetch_array($especie)){
                        echo '
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-3">
                                '.$esp["esp_nome"].'
                            </div>
                            <div class="col-md-9">';
                                if (strlen($esp["aliment_rec_comida"])-10 > 50){
                                    echo '<details>
                                        <summary>
                                            Ver Alimentação:
                                        </summary>
                                        '.$esp["aliment_rec_comida"].'
                                    </details>';
                                }else{
                                    echo $esp["aliment_rec_comida"];
                                }
                            echo '
                            </div>
                            <input type="hidden" value="'.$esp["esp_id"].'" name="aliment_rec_esp_id">
                            <button type="submit" name="btn_ave" class="form-control btn bg-primary text-white mt-2">Atualizar</button><br>
                        </div>
                    </form>
                    <hr>';
                }
                echo '
                </div>
            </div>
        </div>
    </div>';
//adiciona aves
if(isset($_POST["comida_adicionar"])){
    include 'connections/conn.php';
    $pre_aliment = mysqli_fetch_array(mysqli_query($conn, "Select * from alimentar_recomendada where aliment_rec_esp_id = '$_POST[aliment_especie]'"));
    $aliment_desc = '';
    if(@$pre_aliment["aliment_rec_esp_id"] != ''){
        echo $_POST["aliment_especie"];
        $aliment_comida = @$pre_aliment["aliment_rec_comida"].' '.$_POST["aliment_comida"];
        mysqli_query($conn, "UPDATE alimentar_recomendada SET aliment_rec_esp_id ='$_POST[aliment_especie]', aliment_rec_comida='$aliment_comida' WHERE aliment_rec_esp_id = '$_POST[aliment_especie]'");
    }else{
        mysqli_query($conn, "INSERT INTO alimentar_recomendada (aliment_rec_esp_id, aliment_rec_comida) VALUES ('$_POST[aliment_especie]','$_POST[aliment_comida]')");
    }
    include 'connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&action=2">';
}
//atualiza aves
if(isset($_POST["comida_atualizar"])){
    include 'connections/conn.php';
    mysqli_query($conn, "UPDATE alimentar_recomendada SET aliment_rec_esp_id='$_POST[aliment_especie]', aliment_rec_comida='$_POST[aliment_comida]' WHERE aliment_rec_esp_id = '$_POST[aliment_rec_esp_id]'"); 
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&action=2">';
    include 'connections/deconn.php';
}
//elimina aves
if(isset($_POST["comida_eliminar"])){
    mysqli_query($conn, "DELETE FROM alimentar_recomendada WHERE aliment_rec_esp_id = '$_POST[aliment_rec_esp_id]'");
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&action=2">';
}
?>