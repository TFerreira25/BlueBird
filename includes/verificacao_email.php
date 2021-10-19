<?php
if(@$_SESSION["log_id"] == ""){
include 'connections/conn.php';
$token = base64_decode($_REQUEST["token"]);
mysqli_query($conn, "UPDATE login SET log_validar=1 WHERE log_token = '$token'");
if(mysqli_num_rows(mysqli_query($conn, "SELECT log_status from login WHERE log_token = '$token' and log_validar = 1")) == 1){
    echo '<div class="row mt-2">
        <div class="col text-center">
            <h3 class="text-primary">Validação de email efectuada</h3>
            <a href="index.php" class="text-primary-50 fw-bold"><--Voltar</a>
        </div>
    </div>';
}else{
    echo '<div class="row mt-2">
        <div class="col text-center">
            <h3 class="text-primary">Algo correu mal</h3>
            <a href="index.php" class="text-primary-50 fw-bold"><--Voltar</a>
        </div>
    </div>';
}
include 'connections/deconn.php';
}else if (@$_SESSION["log_id"] != ""){
include 'connections/conn.php';
$token = base64_decode($_REQUEST["token"]);
$email = base64_decode($_REQUEST["em"]);
mysqli_query($conn, "UPDATE login SET log_email= '$email' WHERE log_token = '$token'");
if(mysqli_num_rows(mysqli_query($conn, "SELECT log_status from login WHERE log_token = '$token' and log_validar = 1 and log_email = '$email'")) == 1){
    echo '<div class="row mt-2">
        <div class="col text-center">
            <h3 class="text-primary">Validação de email efectuada</h3>
            <a href="index.php" class="text-primary-50 fw-bold"><--Voltar</a>
        </div>
    </div>';
}else{
    echo '<div class="row mt-2">
        <div class="col text-center">
            <h3 class="text-primary">Algo correu mal</h3>
            <a href="index.php?opt=1&action=1" class="text-primary-50 fw-bold"><--Voltar</a>
        </div>
    </div>';
}
}
?>