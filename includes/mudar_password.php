<?php
echo $_REQUEST["token"].'<br>';
echo base64_decode($_REQUEST["token"]);
echo '<br>715cbf8fb0817563b58c3c94f1dd584e13c5391e1edba34a59';
?>
<div class="container py-5 h-100" id="login">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-light text-primary" style="border-radius: 1rem;">
            <div class="row">
                    <svg viewBox="0 0 280 280" class="svg svg--bird">
                        <defs>
                            <mask id="mask" maskunits="userSpaceOnUse"
                                maskcontentunits="userSpaceOnUse">
                                <image xlink:href="https://img-fotki.yandex.ru/get/15520/5091629.a4/0_8d416_118079e_orig" 
                                    width="280" height="280"></image>
                            </mask>
                            <linearGradient id="gr-1" x1="0" y1="0" x2="100%" y2="100%">
                                <stop offset="15%" class="stop-color stop-color--1"/>
                                <stop offset="45%" class="stop-color stop-color--2"/>
                                <stop offset="55%" class="stop-color stop-color--2"/>
                                <stop offset="85%" class="stop-color stop-color--3"/>
                            </linearGradient>
                            
                            <linearGradient id="gr-2" x1="0" y1="100%" x2="100%" y2="0%">
                                <stop offset="15%" class="stop-color stop-color--4"/>
                                <stop offset="45%" class="stop-color stop-color--5" stop-opacity="0"/>
                                <stop class="stop-color stop-color--5" stop-opacity="0"/>
                                <stop offset="85%" class="stop-color stop-color--6"/>
                            </linearGradient>
                        </defs>

                        <g mask="url(#mask)" class="g-container">
                            <rect 
                                fill="url(#gr-1)" 
                                width="100%" height="100%"
                                ></rect>
                            <rect 
                                fill="url(#gr-2)" 
                                width="100%" height="100%"
                                ></rect>
                        </g>
                    </svg>
                </div>
                <div class="card-body p-5 text-center">
                    <form method="post">
                        <div class="mb-md-5 mt-md-4 pb-5">
                            <h2 class="fw-bold mb-2 text-uppercase">Pedido de nova password</h2>
                            <p class="text-primary-50 mb-5 ">Introduza o seu email</p>
                            <div class="form-outline form-primary mb-4">
                                <input type="password" name="log_pw" class="form-control form-control-lg" placeholder="Palavra-Passe"/>
                            </div>
                            <div class="form-outline form-primary mb-4">
                                <input type="password" name="log_pw_2" class="form-control form-control-lg" placeholder="Confirme a Palavra-Passe"/>
                            </div>
                            <button class="btn btn-outline-primary btn-lg px-5" name="btn_pedir" type="submit">Pedir</button>
                        </div>
                    </form>
                    <?php
                        if(isset($_POST["btn_pedir"])){
                            if($_POST["log_pw"] != $_POST["log_pw_2"]){
                                echo $_POST["log_pw"] .' '.$_POST["log_pw_2"];
                                echo '<br><label>Password Diferentes insira novamente</label>';
                            }else if($_POST["log_pw"] == "" and $_POST["log_pw_2"] == ""){
                                echo '<br><label>Campos Vazios insira novamente</label>';
                            }else{
                                echo 'tou cá';
                                include 'connections/conn.php';
                                $token = base64_decode(mysqli_real_escape_string($conn,$_REQUEST["token"]));
                                echo '<br>'.$token;
                                $pw = base64_encode($_POST["log_pw"]);
                                mysqli_query($conn, "UPDATE login SET log_pw='$pw' WHERE log_token = '$token'");
                                echo '<meta http-equiv="Refresh" content="0;index.php?opt=8">';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>