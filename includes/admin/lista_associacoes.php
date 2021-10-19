<div class="row">
    <div class="col-sm-12 col-md-12 col-xl-6 col-xxl-6">
        <?php
        if(!isset($_POST["btn_update"])){
        echo '<form method="post" enctype="multipart/form-data">
            <div class="mb-md-5 mt-md-4 pb-5">
                <h2 class="fw-bold mb-2 text-uppercase">Inserção de Clube ou Associação</h2>
                <div class="form-outline form-primary mb-4">
                    <input type="text" name="ass_nome" class="form-control form-control-lg" placeholder="Nome da Associação ou Clube"/>
                </div>
                <div class="form-outline form-primary mb-4">
                    <input type="text" name="ass_morada" class="form-control form-control-lg" placeholder="Morada" />
                </div>
                <div class="form-outline form-primary mb-4">
                    <input type="text" name="ass_telefone" class="form-control form-control-lg" placeholder="Telefone"/>
                </div>
                <div class="form-outline form-primary mb-4">
                    <input type="text" name="ass_fax" class="form-control form-control-lg email" placeholder="FAX"/>
                </div>
                <div class="form-outline form-primary mb-4">
                    <input type="text" name="ass_site" class="form-control form-control-lg password" placeholder="Site"/>
                </div>
                <div class="form-outline form-primary mb-4">
                    <input type="email" name="ass_email" class="form-control form-control-lg" placeholder="Email"/>
                </div>
                <div class="form-outline form-primary mb-4">
                    <input type="text" name="ass_foto" class="form-control form-control-lg" placeholder="Foto" onfocus="(this.type=\'file\')"/>
                </div>
                <div class="form-outline form-primary mb-4">
                    <input type="text" name="ass_facebook" class="form-control form-control-lg" placeholder="Facebook"/>
                </div>
                <div class="form-outline form-primary mb-4">
                    <select class="form-control bg-white" name="slc_cargo">
                        <option disabled selected value="0">Tipo de Associação</option>
                        <option value="0">Columbófila</option>
                        <option value="1">Ornitológica</option>
                    </select>
                </div>      
                <button type="submit" class="btn btn-primary btn-lg px-5" name="btn_adicionar">Inserir</button>
            </div>
        </form>';
        }else if (isset($_POST["btn_update"])){
            $dados = mysqli_fetch_array(mysqli_query($conn, "SELECT * from sociedade where soc_id = '$_POST[soc_id]'"));
            echo '
            <form method="post" enctype="multipart/form-data">
                <div class="mb-md-5 mt-md-4 pb-5">
                    <div class="Row">
                        <div class="col">
                            <h2 class="fw-bold mb-2 text-uppercase">Atualização</h2>
                        </div>
                        <div class="col">
                            <button type="submit" name="voltar" class="form-control mt-2 btn bg-primary text-white">Voltar</button>
                        </div>
                    </div>
                   
                    <div class="form-outline form-primary mb-4">
                        <input type="text" name="ass_nome" value="'.$dados["soc_nome"].'" class="form-control form-control-lg" placeholder="Nome da Associação ou Clube"/>
                    </div>
                    <div class="form-outline form-primary mb-4">
                        <input type="text" name="ass_morada" value="'.$dados["soc_morada"].'" class="form-control form-control-lg" placeholder="Morada"/>
                    </div>
                    <div class="form-outline form-primary mb-4">
                        <input type="text" name="ass_telefone" value="'.$dados["soc_telefone"].'" class="form-control form-control-lg" placeholder="Telefone"/>
                    </div>
                    <div class="form-outline form-primary mb-4">
                        <input type="text" name="ass_fax" value="'.$dados["soc_fax"].'" class="form-control form-control-lg email" placeholder="FAX"/>
                    </div>
                    <div class="form-outline form-primary mb-4">
                        <input type="text" name="ass_site" value="'.$dados["soc_site"].'" class="form-control form-control-lg password" placeholder="Site"/>
                    </div>
                    <div class="form-outline form-primary mb-4">
                        <input type="email" name="ass_email" value="'.$dados["soc_email"].'" class="form-control form-control-lg" placeholder="Email"/>
                    </div>
                    <div class="form-outline form-primary mb-4">
                        <input type="text" name="ass_foto" class="form-control form-control-lg" placeholder="Foto" onfocus="(this.type=\'file\')"/>
                    </div>
                    <div class="form-outline form-primary mb-4">
                        <input type="text" name="ass_facebook" value="'.$dados["soc_facebook"].'" class="form-control form-control-lg" placeholder="Facebook"/>
                    </div>
                    <div class="form-outline form-primary mb-4">
                        <select class="form-control bg-white" name="slc_cargo">';
                            switch($dados["soc_tipo"]){
                                case '0':
                                    echo '
                                    <option value="'.$dados["soc_tipo"].'">Columbófila</option>
                                    <option value="1">Ornitológica</option>
                                    ';

                                    break;
                                case '1':
                                    echo '
                                    <option value="'.$dados["soc_tipo"].'">Ornitológica</option>
                                    <option value="0">Columbófila</option>
                                    ';;
                                    break;
                            }
                            echo '
                        </select>
                    </div>
                    <input type="hidden" value="'.$dados["soc_id"].'" name="soc_id">
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-lg px-5" name="btn_atualizar">Atualizar</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-danger btn-lg px-5 mt-2" name="btn_eliminar">Eliminar</button>
                        </div>
                    </div>
                </div>
            </form>';
        }
        ?>
    </div>
    <div class="col-sm-12 col-md-12 col-xl-6 col-xxl-6">
        <div class="row">
            <div class="col-md-6 text-center" id="columbofila">
                <button type="button" class="form-control bg-primary text-white">Associações Columbófilas</button>
            </div>
            <div class="col-md-6  text-center" id="ornitologica">
                <button type="button" class="form-control bg-primary text-white">Associações Ornitológicas</button>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12 scroll" id="columbofila_result">
            <?php
                $columbofila = mysqli_query($conn, "SELECT * from sociedade where soc_tipo = 0");
                while($colum = mysqli_fetch_array($columbofila)){
                    echo '
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <img src="assets/img/associacoes/'.$colum["soc_foto"].'" alt="'.$colum["soc_nome"].'" style="widht: 100px; height: 100px">
                            </div>
                            <div class="col-md-9">
                                <b>Nome: </b><label>'.$colum["soc_nome"].'</label><br>
                                <b>Morada: </b><label>'.$colum["soc_morada"].'</label><br>
                                <b>Telefone: </b><label>'.$colum["soc_telefone"].'</label><br>
                                <b>FAX: </b><label>'.$colum["soc_fax"].'</label><br>
                                <b>Site: </b><label>'.$colum["soc_site"].'</label><br>
                                <b>Email: </b><label>'.$colum["soc_email"].'</label><br>
                                <b>Facebook: </b><label>'.$colum["soc_facebook"].'</label><br>
                                <input type="hidden" value="'.$colum["soc_id"].'" name="soc_id">
                                <button type="submit" name="btn_update" class="form-control bg-primary text-white">Atualizar</button>
                            </div>
                        </div>
                    </form><hr>';
                }
            ?>
            </div>
            <div class="col-md-12 scroll" id="ornitologica_result">
            <?php
                $ornitologica = mysqli_query($conn, "SELECT * from sociedade where soc_tipo = 1");
                while($ornit = mysqli_fetch_array($ornitologica)){
                    echo '
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <img src="assets/img/associacoes/'.$ornit["soc_foto"].'" alt="'.$ornit["soc_nome"].'" style="widht: 100px; height: 100px">
                            </div>
                            <div class="col-md-9">
                                <b>Nome: </b><label>'.$ornit["soc_nome"].'</label><br>
                                <b>Morada: </b><label>'.$ornit["soc_morada"].'</label><br>
                                <b>Telefone: </b><label>'.$ornit["soc_telefone"].'</label><br>
                                <b>FAX: </b><label>'.$ornit["soc_fax"].'</label><br>
                                <b>Site: </b><label>'.$ornit["soc_site"].'</label><br>
                                <b>Email: </b><label>'.$ornit["soc_email"].'</label><br>
                                <b>Facebook: </b><label>'.$ornit["soc_facebook"].'</label><br>
                                <input type="hidden" value="'.$ornit["soc_id"].'" name="soc_id">
                                <button type="submit" name="btn_update" class="form-control bg-primary text-white">Atualizar</button>
                            </div>
                        </div>
                    </form>
                    <hr>';
                }
            ?>
            </div>
        </div>
    </div>
</div>
<?php

if(@isset($_POST["btn_adicionar"])){
    //carregar fotografia
    //caminho para carregamento (upload) da foto
    $target_dir = "assets/img/associacoes/";
    include 'connections/conn.php';
    //Qual o ficheiro que queremos carregar $_FILES["nome do campo"]["nome"]
    $target_file1 = $target_dir.basename($_FILES["ass_foto"]["name"]);
    $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
    $foto = basename($_FILES["ass_foto"]["name"]);
    //carregar a foto CARREGAMENTO DA FOTO move_uploaded
    move_uploaded_file($_FILES["ass_foto"]["tmp_name"], "assets/img/associacoes/".$foto);
    //guardar o nome na bd
    mysqli_query($conn, "INSERT INTO sociedade(soc_nome, soc_foto, soc_morada, soc_telefone, soc_fax, soc_site, soc_email, soc_facebook, soc_tipo) 
    VALUES ('$_POST[ass_nome]','$foto','$_POST[ass_morada]','$_POST[ass_telefone]','$_POST[ass_fax]','$_POST[ass_site]'
    ,'$_POST[ass_email]','$_POST[ass_facebook]','$_POST[slc_cargo]')");
    include 'connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&admin=2">';
}
//atualiza aves
if(@isset($_POST["btn_atualizar"])){
    include 'connections/conn.php';
    $editar=@$_POST["soc_id"];
    $prefoto = mysqli_fetch_array(mysqli_query($conn,"SELECT soc_foto FROM sociedade WHERE soc_id = '$editar'"));
    $target_dir = "assets/img/associacoes/";
    $target_file1 = $target_dir.basename($_FILES["ass_foto"]["name"]);
    $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
    $foto = basename($_FILES["ass_foto"]["name"]);
    if($foto != ''){
        unlink('assets/img/associacoes/'.$prefoto["soc_foto"]);
        move_uploaded_file($_FILES["ass_foto"]["tmp_name"], "assets/img/associacoes/".$foto);
        mysqli_query($conn, "UPDATE sociedade SET soc_foto = '$foto' where soc_id = '$editar'"); 
    }
    mysqli_query($conn, "UPDATE sociedade SET soc_nome = '$_POST[ass_nome]',
     soc_morada = '$_POST[ass_morada]', soc_telefone = '$_POST[ass_telefone]', soc_fax = '$_POST[ass_fax]', soc_site = '$_POST[ass_site]',
     soc_email = '$_POST[ass_email]', soc_facebook = '$_POST[ass_facebook]', soc_tipo= '$_POST[slc_cargo]'
    where soc_id = '$editar'"); 
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&admin=2">';
    include 'connections/deconn.php';
}
//elimina aves
if(@isset($_POST["btn_eliminar"])){
    $editar=@$_POST["soc_id"];
    include 'connections/conn.php';
    $prefoto = mysqli_fetch_array(mysqli_query($conn,"SELECT soc_foto FROM sociedade WHERE soc_id = '$editar'"));
    unlink('assets/img/associacoes/'.$prefoto["soc_foto"]);
    mysqli_query($conn, "DELETE FROM sociedade WHERE soc_id = '$editar'");
    echo '<meta http-equiv="refresh" content="0;index.php?opt=1&admin=2">';
}

?>