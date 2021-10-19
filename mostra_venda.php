<?php
    session_start();
    include 'connections/conn.php';
    $pesquisa = mysqli_real_escape_string($conn,$_REQUEST["pesquisa"]);
    $pesquisa = mb_convert_case($pesquisa,  MB_CASE_TITLE);
    $array = explode(" ",$pesquisa);
    $i = 0;
    $s = 0;
    while(count($array) > $i){
        if(@$_SESSION["log_id"] == ''){
            $aves_venda = mysqli_query($conn, "Select * from ave inner join especie on especie.esp_id = ave.ave_especie 
            join variedade on ave.ave_variedade = variedade.var_id
            join mutacao on ave.ave_mutacao = mutacao.mut_id where ave_estado = 1 and (especie.esp_nome LIKE '%$array[$i]%' or variedade.var_nome LIKE '%$array[$i]%' or variedade.var_cientifico LIKE '%$array[$i]%' or mutacao.mut_nome LIKE '%$array[$i]%')");
            if(mysqli_num_rows($aves_venda) > 0){
                while($ave_v = mysqli_fetch_array($aves_venda)){
                    echo '<div class="col-sm-12 col-md-6 col-xl-4 col-xxl-3" style="margin-bottom: 1%;">
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
                $s += 1;
            }
        }else if(@$_SESSION["log_id"] != ''){
            $aves_venda = mysqli_query($conn, "Select * from ave inner join especie on especie.esp_id = ave.ave_especie 
            join variedade on ave.ave_variedade = variedade.var_id
            join mutacao on ave.ave_mutacao = mutacao.mut_id where ave_estado = 1 and ave_log_id != '$_SESSION[log_id]' and (especie.esp_nome LIKE '%$array[$i]%' or variedade.var_nome LIKE '%$array[$i]%' or variedade.var_cientifico LIKE '%$array[$i]%' or mutacao.mut_nome LIKE '%$array[$i]%')");
            if(mysqli_num_rows($aves_venda) > 0){
                while($ave_v = mysqli_fetch_array($aves_venda)){
                    echo '<div class="col-sm-12 col-md-6 col-xl-4 col-xxl-3" style="margin-bottom: 1%;">
                        <div class="card">
                            <img src="assets/img/aves/'.$ave_v["ave_foto"].'" style="width: 100%;height: 200px;" class="card-img-top" alt="'.$ave_v["ave_foto"].'">
                            <div class="card-body">
                                <h5 class="card-title">'.$ave_v["esp_nome"].'<br> '.$ave_v["var_nome"].'</h5>
                                <p class="card-text"><b>Mutação:</b> '.$ave_v["mut_nome"].'</p>
                                <a href="index.php?opt=3&id='.base64_encode($ave_v["ave_id"]).'" class="btn btn-primary">Ver Ave</a>
                            </div>
                        </div>
                    </div>';
                }
            
            }else{
                $s += 1;
            }
        }
            $i += 1;
    }
    if($s == $i){
        echo '<h5 class="text-primary text-center">Sem resultados</h5>';
    }
    
?>