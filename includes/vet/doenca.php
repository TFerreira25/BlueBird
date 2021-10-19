<?php
echo '
    <h1 style="text-align:center">Doenças mais comuns:</h1>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-6 col-xxl-6">';
        //painel para criar produtos
            if(!isset($_POST["btn_ave"])){
                echo '<form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <h3 style="text-align:center">Inserir doença:</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Espécie:</label>
                        <select name="doenca_especie" id="especie" class="form-select w-100">
                            <option disabled selected value="0">Espécie</option>';
                            lista_especie();
                        echo '</select>
                    </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col">
                        <label>Insira a doença:</label>
                        <textarea id="textarea_bluebird" class="form-control" name="doenca_desc" rows="15"></textarea>
                    </div>
                </div>
                <br><button type="submit" name="doenca_adicionar" class="form-control mt-2 btn bg-primary text-white">Inserir doença</button><br>
                </form><br>';
            }
            //painel para editar categorias
            if(isset($_POST["btn_ave"])){
                $esp = mysqli_fetch_array(mysqli_query($conn, "SELECT * from especie inner join doenca on doenca_esp = especie.esp_id where doenca_esp = '$_POST[doenca_esp]'"));
                echo '<form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <h3 style="text-align:center">Atualizar</h3>
                    </div>
                    <div class="col">
                        <button type="submit" name="voltar" class="form-control mt-2 btn bg-primary text-white">Voltar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Espécie:</label>
                        <select name="doenca_especie" id="especie" class="form-select w-100">
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
                        <label>Insira as doenças:</label>
                        <textarea id="textarea_bluebird" class="form-control" name="doenca_desc" rows="15">'.$esp["doenca_desc"].'</textarea>
                    </div>
                </div>
                <input type="hidden" value="'.$esp["esp_id"].'" name="doenca_esp">
                <br><button type="submit" name="doenca_atualizar" class="form-control mt-2 btn bg-primary text-white">Atualizar doenças</button><br>
                <br><button type="submit" name="doenca_eliminar" class="form-control mt-2 btn bg-danger text-white">Eliminar doenças</button><br>
                </form><br>';
            }
        echo '</div>
        <div class="col-sm-12 col-md-12 col-xl-6 col-xxl-6">
            <div class="row">
                <div class="col">
                    <label>Espécie:</label>
                </div>
                <div class="col">
                    <label>Doenças:</label>
                </div>
            </div>
                <hr>
            <div class="row mt-2">
                <div class="col-md-12 scroll">
                        ';
                        //verifica qual a categoria a filtrar
                        $especie = mysqli_query($conn, "SELECT * from especie inner join doenca on doenca_esp = especie.esp_id where doenca_desc != ''");
                        while($esp = mysqli_fetch_array($especie)){
                            echo '
                            <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    '.$esp["esp_nome"].'
                                </div>
                            <div class="col">';
                            if (strlen($esp["doenca_desc"])-10 > 50){
                                echo '<details>
                                    <summary>
                                        Ver Doença:
                                    </summary>
                                    '.$esp["doenca_desc"].'
                                </details>';
                            }else{
                                echo $esp["doenca_desc"];
                            }
                            echo '</div>
                        <input type="hidden" value="'.$esp["esp_id"].'" name="doenca_esp">
                                    <button type="submit" name="btn_ave" class="form-control btn bg-primary text-white mt-2">Atualizar</button><br>
                        </div></form><hr>';
                    }
                echo '
                </div>
            </div>
        </div>
    </div>';
//adiciona aves
if(isset($_POST["doenca_adicionar"])){
    include 'connections/conn.php';
    $pre_doenca = mysqli_fetch_array(mysqli_query($conn, "Select * from doenca where doenca_esp = '$_POST[doenca_especie]'"));
    $doenca_desc = '';
    if(@$pre_doenca["doenca_esp"] != ''){
        $doenca_desc = @$pre_doenca["doenca_desc"].' '.$_POST["doenca_desc"];
        mysqli_query($conn, "UPDATE doenca SET doenca_esp='$pre_doenca[doenca_esp]', doenca_desc='$doenca_desc' WHERE doenca_esp = '$pre_doenca[doenca_esp]'"); 
    }else{
        mysqli_query($conn, "INSERT INTO doenca (doenca_esp, doenca_desc) VALUES ('$_POST[doenca_especie]','$_POST[doenca_desc]')");
    }
    include 'connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&action=3">';
}
//atualiza aves
if(isset($_POST["doenca_atualizar"])){
    include 'connections/conn.php';
    mysqli_query($conn, "UPDATE doenca SET doenca_esp='$_POST[doenca_especie]', doenca_desc='$_POST[doenca_desc]' WHERE doenca_esp = '$_POST[doenca_esp]'"); 
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&action=3">';
    include 'connections/deconn.php';
}
//elimina aves
if(isset($_POST["doenca_eliminar"])){
    mysqli_query($conn, "DELETE FROM doenca WHERE doenca_esp = '$_POST[doenca_esp]'");
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&action=3">';
}
?>