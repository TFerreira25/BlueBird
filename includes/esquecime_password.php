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
                            <input type="email" name="log_email" class="form-control form-control-lg" placeholder="Email"/>
                            </div>
                            <button class="btn btn-outline-primary btn-lg px-5" name="btn_pedir" type="submit">Pedir</button>
                        </div>
                    </form>     
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST["btn_pedir"])){
    include 'connections/conn.php';
    $token = mysqli_fetch_array(mysqli_query($conn, "SELECT log_token from login where log_email = '$_POST[log_email]'"));
    $email_admin = mysqli_fetch_array(mysqli_query($conn, "SELECT log_email from login where log_id = 1"));
    $email_env = $_POST["log_email"];
    $assunto_env = "Verificação de Conta";
    $texto_env = '
    <center><h1 style="color: blue;">Alteração de Password</h1>
    Clique na ligação abaixo para efectuar a alteração da password
    <br>http://localhost/Projectos/BlueBird/index.php?opt=7&token='.base64_encode($token["log_token"]).'
    <br> Se tiver alguma duvida<br> email: '.$email_admin["log_email"].'</center>
    ';
    $headers[] = "From: bluebirdenterprisesy@gmail.com";
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
    if (mail($email_env, $assunto_env, $texto_env, implode("\r\n", $headers))){
        echo '<meta http-equiv="Refresh" content="0;index.php?opt=4">';
    }
}