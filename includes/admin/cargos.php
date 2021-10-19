<div class="row">
    <form method="post">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-xl-9 col-xxl-9">
                <input type="text" name="pesq_email" class="form-control" Placeholder="Pesquise por Email">
            </div>
            <div class="col-sm-3 col-md-3 col-xl-3 col-xxl-3" style="margin-bottom: 2%">
                <button class="form-control bg-primary text-white" name="btn_pesq">Pesquisar</button>
            </div>
        </div>
    </form>
</div>
<hr>
<div class="row">
    <?php 
        include 'connections/conn.php';
        if(@isset($_POST["btn_pesq"])){
            $utilizador = mysqli_query($conn, "select * from login inner join utilizador on login.log_id = utilizador.uti_log_id where log_email != 'admin@mail.com' and log_email = '$_POST[pesq_email]'");
        }else {
            $utilizador = mysqli_query($conn, "select * from login inner join utilizador on login.log_id = utilizador.uti_log_id where log_email != 'admin@mail.com'");
        }
        while($uti = mysqli_fetch_array($utilizador)){
            echo '<div class="col-sm-12 col-md-6 col-xl-4 col-xxl-3" style="margin-bottom: 1%">
                <form method="post">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">'.$uti["uti_nome"].'</h4>
                            <h5>'.$uti["log_email"].'</h5>
                            <p class="card-text" id="num_uti">Número de utilizador: '.$uti["uti_id"].'</p>
                            <p class="text-primary">Cargo: ';
                            switch($uti["log_type"]){
                            case '0':
                                echo "Administrador";
                                break;
                            case '1':
                                echo "Veterinário";
                                break;
                            case '2':
                                echo "Utilizador";
                                break;
                            }
                            echo '</p>
                            <p>Alterar cargo: </p>
                            <input type="hidden" name="log_id" value="'.$uti["log_id"].'">
                            <select class="form-control bg-white" name="mudar_cargo">
                                <option value="0">Admin</option>
                                <option value="1">Veterinário</option>
                                <option value="2">Utilizador</option>
                            </select>
                            <button type="submit" class="form-control bg-primary text-white" name="altera_cargo">Alterar</button>
                        </div>
                    </div>
                </form>
            </div>';
        }
    ?>
</div>
<?php
if(isset($_POST["altera_cargo"])){
    include 'connections/conn.php';
    $mudar_cargo = @$_POST["mudar_cargo"];
    $log_id = @$_POST["log_id"];
    $cargo = mysqli_query($conn, "UPDATE login SET log_type='$mudar_cargo' WHERE log_id='$log_id'");
    if($cargo){
        echo '<meta http-equiv="Refresh" content="0;index.php?opt=1&admin=1">';
    }
}