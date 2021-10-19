<?php
include 'connections/conn.php';
//Estas querys foto_$ captam as imagens que vão ser utilizadas no banner
$foto_1=mysqli_fetch_array(mysqli_query($conn, "SELECT ban_foto FROM banner WHERE ban_id = '1'"));
$foto_2=mysqli_fetch_array(mysqli_query($conn, "SELECT ban_foto FROM banner WHERE ban_id = '2'"));
$foto_3=mysqli_fetch_array(mysqli_query($conn, "SELECT ban_foto FROM banner WHERE ban_id = '3'"));
//capta todos os dados da empresa juntamente com o nome do distrito, concelho e freguesia
$dados = mysqli_fetch_array(mysqli_query($conn, "SELECT webdados.*, distritos.*, concelhos.*, freguesias.* FROM webdados 
                                                inner join distritos on distritos.distritosid = webdados.wb_distrito 
                                                join concelhos on concelhos.concelhoid = webdados.wb_concelho 
                                                join freguesias on freguesias.freguesiaid = webdados.wb_freguesia"));
echo '
    <h1 style="text-align:center">Dados do Site</h1>
    <form method="post" enctype="multipart/form-data">
        <label>Empresa Nome:</label>
        <input type="text" name="wb_nome" class="form-control" value="'.@$dados["wb_nome"].'" placeholder="Nome da Empresa" aria-label="Nome da Empresa" aria-describedby="basic-addon1">
        <div class="row">
            <div class="col">
                <label>Link Facebook</label>
                <input type="text" name="wb_face" class="form-control" value="'.@$dados["wb_face"].'" placeholder="Facebook" aria-label="Facebook" aria-describedby="basic-addon1">
            </div>
            <div class="col">
                <label>Link Instagram:</label>
                <input type="text" name="wb_insta" class="form-control" value="'.@$dados["wb_insta"].'" placeholder="Instagram" aria-label="Instagram" aria-describedby="basic-addon1">
            </div>
        </div>
        <label>Localização:</label>
        <textarea name="wb_mapa" class="form-control" placeholder="Localização" aria-label="Localizacao" aria-describedby="basic-addon1">'.@$dados["wb_mapa"].'</textarea>
        <div class="row">
            <div class="col">
                <label>Distritos:</label>
                <select name="wb_distrito" id="distrito" class="form-select">
                    <option value="'.@$dados["distritosid"].'">'.@$dados["distrito"].'</option>';
                    lista_distritos();
                echo '</select>
            </div>
            <div class="col">
                <label>Concelhos:</label>
                <select name="wb_concelho" id="concelho" class="form-select">
                <option value="'.$dados["concelhoid"].'">'.$dados["concelho"].'</option>
                </select>
            </div>
            <div class="col">
                <label>Freguesia:</label>
                <select name="wb_freguesia" id="freguesia" class="form-select">
                <option value="'.$dados["freguesiaid"].'">'.$dados["freguesia"].'</option>
                </select>
            </div>
        </div>
        <label>Morada:</label>
        <input type="text" name="wb_morada" class="form-control" value="'.$dados["wb_morada"].'" placeholder="Morada" aria-label="Morada" aria-describedby="basic-addon1">
        <label>Termos e Condições:</label>
        <textarea name="wb_termos" class="form-control" placeholder="Termos & Condições" aria-label="Termos&Condiçoes" aria-describedby="basic-addon1">'.$dados["wb_termos"].'</textarea>
        <label>Telemovel:</label>
        <input type="text" name="wb_contacto" class="form-control" value="'.$dados["wb_contacto"].'" placeholder="Contacto" aria-label="Contacto" aria-describedby="basic-addon1">
        <label>Termos e Condições: </label>
        <textarea id="textarea_bluebird" name="wb_termos" rows="15">'.$dados["wb_termos"].'</textarea>
        <br>
        <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <button type="submit" name="btn_dados" class="btn bg-primary text-white">Atualizar dados</button>
            </div>
        <div class="col-sm-3"></div>
    </form>
    <br>';
    
    echo '<label>Imagens Banner:</label>
        <div class="row">
            <div class="col">
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="ban_foto_1" class="form-control" placeholder="Foto 1" aria-label="Foto 1" aria-describedby="basic-addon1">
                    <br>
                    <button type="submit" name="btn_foto_1" class="btn bg-primary text-white">Atualizar Foto 1</button>
                    <br><img src="assets/img/banner/'.@$foto_1["ban_foto"].'" style="width: 50%; height: 25%">
                </form>
            </div>
            <div class="col">
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="ban_foto_2" class="form-control" placeholder="Foto 2" aria-label="Foto 2" aria-describedby="basic-addon1">
                    <br>
                    <button type="submit" name="btn_foto_2" class="btn bg-primary text-white">Atualizar Foto 2</button>
                    <br><img src="assets/img/banner/'.@$foto_2["ban_foto"].'" style="width: 50%; height: 25%">
                </form>
            </div>
            <div class="col">
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="ban_foto_3" class="form-control" placeholder="Foto 3" aria-label="Foto 3" aria-describedby="basic-addon1">
                    <br>
                    <button type="submit" name="btn_foto_3" class="btn bg-primary text-white">Atualizar Foto 3</button>
                    <br><img src="assets/img/banner/'.@$foto_3["ban_foto"].'" style="width: 50%; height: 25%">
                </form>
            </div>
        </div>
<br>';
if(isset($_POST["btn_dados"])){
    mysqli_query($conn, "UPDATE webdados set wb_nome = '$_POST[wb_nome]', wb_face = '$_POST[wb_face]', wb_insta = '$_POST[wb_insta]', wb_termos='$_POST[wb_termos]', 
    wb_mapa='$_POST[wb_mapa]', wb_distrito = '$_POST[wb_distrito]',  wb_concelho = '$_POST[wb_concelho]', wb_freguesia = '$_POST[wb_freguesia]', 
    wb_morada= '$_POST[wb_morada]', wb_contacto='$_POST[wb_contacto]', wb_termos = '$_POST[wb_termos]' where wb_id = '1'");
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&admin=3">';
}
if(isset($_POST["btn_foto_1"])){
//carregar fotografia
//caminho para carregamento (upload) da foto
$target_dir = "assets/img/banner/";
include 'connections/conn.php';
//saber a foto existente para poder apagar
$prefoto = mysqli_fetch_array(mysqli_query($conn,"SELECT ban_foto FROM banner WHERE ban_id = '1'"));
//apagar a foto antiga
echo $prefoto["ban_foto"];
unlink('assets/img/banner/'.$prefoto["ban_foto"]);
//Qual o ficheiro que queremos carregar $_FILES["nome do campo"]["nome"]
$target_file1 = $target_dir.basename($_FILES["ban_foto_1"]["name"]);
$imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
$foto = basename($_FILES["ban_foto_1"]["name"]);
//carregar a foto CARREGAMENTO DA FOTO move_uploaded
move_uploaded_file($_FILES["ban_foto_1"]["tmp_name"], "assets/img/banner/".$foto);
//guardar o nome na bd
mysqli_query($conn, "UPDATE banner SET ban_foto = '$foto' WHERE ban_id = '1'");
include 'connections/deconn.php';
echo '<meta http-equiv="refresh" content="0;index.php?opt=1&admin=3">';
}
if(isset($_POST["btn_foto_2"])){
//carregar fotografia
//caminho para carregamento (upload) da foto
$target_dir = "assets/img/banner/";
include 'connections/conn.php';
//saber a foto existente para poder apagar
$prefoto = mysqli_fetch_array(mysqli_query($conn,"SELECT ban_foto FROM banner WHERE ban_id = '2'"));
//apagar a foto antiga
unlink('assets/img/banner/'.$prefoto["ban_foto"]);
//Qual o ficheiro que queremos carregar $_FILES["nome do campo"]["nome"]
$target_file1 = $target_dir.basename($_FILES["ban_foto_2"]["name"]);
$imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
$foto = basename($_FILES["ban_foto_2"]["name"]);
//carregar a foto CARREGAMENTO DA FOTO move_uploaded
move_uploaded_file($_FILES["ban_foto_2"]["tmp_name"], "assets/img/banner/".$foto);
//guardar o nome na bd
mysqli_query($conn, "UPDATE banner SET ban_foto = '$foto' WHERE ban_id = '2'");
include 'connections/deconn.php';
echo '<meta http-equiv="refresh" content="0;index.php?opt=1&admin=3">';
}
if(isset($_POST["btn_foto_3"])){
    //carregar fotografia
    //caminho para carregamento (upload) da foto
    $target_dir = "assets/img/banner/";
    include 'connections/conn.php';
    //saber a foto existente para poder apagar
    $prefoto = mysqli_fetch_array(mysqli_query($conn,"SELECT ban_foto FROM banner WHERE ban_id = '3'"));
    //apagar a foto antiga
    unlink('assets/img/banner/'.$prefoto["ban_foto"]);
    //Qual o ficheiro que queremos carregar $_FILES["nome do campo"]["nome"]
    $target_file1 = $target_dir.basename($_FILES["ban_foto_3"]["name"]);
    $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
    $foto = basename($_FILES["ban_foto_3"]["name"]);
    //carregar a foto CARREGAMENTO DA FOTO move_uploaded
    move_uploaded_file($_FILES["ban_foto_3"]["tmp_name"], "assets/img/banner/".$foto);
    //guardar o nome na bd
    mysqli_query($conn, "UPDATE banner SET ban_foto = '$foto' WHERE ban_id = '3'");
    include 'connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&admin=3">';
}