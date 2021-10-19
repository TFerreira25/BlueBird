<?php
include 'connections/conn.php';
$id = intval(base64_decode($_REQUEST["id"]));
$dados = mysqli_fetch_array(mysqli_query($conn, "SELECT * from ave 
where ave.ave_id = '$id'"));
$ds = mysqli_fetch_array(mysqli_query($conn, "SELECT * from ave 
join especie on especie.esp_id = ave.ave_especie 
join variedade on ave.ave_variedade = variedade.var_id
join mutacao on ave.ave_mutacao = mutacao.mut_id 
where ave.ave_id = '$id'"));
$dados_user = mysqli_fetch_array(mysqli_query($conn, "SELECT * from login 
join utilizador on utilizador.uti_log_id = login.log_id 
where log_id = '$dados[ave_log_id]'"));
$local = mysqli_fetch_array(mysqli_query($conn, "SELECT * from utilizador inner join distritos on distritos.distritosid = utilizador.uti_distrito 
join concelhos on concelhos.concelhoid = utilizador.uti_concelho 
join freguesias on freguesias.freguesiaid = utilizador.uti_freguesia
where uti_log_id = '$dados[ave_log_id]'"));
$_SESSION["log_vendedor"] = $dados["ave_log_id"];
echo '
<div class="row">
    <div class="col-sm-12 col-md-6 col-xl-6 col-xxl-9 bg-light">
        <div class="row">
            <div class="col text-center">
            <img src="assets/img/aves/'.@$dados["ave_foto"].'" style="width: 35%;">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <h4 class="text-primary mb-2 mt-2 text-center">Descrição Detalhada:</h4>
                <label>';
                if(@$dados['ave_doenca_desc'] == ""){
                    echo 'Sem descrição';
                }else{
                    echo @$dados['ave_doenca_desc'];
                }
                echo '</label>
                <h4 class="text-primary mb-2 mt-2 text-center">Localização:</h4>';
                if(@$local["uti_localizacao"] == null){
                    echo 'Não colocou uma localização';
                }else{
                    echo '<div class="row" style="width: 100%; margin-left:0.23%;">'.@$dados_user["uti_localizacao"].'</div>';
                }
    echo '
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-xl-6 col-xxl-3" style="margin-bottom: 2%">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><img src="assets/img/foto_perfil/'.@$dados_user["uti_foto"].'" style="width:3em; height: 3em; border-radius:50%"> '.@$dados_user["uti_nome"].' '.@$dados_user["uti_apelido"].'</h5>
                <p class="card-text">'.@$dados_user["uti_morada"].'</p>';
                if(@$local["distrito"] != null && @$local["concelho"] != null && $local["freguesia"] != null){
                    echo '<p class="card-text">'.@$local["distrito"].', '.@$local["concelho"].', '.@$local["freguesia"].'</p>';
                }
                echo '
                <div class="row">
                    <!--<div class="col">
                        <a href="#" class="btn btn-primary">Go</a>
                    </div>-->
                    <div class="col">
                        <input type="hidden" value="'.@$dados_user["uti_log_id"].'" id="contacto">
                        <input type="submit" value="Número" id="numero" class="form-control bg-primary text-white">
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="margin-top: 1%">
            <div class="card-body">
                <h5 class="card-title">Descrição</h5>
                <b>Nº de Ave</b>: '.@$dados["ave_id"].'<br>
                <b>Espécie</b>: '.@$ds["esp_nome"].'<br><b>Variedade</b>: '.@$ds["var_nome"].'<br><b>Mutação</b>: '.@$ds["mut_nome"].'<br>
                <b>Ano</b>:'.@$dados["ave_ano"].'<br>
                   <b>Género</b>: ';
                   switch(@$dados["ave_genero"]){
                        case 1:
                            echo "Macho";
                            break;
                        case 2:
                            echo "Fêmea";
                            break;
                    }
                    
                    echo '<br>
                   <b>Estado</b>: ';
                    switch(@$dados["ave_estado"]){
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
                    echo'<br><b>Posturas</b>: '.@$dados["ave_postura"].'<br><b>Doente?</b> ';
                    switch(@$dados["ave_doenca"]){
                        case 0:
                            echo "Não";
                            break;
                        case 1:
                            echo "Sim";
                            break;
                    }
                    if(@$dados["ave_estado"] == 1){
                        echo'<h5 class="mt-2"><b>Preço</b>: '.@$dados["ave_preco"].'€</h5><br>';
                    }
            echo '</div>
        </div>
        <div class="card" style="margin-top: 1%">
            <div class="card-body">';
            if(@$_SESSION["log_type"] == 2){
                ?>
                <?php
                $user_id = $dados["ave_log_id"];
                $sql = mysqli_query($conn, "SELECT * FROM login inner join utilizador on utilizador.uti_log_id = login.log_id WHERE log_id = {$user_id}");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }else{
                    header("location: ?opt=1&action=5");
                }
                ?>
                <div class="row">
                    <div class="col-md-1">
                        <a href="?opt=1&action=5" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    </div>
                    <!--<img src="../modelo/images/<?php //echo $row['img']; ?>" alt="">-->
                    <div class="details col-md-10" id="status">
                        <span><?php echo $row['uti_nome']. " " . $row['uti_apelido'] ?></span>
                        <form method="POST">
                        <?php echo '<input type="hidden" value="'.$row["uti_log_id"].'" id="num_id">';?>
                        </form>
                        <div id="status">
                        </div>
                    </div>
                </div>
                <div class="chat-box">

                </div>
                <form action="#" class="typing-area">
                    <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                    <input type="text" name="message" class="input-field" placeholder="Escreva a sua mensagem" autocomplete="off">
                    <button><i class="fab fa-telegram-plane"></i></button>
                </form>

            <script src="js/chat.js"></script>
            <?php
            }
            if(@$_SESSION["log_id"] == null){
                echo '<form method="post">
                    <input type="hidden" value="'.@$_SESSION["log_id"].'" id="log_id">
                    <h5 class="card-title">Enviar Email: </h5>';
                    echo '<input type="text" name="email_user" id="email_user" class="form-control mb-2" Placeholder="Insira o seu Email">';
                    echo '<input type="hidden" value="'.base64_encode($dados_user["log_email"]).'" id="email_criador">
                    <input type="hidden" value="'.$id.'" id="id_ave">';
                    echo '<input type="text" name="email_assunto" id="email_assunto" class="form-control" Placeholder="Assunto">
                    <textarea name="email_texto" rows="5" id="email_texto" class="form-control mt-2" Placeholder="Mensagem"></textarea>
                    <button type="button" name="email_enviar" class="form-control bg-primary text-white mt-2" id="email_enviar">Enviar email</button>
                </form>
                <label class="text-primary" id="mensagem"></label>';
            }
            echo '</div>
        </div>
        <div class="chat-content scroller" id="output">
        </div>
    </div>
    <br>
</div>';
