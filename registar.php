<?php
    include 'connections/conn.php'; //ligamos acesso a BD
    //filtramos caracteres especiais submetidos pelo usrlizador
    //elimina sql injections
    $reg_nome=mysqli_real_escape_string($conn,$_REQUEST["nome"]);
    $reg_apelido=mysqli_real_escape_string($conn,$_REQUEST["apelido"]);
    $log_email=mysqli_real_escape_string($conn,$_REQUEST["email"]);
    $log_senha=mysqli_real_escape_string($conn,$_REQUEST["pw"]);
    $reg_data=mysqli_real_escape_string($conn,$_REQUEST["data"]);
    //verficiar se já ha conta deste email
    $pre_conta = mysqli_fetch_array(mysqli_query($conn, "SELECT log_email FROM login WHERE log_email = '$log_email'"));
    if(!$pre_conta){
        //o email fornecido não existe em sistema
        //usrriptar senha fornecida
        $log_senha = base64_encode($log_senha);
        //gerar chave hash com 10 posicoes
        $bytes = 32;//dimenão pretendida para a chave
        $token=bin2hex(random_bytes($bytes));//gerar a chave
        mysqli_query($conn,"INSERT INTO login (log_email, log_pw, log_token, log_type) 
        values ('$log_email', '$log_senha', '$token', '2')");
        $log_id=mysqli_insert_id($conn);
        mysqli_query($conn,"INSERT INTO utilizador (uti_nome, uti_apelido, uti_log_id, uti_datan) 
        values ('$reg_nome', '$reg_apelido', '$log_id', '$reg_data')");
        //reenviar o email de registo
        $token = mysqli_fetch_array(mysqli_query($conn, "SELECT log_token from login where log_email = '$log_email'"));
        $email_admin = mysqli_fetch_array(mysqli_query($conn, "SELECT log_email from login where log_id = 1"));
        $email_env = $log_email;
        $assunto_env = "Verificação de Conta";
        $texto_env = 'Olá, Obrigado por se juntar a BlueBird.<br> Clique na ligação abaixo para verificar este endereço de correio electrónico.\n http://localhost/Projectos/BlueBird/index.php?opt=5&token='.base64_encode($token["log_token"]) .'<br> Se tiver alguma duvida<br> email: '.$email_admin["log_email"];
        $headers[] = "From: bluebirdenterprisesy@gmail.com";
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        if (mail($email_env, $assunto_env, $texto_env, implode("\r\n", $headers))){
            echo '<meta http-equiv="Refresh" content="0;index.php?opt=4">';
        }
        include 'connections/deconn.php';
    } else {
        echo "0";
    }
    //echo '<meta http-equiv="Refresh" content="0;index.php">';}