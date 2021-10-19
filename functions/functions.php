<?php
session_start();
//Distritos
function lista_distritos(){
    include 'connections/conn.php';
    $distritos = mysqli_query($conn, "SELECT * from distritos");
    while ($distrito = mysqli_fetch_array($distritos)){
        echo '<option value="'.$distrito["distritosid"].'">'.$distrito["distrito"].'</option>';
    }
    include 'connections/deconn.php';
}

function lista_especie(){
    include 'connections/conn.php';
    $especies = mysqli_query($conn, "SELECT * from especie");
    while ($especie = mysqli_fetch_array($especies)){
        echo '<option value="'.$especie["esp_id"].'">'.$especie["esp_nome"].'</option>';
    }
    include 'connections/deconn.php';
}