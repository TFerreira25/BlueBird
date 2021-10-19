<?php
echo '
    <h1 style="text-align:center">Aves</h1>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-6 col-xxl-6">';
        //painel para criar produtos
            if(!isset($_POST["btn_ave"])){
                echo '<form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <h3 style="text-align:center">Inserir Ave</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Imagem:</label>
                        <input type="file" name="ave_foto" class="form-control" placeholder="Imagem" aria-label="Imagem" aria-describedby="basic-addon1" required>
                        <label>Anilha:</label>
                        <input type="text" name="ave_anilha" class="form-control" placeholder="Número de Anilha" aria-label="Numero de Anilha" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Preço:</label>
                        <input type="text" name="ave_preco" class="form-control" placeholder="Preço" aria-label="Preço" aria-describedby="basic-addon1" pattern="^[1-9]\d{0,2}(\.\d{3})*,\d{2}$">
                    </div>
                    <div class="col">
                        <label>Posturas:</label>
                        <input type="number" name="ave_postura" class="form-control" placeholder="Posturas" aria-label="Posturas" aria-describedby="basic-addon1">
                    </div>
                    <div class="col">
                        <label>Ano:</label>
                        <input type="date" name="ave_ano" class="form-control" placeholder="Ano" aria-label="Ano" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Está Doente:</label>
                        <select name="ave_doenca" class="form-select">
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select>
                    </div>
                    <div class="col">
                        <label>Nº Gaiola:</label>
                        <input type="number" name="ave_gaiola" class="form-control" placeholder="Nº Gaiola" aria-label="Gaiola" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Espécie:</label>
                        <select name="ave_especie" id="especie" class="form-select w-100" required>
                            <option disabled selected value="0">Espécie</option>';
                            lista_especie();
                        echo '</select>
                    </div>
                    <div class="col">
                        <label>Variedade:</label>
                        <select name="ave_variedade" id="variedade" class="form-select w-100" required>
                            <option disabled selected value="0">Variedade</option>
                        </select>
                    </div>
                    <div class="col">
                        <label>Mutação:</label>
                        <select name="ave_mutacao" id="mutacao" class="form-select w-100" required>
                            <option disabled selected value="0">Mutação</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Género:</label>
                        <select name="ave_genero" class="form-select" style="widht: 100%">
                            <option value="1">Macho</option>
                            <option value="2">Fêmea</option>
                        </select>
                    </div>
                    <div class="col">
                        <label>Estado:</label>
                        <select name="ave_estado" class="form-select" style="widht: 100%" required>
                            <option value="1">Para Venda</option>
                            <option value="2">Para Empréstimo</option>
                            <option value="3">Indisponivel</option>
                            <option value="4">Perdido</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col">
                        <label>Informação adicional(Doenças que já teve, etc.): </label>
                        <textarea id="textarea_bluebird" name="ave_doenca_desc" rows="15"></textarea>
                    </div>
                </div>
                <br><button type="submit" name="ave_adicionar" class="form-control mt-2 btn bg-primary text-white">Inserir Ave</button><br>
                </form><br>';
            }
            //painel para editar categorias
            if(isset($_POST["btn_ave"])){
                $ave = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ave where ave_id = '$_POST[ave_id]'"));
                $av = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ave inner join especie on especie.esp_id = ave.ave_especie 
                join variedade on ave.ave_variedade = variedade.var_id
                join mutacao on ave.ave_mutacao = mutacao.mut_id
                where ave_id = '$_POST[ave_id]'"));
                echo '<form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <h3 style="text-align:center">Alterar Ave</h3>
                    </div>
                    <div class="col">
                    <button class="form-control bg-primary text-white">Voltar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Imagem:</label>
                        <input type="file" name="ave_foto" class="form-control" placeholder="Imagem" aria-label="Imagem" aria-describedby="basic-addon1">
                        <label>Anilha:</label>
                        <input type="text" name="ave_anilha" value="'.$ave["ave_anilha"].'" class="form-control" placeholder="Número de Anilha" aria-label="Numero de Anilha" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Preço:</label>
                        <input type="text" name="ave_preco" value="'.$ave["ave_preco"].'" class="form-control" placeholder="Preço" aria-label="Preço" aria-describedby="basic-addon1">
                    </div>
                    <div class="col">
                        <label>Posturas:</label>
                        <input type="number" name="ave_postura" value="'.$ave["ave_postura"].'" class="form-control" placeholder="Posturas" aria-label="Posturas" aria-describedby="basic-addon1">
                    </div>
                    <div class="col">
                        <label>Ano:</label>
                        <input type="date" name="ave_ano" value="'.$ave["ave_ano"].'" class="form-control" placeholder="Ano" aria-label="Ano" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Está Doente:</label>
                        <select name="ave_doenca" class="form-select">
                            <option value="'.$ave["ave_doenca"].'">';
                            switch($ave["ave_doenca"]){
                                case 0:
                                    echo "Não";
                                    break;
                                case 1:
                                    echo "Sim";
                                    break;
                            }
                            echo '</option>
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select>
                    </div>
                    <div class="col">
                        <label>Nº Gaiola:</label>
                        <input type="number" value="'.$ave["ave_num_gaiola"].'" name="ave_gaiola" class="form-control" placeholder="Nº Gaiola" aria-label="Gaiola" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Especie:</label>
                        <select name="ave_especie" id="especie" class="form-select w-100">
                        <option value="'.$av["ave_especie"].'">'.$av["esp_nome"].'</option>';
                            lista_especie();
                        echo '</select>
                    </div>
                    <div class="col">
                        <label>Variedade:</label>
                        <select name="ave_variedade" id="variedade" class="form-select w-100">
                        <option value="'.$av["ave_variedade"].'">'.$av["var_nome"].'</option>
                        </select>
                    </div>
                    <div class="col">
                        <label>Mutação:</label>
                        <select name="ave_mutacao" id="mutacao" class="form-select w-100">
                        <option value="'.$av["ave_mutacao"].'">'.$av["mut_nome"].'</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Género:</label>
                        <select name="ave_genero" class="form-select" style="widht: 100%">
                        <option value="'.$ave["ave_genero"].'">';
                            switch($ave["ave_genero"]){
                                case 1:
                                    echo "Macho";
                                    break;
                                case 2:
                                    echo "Fêmea";
                                    break;
                            }
                            echo '</option>
                            <option value="1">Macho</option>
                            <option value="2">Fêmea</option>
                        </select>
                    </div>
                    <div class="col">
                        <label>Estado:</label>
                        <select name="ave_estado" class="form-select" style="widht: 100%">
                        <option value="'.$ave["ave_estado"].'">';
                            switch($ave["ave_estado"]){
                                case 1:
                                    echo 'Para Venda</option>
                                    <option value="2">Para Empréstimo</option>
                                    <option value="3">Indisponivel</option>
                                    <option value="4">Perdido</option>';
                                    break;
                                case 2:
                                    echo 'Para Empréstimo</option>
                                    <option value="1">Para Venda</option>
                                    <option value="3">Indisponivel</option>
                                    <option value="4">Perdido</option>';
                                    break;
                                case 3:
                                    echo 'Indisponivel</option>
                                    <option value="1">Para Venda</option>
                                    <option value="2">Para Empréstimo</option>
                                    <option value="4">Perdido</option>';
                                    break;
                                case 4:
                                    echo 'Perdido</option>
                                    <option value="1">Para Venda</option>
                                    <option value="2">Para Empréstimo</option>
                                    <option value="3">Indisponivel</option>
                                    ';
                                    break;
                            }
                        echo '</select>
                    </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col">
                        <label>Informação adicional(Doenças que já teve, etc.): </label>
                        <!--<textarea id="ckeditor" class="form-control bg-primary" name="ave_doenca_desc">'.$ave['ave_doenca_desc'].'</textarea>-->
                        <textarea id="textarea_bluebird" name="ave_doenca_desc" rows="15" class="pt-2 bg-primary">'.$ave['ave_doenca_desc'].'</textarea>
                    </div>
                </div>
                <input type="hidden" value="'.$ave["ave_id"].'" name="ave_id">
                <div class="col">
                <br><button type="submit" name="ave_atualizar" class="form-control mt-2 btn bg-primary text-white">Atualizar Dados</button><br>
                </div>
                <div class="col">
                <br><button type="submit" name="ave_eliminar" class="form-control mt-2 btn bg-danger text-white">Eliminar Ave</button><br>
                </div>
                </form><br>';
            }
        echo '
        </div>
        <div class="col-sm-12 col-md-12 col-xl-6 col-xxl-6">
            <form method="post">
                <div class="row">
                    <div class="col-md-9">
                        <input type="number" name="ave_pesq" class="form-control text-primary" Placeholder="Insira aqui o número da Ave">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" name="pesq_ave" class="form-control bg-primary text-white">Pesquisar</button>
                    </div>
                </div>
            </form>
            <div class="row mt-1">
                <div class="col">
                    <label>Foto:</label>
                </div>
                <div class="col">
                    <label>Ave:</label>
                </div>
                <div class="col">
                    <label>Espécie:</label>
                </div>
                <div class="col">
                    <label>Preço:</label>
                </div>
                <div class="col">
                    <label>Outros:</label>
                </div>
                <!--<div class="col">
                    <label>Link Editar:</label>
                </div>-->
            </div>
            <hr>
            <div class="row mt-2">
                <div class="col-md-12 scroll">
                    ';
                    //verifica qual a categoria a filtrar
                    if(@isset($_POST["pesq_ave"]) and $_POST["ave_pesq"]){
                        $aves = mysqli_query($conn, "SELECT * FROM ave
                        where ave_log_id = '$_SESSION[log_id]' and ave_id = '$_POST[ave_pesq]'");
                        $avs = mysqli_query($conn, "SELECT * FROM ave inner join especie on especie.esp_id = ave.ave_especie 
                        join variedade on ave.ave_variedade = variedade.var_id
                        join mutacao on ave.ave_mutacao = mutacao.mut_id
                        where ave_log_id = '$_SESSION[log_id]' and ave_id = '$_POST[ave_pesq]'");
                        if(mysqli_num_rows($aves) == 0){
                            echo '<h4 class="text-primary">Sem resultados</h4>';
                        }
                    }else{
                        $aves = mysqli_query($conn, "SELECT * FROM ave where ave_log_id = '$_SESSION[log_id]'");
                        $avs = mysqli_query($conn, "SELECT * FROM ave inner join especie on especie.esp_id = ave.ave_especie 
                        join variedade on ave.ave_variedade = variedade.var_id
                        join mutacao on ave.ave_mutacao = mutacao.mut_id
                        where ave_log_id = '$_SESSION[log_id]'");
                    }
                    
                    while($ave = mysqli_fetch_array($aves)){
                        echo '<form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    <img src="assets/img/aves/'.$ave["ave_foto"].'" alt="'.$ave["ave_anilha"].'" style="widht: 100px; height: 100px">
                                </div>
                                <div class="col">
                                    <b>Nº de Ave:</b>: '.$ave["ave_id"].'<br>
                                    <b>Anilha</b>: '.$ave["ave_anilha"].'<br><b>Género</b>: ';
                                    switch($ave["ave_genero"]){
                                        case 1:
                                            echo "Macho";
                                            break;
                                        case 2:
                                            echo "Fêmea";
                                            break;
                                    }
                                    echo '<br><b>Ano</b>: '.$ave["ave_ano"].'
                                </div>
                                <div class="col">';
                                    $a = mysqli_fetch_array($avs);
                                    echo '<b>Espécie</b>: '.@$a["esp_nome"].'<br><b>Variedade</b>: '.@$a["var_nome"].'<br><b>Mutação</b>: '.@$a["mut_nome"];
                                echo '</div>
                                <div class="col">
                                    <b>Preço</b>: '; 
                                    if ($ave["ave_preco"] == ""){
                                        echo 'Sem Valor';
                                    }else{
                                        echo $ave["ave_preco"].'€';
                                    }
                                echo '</div>
                                <div class="col">
                                    <b>Número de gaiola</b>: '.$ave["ave_num_gaiola"].'<br><b>Estado</b>: ';
                                    switch($ave["ave_estado"]){
                                        case 1:
                                            echo "Venda";
                                            break;
                                        case 2:
                                            echo "Empréstimo";
                                            break;
                                        case 3:
                                            echo "Indisponível";
                                            break;
                                        case 4:
                                            echo "Perdido";
                                            break;
                                    }
                                    echo'<br><b>Posturas</b>: '.$ave["ave_postura"].'<br><b>Doente?</b> ';
                                    switch($ave["ave_doenca"]){
                                        case 0:
                                            echo "Não";
                                            break;
                                        case 1:
                                            echo "Sim";
                                            break;
                                    }
                                    echo'
                                </div>
                                <div class="col-md-12">';
                                if ($ave["ave_doenca_desc"] != ""){
                                    echo '<details>
                                        <summary>
                                            Descrição:
                                        </summary>
                                        '.$ave["ave_doenca_desc"].'
                                    </details>';
                                }
                                echo '
                                </div>
                                <input type="hidden" value="'.$ave["ave_id"].'" name="ave_id">
                                <button type="submit" name="btn_ave" class="form-control btn bg-primary text-white mt-2">Atualizar Ave</button><br>
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
if(isset($_POST["ave_adicionar"])){
    include 'connections/conn.php';
    $id = mysqli_fetch_array(mysqli_query($conn, "Select ave_id from ave order by ave_id desc limit 1"));
    $nome = $id["ave_id"] + 1;
    $target_dir = "assets/img/aves/";
    $target_file1 = $target_dir.basename($_FILES["ave_foto"]["name"]);
    $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
    $foto = $_SESSION["log_id"].$nome.basename($_FILES["ave_foto"]["name"]);
    move_uploaded_file($_FILES["ave_foto"]["tmp_name"], "assets/img/aves/".$foto);
    if($_POST["ave_especie"] == "" && $_POST["ave_mutacao"] == "" && $_POST["ave_variedade"] == ""){
        $estado = 4;
    }else{
        $estado = $_POST["ave_estado"];
    }
    mysqli_query($conn, "INSERT INTO ave (ave_especie, ave_anilha, ave_genero, ave_variedade, 
    ave_mutacao, ave_ano, ave_num_gaiola, ave_estado, ave_preco, ave_postura, 
    ave_doenca, ave_foto, ave_doenca_desc, ave_log_id) 
    VALUES ('$_POST[ave_especie]','$_POST[ave_anilha]','$_POST[ave_genero]','$_POST[ave_variedade]'
    ,'$_POST[ave_mutacao]','$_POST[ave_ano]','$_POST[ave_gaiola]','$estado','$_POST[ave_preco]','$_POST[ave_postura]'
    ,'$_POST[ave_doenca]','$foto','$_POST[ave_doenca_desc]', '$_SESSION[log_id]')");
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&action=2">';
    include 'connections/deconn.php';
}
//atualiza aves
if(isset($_POST["ave_atualizar"])){
    include 'connections/conn.php';
    $editar=@$_POST["ave_id"];
    $prefoto = mysqli_fetch_array(mysqli_query($conn,"SELECT ave_foto FROM ave WHERE ave_id = '$editar'"));
    $target_dir = "assets/img/aves/";
    $target_file1 = $target_dir.basename($_FILES["ave_foto"]["name"]);
    $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
    $foto = basename($_FILES["ave_foto"]["name"]);
    if($foto != ''){
        unlink('assets/img/aves/'.$prefoto["ave_foto"]);
        
        move_uploaded_file($_FILES["ave_foto"]["tmp_name"], "assets/img/aves/".$_SESSION["log_id"].$editar.$foto);
        $foto = $_SESSION["log_id"].$editar.$foto;
        mysqli_query($conn, "UPDATE ave SET ave_foto = '$foto' where ave_id = '$editar'"); 
    }
    mysqli_query($conn, "UPDATE ave SET ave_especie='$_POST[ave_especie]',
    ave_anilha='$_POST[ave_anilha]', ave_genero='$_POST[ave_genero]', ave_variedade='$_POST[ave_variedade]', ave_mutacao='$_POST[ave_mutacao]',
    ave_ano='$_POST[ave_ano]', ave_num_gaiola='$_POST[ave_gaiola]', ave_estado='$_POST[ave_estado]', ave_preco='$_POST[ave_preco]',
    ave_postura='$_POST[ave_postura]', ave_doenca='$_POST[ave_doenca]', ave_doenca_desc = '$_POST[ave_doenca_desc]'
    where ave_id = '$editar'"); 
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&action=2">';
    include 'connections/deconn.php';
}
//elimina aves
if(isset($_POST["ave_eliminar"])){
    $editar=@$_POST["ave_id"];
    include 'connections/conn.php';
    $prefoto = mysqli_fetch_array(mysqli_query($conn,"SELECT ave_foto FROM ave WHERE ave_id = '$editar'"));
    unlink('assets/img/aves/'.$prefoto["ave_foto"]);
    mysqli_query($conn, "DELETE FROM ave WHERE ave_id = '$editar'");
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&action=2">';
}
?>