<?php
    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['log_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $array = explode(" ", $searchTerm);
    $sql = "SELECT * FROM login inner join utilizador on utilizador.uti_log_id = login.log_id WHERE not log_id = {$outgoing_id} and uti_nome like '{$array[0]}%'" ;
    $output = "";
    if(@$array[1] != null){
        $sql .= " and uti_apelido Like '{$array[1]}%'";
    }
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else {
        $output .= 'Não existem contactos com esse nome';
    }
    echo $output;
?>