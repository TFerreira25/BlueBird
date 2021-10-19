<?php
include 'functions/functions.php';
?>

<!DOCTYPE html>
<html>
    <head>
    <!--Atualiza dos dados da página com os dados da base de dados-->
        <?php include 'connections/conn.php'; $info = mysqli_fetch_array(mysqli_query($conn, "SELECT wb_nome FROM webdados WHERE 1"));?>
        <title><?php echo $info["wb_nome"]; ?></title>

        <!-- Metatags -->
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <meta name="author" content="<?php echo $info["wb_nome"]; ?>">
        <meta name="viewport" content="width=device-width, inital-scale=1">
        <meta name="keyword" content="">
        <meta HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
        <meta http-equiv="Cache-Control" content="no-store">
        <meta name="description" content="Sempre prontos a cuidar de si!">
        <link rel="icon" type="image/png" href="logo_PAP_azul.png"/>
        <!--Icons e Fonts -->
        <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
        <!-- Chamadas de CSS-->
        <link rel="stylesheet" type="text/css" href="assets/css/estilos.css">
        <link rel="stylesheet" href="assets/css/bird.scss">
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-5.0.0-dist/css/bootstrap.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        
        <!-- script icons -->
        <script src="https://kit.fontawesome.com/0a8bc34693.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="assets/js/functions.js"></script>
        <script src="https://cdn.tiny.cloud/1/3n9eekemalezalbof04787xen3hbt8ux1usoye6spxjh6t5m/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        <script>
            tinymce.init({
                selector: '#textarea_bluebird'
            });
        </script>
    </head>