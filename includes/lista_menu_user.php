<!--<li class="nav-item mt-2 mr-5 text-center">
    <?php
        /*include 'connections/conn.php';
        $sql = mysqli_fetch_array(mysqli_query($conn, "Select uti_nome, uti_apelido from utilizador where uti_log_id = '$_SESSION[log_id]'"));
        echo '<label>Bem vindo, '.$sql["uti_nome"].' '.$sql["uti_apelido"].'</label>';*/
    ?>
</li>-->
<li class="nav-item"><a class="nav-link" href="?opt=1&action=1">Meus Dados</a></li>
<li class="nav-item"><a class="nav-link" href="?opt=1&action=2">Minhas Aves</a></li>
<?php include 'includes/dropdown_vendas_emprest.php'; ?>
<li class="nav-item"><a class="nav-link" href="?opt=9">Perdidos</a></li>
<li class="nav-item"><a class="nav-link" href="?opt=1&action=5">Chat</a></li>
<?php include 'includes/dropdown_informacao.php'; ?>