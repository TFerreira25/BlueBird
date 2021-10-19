<?php
include 'includes/head.php';
?>
<body class="Roboto">
    <!-- Wrapper -->
    <div id="wrap">
        <!-- Estrutura base -->
        <?php include 'includes/header.php'; ?>
        <!-- FIM Barra Menu em Telemovel -->
        <main>
            <div class="col-md-8 offset-md-2">
                <?php 
                    //variavel PHP $
                    @$opt = $_REQUEST["opt"];
                    switch($opt){
                        case '1':
                                include 'includes/account.php';
                            break;
                        case '2': 
                                include 'includes/store.php';
                            break;
                        case '3':
                            include 'includes/mostra_ave.php';
                            break;
                        case '4':
                            include 'includes/pos_verificacacao.php';
                            break;
                        case '5':
                            include 'includes/verificacao_email.php';
                            break;
                        case '6':
                            include 'includes/esquecime_password.php';
                            break;
                        case '7':
                            include 'includes/mudar_password.php';
                            break;
                        case '8':
                            include 'includes/mudanca_password.php';
                            break;
                        case '9':
                            include 'includes/perdidos.php';
                            break;
                        case '10':
                            include 'includes/mostra_alimentacao.php';
                            break;
                        case '11':
                            include 'includes/mostra_doenca.php';
                            break;
                        case '12':
                            include 'includes/mostra_faqs.php';
                            break;
                        case '13':
                            include 'includes/associacoes.php';
                            break;
                        case '14':
                            include 'includes/termos_condicoes.php';
                            break;
                        default:
                            include 'includes/main.php';
                        break;    
                    }
                ?>
            </div>
        </main>
        <?php include 'includes/footer.php';?>
    </div>  
</body>
