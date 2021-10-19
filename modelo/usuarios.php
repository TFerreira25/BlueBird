<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['log_id'];
    $output = "";
        $sql = "SELECT * FROM login inner join utilizador on utilizador.uti_log_id = login.log_id 
        WHERE NOT log_id = {$outgoing_id} ORDER BY log_id ";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) == 0){
            $output .= "Não existem utilizadores disponiveis";
        }elseif(mysqli_num_rows($query) > 0){
            include_once "data.php";
        }
    echo $output;
?>