<?php
include 'connections/conn.php';
$ut = mysqli_fetch_array(mysqli_query($conn, "SELECT * from utilizador inner join login on utilizador.uti_log_id = login.log_id  where utilizador.uti_log_id = '$_SESSION[log_id]'"));
$local = mysqli_fetch_array(mysqli_query($conn, "SELECT uti_distrito, uti_concelho, uti_freguesia, distritos.distrito, concelhos.concelho, freguesias.freguesia from utilizador 
                                                inner join distritos on distritos.distritosid = utilizador.uti_distrito 
                                                join concelhos on concelhos.concelhoid = utilizador.uti_concelho 
                                                join freguesias on freguesias.freguesiaid = utilizador.uti_freguesia where uti_log_id = '$_SESSION[log_id]'"));
                    echo '
                    <form method="post" enctype="multipart/form-data">                    
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="row">
                                    <div class="col-md-12 mt-2">
                                        <h5 class="text-primary">Foto de Perfil:</h5>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <img src="assets/img/foto_perfil/'.@$ut["uti_foto"].'" style="width:15em; height: 15em; border-radius:50%">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="row">
                                    <div class="col">
                                        <label>Nome:</label>
                                        <input type="text" class="form-control text-primary" name="uti_nome" placeholder="Nome" value="'.@$ut["uti_nome"].'">
                                    </div>
                                    <div class="col">
                                        <label>Sobrenome:</label>
                                        <input type="text" class="form-control text-primary" name="uti_apelido" placeholder="apelido" value="'.@$ut["uti_apelido"].'">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Foto de perfil:</label>
                                        <input type="file" name="uti_foto" class="form-control" placeholder="Foto" aria-label="Foto" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Telemóvel:</label>
                                        <input type="text" class="form-control text-primary" name="uti_tel" placeholder="Telemovel" value="'.@$ut["uti_tel"].'">
                                    </div>
                                    <div class="col">
                                        <label>Data de Nascimento:</label>
                                        <input type="date" class="form-control text-primary" name="uti_datan" value="'.@$ut["uti_datan"].'">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Morada:</label>
                                        <input type="text" class="form-control text-primary" name="uti_morada" placeholder="Morada" value="'.@$ut["uti_morada"].'">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Código-Postal:</label>
                                        <input type="text" class="form-control text-primary" name="uti_cp" placeholder="Código Postal" value="'.@$ut["uti_cp"].'">
                                    </div>
                                    <div class="col">
                                        <label>NIF:</label>
                                        <input type="text" class="form-control text-primary" name="uti_nif" placeholder="Nif" value="'.@$ut["uti_nif"].'">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col">
                                        <label>Localização:</label>
                                        <textarea name="uti_localizacao" rows="3" class="form-control text-primary" aria-label="Localizacao" aria-describedby="basic-addon1" Placeholder="localizacao">'.@$ut["uti_localizacao"].'</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Distrito:</label>
                                        <select name="uti_distrito" id="distrito" class="form-select text-primary">
                                            <option value="'.@$ut["uti_distrito"].'">'.@$ut["distrito"].'</option>';
                                            lista_distritos();
                                        echo '</select>
                                    </div>
                                    <div class="col">
                                        <label>Concelho:</label>
                                        <select name="uti_concelho" id="concelho" class="form-select text-primary">
                                        <option value="'.@$ut["uti_concelho"].'">'.@$ut["concelho"].'</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label>Freguesia:</label>
                                        <select name="uti_freguesia" id="freguesia" class="form-select text-primary">
                                        <option value="'.@$ut["uti_freguesia"].'">'.@$ut["freguesia"].'</option>
                                        </select>
                                    </div>
                                </div>
                                <hr class="pt-1 mt-4 bg-primary">
                                <h3 class="text-primary">Alterar dados de login</h3>
                                <div class="row">
                                    <div class="col">
                                        <label>Email(Caso não veja alteração recarregue a página):</label>
                                        <input type="text" class="form-control text-primary" name="log_email" placeholder="Email" value="'.@$ut["log_email"].'">
                                    </div>
                                    <div class="col">
                                        <label>Password:</label>
                                        <input type="password" class="form-control text-primary" name="log_senha" placeholder="Password">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col">
                                        <label>Repita a Password:</label>
                                        <input type="password" class="form-control text-primary" name="log_senha_2" placeholder="Repita a Password">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col">
                                        <button type="submit" class="form-control bg-primary text-white mt-2" name="update_dados">Atualizar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>';
            if(isset($_POST["update_dados"])){
                //inserção das fotos próxima versão
                $prefoto = mysqli_fetch_array(mysqli_query($conn,"SELECT uti_foto FROM utilizador WHERE uti_log_id = '$_SESSION[log_id]'"));
                $target_dir = "assets/img/foto_perfil/";
                $target_file1 = $target_dir.basename($_FILES["uti_foto"]["name"]);
                $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
                $foto = basename($_FILES["uti_foto"]["name"]);
                if($foto != ''){
                    unlink('assets/img/aves/'.$prefoto["uti_foto"]);
                    
                    move_uploaded_file($_FILES["uti_foto"]["tmp_name"], "assets/img/foto_perfil/".$_SESSION["log_id"].$foto);
                    $foto = $_SESSION["log_id"].$foto;
                    mysqli_query($conn, "UPDATE utilizador SET uti_foto = '$foto' where uti_log_id = '$_SESSION[log_id]'"); 
                }
                $pass = base64_encode($_POST["log_senha"]);
                $pass_2 = base64_encode($_POST["log_senha_2"]);
                $email = $_POST["log_email"];
                mysqli_query($conn, "UPDATE utilizador SET uti_nome='$_POST[uti_nome]', uti_apelido='$_POST[uti_apelido]', uti_tel='$_POST[uti_tel]', uti_morada='$_POST[uti_morada]', 
                uti_cp='$_POST[uti_cp]', uti_distrito ='$_POST[uti_distrito]', uti_concelho ='$_POST[uti_concelho]', uti_freguesia ='$_POST[uti_freguesia]', 
                uti_datan='$_POST[uti_datan]', uti_nif='$_POST[uti_nif]', uti_localizacao = '$_POST[uti_localizacao]' WHERE uti_log_id='$_SESSION[log_id]'");
                if($pass != "" && $pass==$pass_2){
                    mysqli_query($conn, "UPDATE login SET  log_pw='$pass' WHERE log_id='$_SESSION[log_id]'");
                }else{
                    $ut = mysqli_fetch_array(mysqli_query($conn, "SELECT log_pw from login where log_id = '$_SESSION[log_id]'"));
                    mysqli_query($conn, "UPDATE login SET  
                    log_pw='$ut[log_pw]' WHERE log_id='$_SESSION[log_id]'");
                }
                $ut = mysqli_fetch_array(mysqli_query($conn, "SELECT log_email from login where log_id = '$_SESSION[log_id]'"));
                if($email != $ut["log_email"]){
                    $token = mysqli_fetch_array(mysqli_query($conn, "SELECT log_token from login where log_id='$_SESSION[log_id]'"));
                    $email_admin = mysqli_fetch_array(mysqli_query($conn, "SELECT log_email from login where log_id = 1"));
                    $email_env = $email;
                    $assunto_env = "Verificação de Conta";
                    $texto_env = 'Clique na ligação abaixo para verificar este endereço de correio electrónico.\n http://localhost/Projectos/BlueBird/index.php?opt=5&token='.base64_encode($token["log_token"]) .'&em='.base64_encode($email).'<br> Se tiver alguma duvida<br> email: '.$email_admin["log_email"];
                    $headers[] = "From: bluebirdenterprisesy@gmail.com";
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                    if (mail($email_env, $assunto_env, $texto_env, implode("\r\n", $headers))){
                        echo '<meta http-equiv="Refresh" content="0;index.php?opt=4">';
                    }
                }else{
                    $ut = mysqli_fetch_array(mysqli_query($conn, "SELECT log_email from login where log_id = '$_SESSION[log_id]'"));
                    mysqli_query($conn, "UPDATE login SET  
                    log_email='$ut[log_email]' WHERE log_id='$_SESSION[log_id]'");
                }
                echo '<meta http-equiv="refresh" content="0;index.php?opt=1&action=1">';
                
            }