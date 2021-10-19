<div class="row">
        <h4 class="text-primary text-center">Pesquisa a sua Ave</h4>
        <form method="post">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xl-12 col-xxl-12">
                    <input type="text" class="form-control" id="pesq_palavra_main" Placeholder="Pesquise por Palavras Chave (Ex:Canário)">
                </div>
            </div>
        </form>
    </div>
<div class="row mt-2" id="main_pesquisa">
</div>
<div id="main" class="mt-2">
    <?php
    include 'connections/conn.php';
    //Estas querys foto_$ captam as imagens que vão ser utilizadas no banner
    $foto_1=mysqli_fetch_array(mysqli_query($conn, "SELECT ban_foto FROM banner WHERE ban_id = '1'"));
    $foto_2=mysqli_fetch_array(mysqli_query($conn, "SELECT ban_foto FROM banner WHERE ban_id = '2'"));
    $foto_3=mysqli_fetch_array(mysqli_query($conn, "SELECT ban_foto FROM banner WHERE ban_id = '3'"));
    if(@$_SESSION["log_id"] == ""){
        $ave_venda = mysqli_query($conn, "Select * from ave inner join especie on especie.esp_id = ave.ave_especie 
                                                        join variedade on ave.ave_variedade = variedade.var_id
                                                        join mutacao on ave.ave_mutacao = mutacao.mut_id where ave_estado = 1 order by ave_id desc LIMIT 4");
        $ave_emprestimo = mysqli_query($conn, "Select * from ave inner join especie on especie.esp_id = ave.ave_especie 
                                                        join variedade on ave.ave_variedade = variedade.var_id
                                                        join mutacao on ave.ave_mutacao = mutacao.mut_id where ave_estado = 4 order by ave_id desc LIMIT 4");
    }else{
        $ave_venda = mysqli_query($conn, "Select * from ave inner join especie on especie.esp_id = ave.ave_especie 
                                                        join variedade on ave.ave_variedade = variedade.var_id
                                                        join mutacao on ave.ave_mutacao = mutacao.mut_id where ave_estado = 1 and ave_log_id != '$_SESSION[log_id]' order by ave_id desc LIMIT 4");
        $ave_emprestimo = mysqli_query($conn, "Select * from ave inner join especie on especie.esp_id = ave.ave_especie 
                                                        join variedade on ave.ave_variedade = variedade.var_id
                                                        join mutacao on ave.ave_mutacao = mutacao.mut_id where ave_estado = 4 and ave_log_id != '$_SESSION[log_id]' order by ave_id desc LIMIT 4");
    }

    echo '<div id="carouselExampleIndicators" class="carousel slide w-100" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="assets/img/banner/'.$foto_1["ban_foto"].'" class="d-block w-100">
            </div>
            <div class="carousel-item">
            <img src="assets/img/banner/'.$foto_2["ban_foto"].'"  class="d-block w-100">
            </div>
            <div class="carousel-item">
            <img src="assets/img/banner/'.$foto_3["ban_foto"].'"  class="d-block w-100">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <br>
    <center><h3>Adicionados para venda recentemente</h3></center>
    <hr class="bg-primary" style="height: 2px;">
    <div class="row">';
    if(mysqli_num_rows($ave_venda)>0){
        while($ave_v = mysqli_fetch_array($ave_venda)){
            echo '
            <div class="col-sm-12 col-md-6 col-xl-4 col-xxl-3 mt-3">
                <div class="card">
                    <img src="assets/img/aves/'.$ave_v["ave_foto"].'" style="width: 100%;height: 200px;" class="card-img-top"  alt="'.$ave_v["ave_foto"].'">
                    <div class="card-body">
                        <h5 class="card-title">'.$ave_v["esp_nome"].'<br> '.$ave_v["var_nome"].'</h5>
                        <p class="card-text"><b>Mutação:</b> '.$ave_v["mut_nome"].'</p>
                        <a href="index.php?opt=3&id='.base64_encode($ave_v["ave_id"]).'" class="btn btn-primary">Ver Ave</a>
                    </div>
                </div>
            </div>';
        }
    }else{
        echo '<div class="col-sm-12 col-md-12 col-xl-12 col-xxl-12 mt-3 text-center">
                <h4>Sem dados</h4>
        </div>';
    }
    echo '</div>
    <!-- Procurados -->
    <br>
    <center><h3>Aves Perdidas Recentemente</h3></center>
    <hr class="bg-primary" style="height: 2px;">
    <div class="row">';
    if(mysqli_num_rows($ave_emprestimo)>0){
        while($ave_s = mysqli_fetch_array($ave_emprestimo)){
            echo '
            <div class="col-sm-12 col-md-6 col-xl-4 col-xxl-3 mt-3">
                <div class="card">
                    <img src="assets/img/aves/'.@$ave_s["ave_foto"].'" style="width: 100%;height: 200px;" class="card-img-top"  alt="'.@$ave_v["ave_foto"].'">
                    <div class="card-body">
                        <h5 class="card-title">'.$ave_s["esp_nome"].'<br> '.$ave_s["var_nome"].'</h5>
                        <p class="card-text"><b>Mutação:</b> '.$ave_s["mut_nome"].'</p>
                        <a href="index.php?opt=3&id='.base64_encode($ave_s["ave_id"]).'" class="btn btn-primary">Ver Ave</a>
                    </div>
                </div>
            </div>';
        }
    }else{
        echo '<div class="col-sm-12 col-md-12 col-xl-12 col-xxl-12 mt-3 text-center">
                <h4>Sem dados</h4>
        </div>';
    }
    echo '</div>
    <br>
</div>';