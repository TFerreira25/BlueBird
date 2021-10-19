<?php
    include 'connections/conn.php';
    session_start();
    $log_email = mysqli_real_escape_string($conn,@$_REQUEST["email"]);
    $log_senha = mysqli_real_escape_string($conn,@$_REQUEST["pw"]);
    $log_senha = base64_encode($log_senha);
    $valido = mysqli_fetch_array(mysqli_query($conn,"SELECT log_id, log_email, log_pw, log_type FROM login
    WHERE log_email = '$log_email' AND log_pw = '$log_senha' AND log_validar = 1"));
    if(!$valido || $log_email == "" && $log_senha == ""){
        echo 'Email ou Palavra-Passe Errada';
    }else{
        $_SESSION["log_type"] = $valido["log_type"];
        $_SESSION["log_id"] = $valido["log_id"];
        $sql = mysqli_query($conn, "UPDATE login SET log_status = 0 WHERE log_id='$_SESSION[log_id]'");
        echo '<meta http-equiv="Refresh" content="0;index.php">';
    }
    include 'connections/deconn.php';
?>