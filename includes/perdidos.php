
<div class="row">
    <h4 class="text-primary text-center">Zona de Perdidos</h4>
    <form method="post">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xl-12 col-xxl-12">
                <input type="text" class="form-control" id="pesq_palavra_perdido" Placeholder="Pesquise por Palavras Chave (Ex:Canário)">
            </div>
        </div>
    </form>
</div>
<br>
<div class="row" id="mostra_ave">
</div>
<div class="row" id="mostra_ave_default">
    <?php
        include 'connections/conn.php';
        include 'connections/conn.php';
        if(@$_SESSION["log_id"] == null){
            $aves_venda = mysqli_query($conn, "Select * from ave where ave_estado = 4");
        }else if (@$_SESSION["log_id"] != null){
            $aves_venda = mysqli_query($conn, "Select * from ave where ave_estado = 4 and ave_log_id != '$_SESSION[log_id]'");
        }
        while($ave_v = mysqli_fetch_array($aves_venda)){
            echo '<div class="col-sm-12 col-md-6 col-xl-4 col-xxl-3" style="margin-bottom: 1%;">
                <div class="card">
                    <img src="assets/img/aves/'.$ave_v["ave_foto"].'" style="width: 100%;height: 300px;" class="card-img-top"  alt="'.$ave_v["ave_foto"].'">
                    <div class="card-body">';
                    $ave = mysqli_query($conn, "Select * from ave inner join especie on especie.esp_id = ave.ave_especie 
                    join variedade on ave.ave_variedade = variedade.var_id
                    join mutacao on ave.ave_mutacao = mutacao.mut_id 
                    where ave_estado = 4 and ave_id = '$ave_v[ave_id]'");
                    if(mysqli_num_rows($ave)){
                    $av = mysqli_fetch_array($ave);
                        echo '<h5 class="card-title">'.@$av["esp_nome"].'<br> '.@$av["var_nome"].'</h5>
                        <p class="card-text"><b>Mutação:</b> '.@$av["mut_nome"].'</p>';
                    }else{
                        echo '<h5 class="card-title">Sem espécie<br> Sem variedade</h5>
                        <p class="card-text">Sem Mutação</p>';
                    }
                    echo '
                        <a href="index.php?opt=3&id='.base64_encode($ave_v["ave_id"]).'" class="btn btn-primary">Ver Ave</a>
                    </div>
                </div>
            </div>';
        }
    ?>
    
</div>
<?php 
    if (@$qta["qta"] >= 9 && empty($search)) {
        echo '<table style="width:100%;">';
        echo '<tr><td style="text-align:center;">';
        $paginas = intval(@$qta["qta"]/10-1);
        if ($pagina != 1) {$back = $pagina-1;}
        if ($pagina < $paginas) {$forward = $pagina+1;}
        echo '<a href="prd-product.php?pag=1">
        <button class="arrows">
        <i class="fas fa-angle-double-left"></i>
        </button></a>';
    }
?>
