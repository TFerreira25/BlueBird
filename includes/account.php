<?php
if (@$_SESSION["log_type"] == ''){
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
                                <h2 class="fw-bold mb-2 text-uppercase">Iniciar Sessão</h2>
                                <p class="text-primary-50 mb-5 ">Introduza o seu email e a sua palavra-passe</p>
                                <div class="form-outline form-primary mb-4">
                                    <input type="email" name="log_email" id="log_email" class="form-control form-control-lg" placeholder="Email"/>
                                    <span id="erro_email" class="text-danger"></span>
                                </div>
                                <div class="form-outline form-primary mb-4">
                                    <input type="password" name="log_password" id="log_password" class="form-control form-control-lg" placeholder="Palavra-Passe"/>
                                    <span id="erro_pw" class="text-danger"></span>
                                </div>
                                <button class="btn btn-outline-primary btn-lg px-5" name="btn_login" id="btn_login" type="button">Login</button><br>
                                <span id="erros" class="text-danger"></span>
                                <p class="small mb-5 pb-lg-2"><a class="text-primary-50" href="index.php?opt=6">Esquecime da Palavra-Passe</a></p>
                            </div>
                        </form>     
                        <div>
                            <p class="mb-0">Ainda não tens uma conta? <a id="fazer_registo" class="text-primary-50 fw-bold">Faz o teu Registo</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5 h-100" id="registo">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-light text-primary" style="border-radius: 1rem;">
                    <div class="pajaro">··</div>
                    <div class="card-body p-5 text-center mt-5">
                        <form method="post">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Registo</h2>
                                <p class="text-primary-50 mb-5 ">Preecha os campos</p>
                                <div class="form-outline form-primary mb-4">
                                    <input type="text" name="reg_nome" id="reg_nome" class="form-control form-control-lg" placeholder="Primeiro nome" required/>
                                    <span data-html="true" style="margin-top: 1%" class="text-danger" id="erro_nome"></span>
                                </div>
                                <div class="form-outline form-primary mb-4">
                                    <input type="text" name="reg_apelido" id="reg_apelido" class="form-control form-control-lg" placeholder="Apelido"/>
                                    <span data-html="true" style="margin-top: 1%" class="text-danger" id="erro_apelido"></span>
                                </div>
                                <div class="form-outline form-primary mb-4">
                                    <input type="text" name="reg_data" id="reg_data" class="form-control form-control-lg" placeholder="Data de Nascimento" onfocus="(this.type='date')"/>
                                    <span data-html="true" style="margin-top: 1%" class="text-danger" id="erro_data"></span>
                                </div>
                                <div class="form-outline form-primary mb-4">
                                    <input type="email" name="reg_email" id="reg_email" id="reg_email" class="form-control form-control-lg email" placeholder="Email"/>
                                    <span data-html="true" style="margin-top: 1%" class="text-danger" id="erro_email"></span>
                                </div>
                                <div class="form-outline form-primary mb-4">
                                    <input type="password" id="reg_password" class="form-control form-control-lg password" placeholder="Password">
                                    <span data-html="true" style="margin-top: 1%" class="text-danger" id="erro_pw"></span>
                                </div>
                                <div id="pswd_info">
                                    <h4>Requisitos de password</h4>
                                    <span id="letter" class="text-danger">Pelo menos <strong> uma letra minúscula</strong></span><br>
                                    <span id="capital" class="text-danger">Pelo menos <strong>uma letra maiúscula</strong></span><br>
                                    <span id="number" class="text-danger">Pelo menos <strong>um número</strong></span><br>
                                    <span id="length" class="text-danger">Pelo menos <strong>8 caracteres</strong></span><br>
                                    <span id="space" class="text-danger">Pelo menos <strong>um [~,!,@,#,$,%,^,&,*,-,=,.,;,']</strong></span>
                                </div>           
                                <div class="form-outline form-primary mb-4">
                                    <input type="password" name="reg_pass_2" id="reg_password_check" class="form-control form-control-lg" placeholder="Repita a Password"/>
                                    <span data-html="true" style="margin-top: 1%" class="text-danger" id="erro_pw_2"></span>
                                </div>
                                <div class="form-outline form-primary mb-4">
                                    <input type="checkbox" id="reg_termos_condicoes" name="reg_termos_condicoes" value="Bike">
                                    <label for="reg_termos_condicoes">Aceito os <a href="index.php?opt=14" class="text-decorantion-none">Termos e Condições</a></label><br>
                                    <span data-html="true" style="margin-top: 1%" class="text-danger" id="erro_checkbox"></span>
                                </div>
                                <!--<div class="form-outline form-primary mb-4">
                                    <div class="row" onload="createCaptcha()">
                                        <div class="col" onsubmit="validateCaptcha()">
                                            <div id="captcha">
                                            </div>
                                            <input type="text" placeholder="Captcha" id="cpatchaTextBox"/>
                                        </div>
                                    </div>
                                </div>-->
                                <button class="btn btn-outline-primary btn-lg px-5" name="btn_registar" id="btn_registar" type="button">Registar</button><br>
                                <span data-html="true" style="margin-top: 1%" class="text-danger" id="erros"></span>
                            </div>
                        </form>
                        <div>
                            <a id="fazer_login" class="text-primary-50 fw-bold"><--Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}else{
    @$log_type = $_SESSION["log_type"];
    switch($log_type){
        case '0':
            include 'includes/admin.php';
            break;
        case '1':
            include 'includes/vet.php';
            break;
        case '2': 
            include 'includes/user.php';
            break;   
    }
}
//<div class="verification"> <img id ="vimage" src="form/image.php" alt="Verification code" width="42" /> <a class="refresh" href="#" onClick="document.getElementById('vimage').src = 'form/image.php?' + Math.random(); return false"> <img src="form/refresh.png" alt="Anti Spam"> </a>
/*<!--VERIFICATION INPUT-->
<input type="text" name="verify" class="text" id="verify" placeholder="&#8592; Introduza o texto" title="Confirmação de que se trata de uma pessoa e não de um bot de spam."/>
<button type='submit' class="button contactos" id='send_message'>Enviar</button>
</div>*/
/*
    if (empty($pagina)) {​​​
$pagina = 1;
$min = 0;
}​​​ else {​​​
$min = $pagina.'0';
}​​​
$prds = mysqli_query($conn, "SELECT * FROM produtos LIMIT $min, 10");
$qta = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) AS qta FROM produtos"));
*/
?>
