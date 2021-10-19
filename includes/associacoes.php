<div class="col-sm-12 col-md-12 col-xl-12 col-xxl-12">
        <div class="row">
            <div class="col-md-6 text-center" id="columbofila">
                <button type="button" class="form-control bg-primary text-white">Associações Columbófilas</button>
            </div>
            <div class="col-md-6  text-center" id="ornitologica">
                <button type="button" class="form-control bg-primary text-white">Associações Ornitológicas</button>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12" id="columbofila_result">
            <?php
                include 'connections/conn.php';
                $columbofila = mysqli_query($conn, "SELECT * from sociedade where soc_tipo = 0");
                while($colum = mysqli_fetch_array($columbofila)){
                    echo '
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <img src="assets/img/associacoes/'.$colum["soc_foto"].'" alt="'.$colum["soc_nome"].'" style="widht: 150px; height: 150px">
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-center">'.$colum["soc_nome"].'</h5><br>
                                <b>Morada: </b><label>'.$colum["soc_morada"].'</label><br>
                                <b>Telefone: </b><label>'.$colum["soc_telefone"].'</label><br>
                                <b>FAX: </b><label>'.$colum["soc_fax"].'</label><br>
                                <b>Site: </b><label>'.$colum["soc_site"].'</label><br>
                                <b>Email: </b><label>'.$colum["soc_email"].'</label><br>
                                <b>Facebook: </b><label>'.$colum["soc_facebook"].'</label><br>
                            </div>
                        </div>
                    </form><hr>';
                }
            ?>
            </div>
            <div class="col-md-12" id="ornitologica_result">
            <?php
                $ornitologica = mysqli_query($conn, "SELECT * from sociedade where soc_tipo = 1");
                while($ornit = mysqli_fetch_array($ornitologica)){
                    echo '
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <img src="assets/img/associacoes/'.$ornit["soc_foto"].'" alt="'.$ornit["soc_nome"].'" style="widht: 150px; height: 150px">
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-center">'.$ornit["soc_nome"].'</h5><br>
                                <b>Morada: </b><label>'.$ornit["soc_morada"].'</label><br>
                                <b>Telefone: </b><label>'.$ornit["soc_telefone"].'</label><br>
                                <b>FAX: </b><label>'.$ornit["soc_fax"].'</label><br>
                                <b>Site: </b><label>'.$ornit["soc_site"].'</label><br>
                                <b>Email: </b><label>'.$ornit["soc_email"].'</label><br>
                                <b>Facebook: </b><label>'.$ornit["soc_facebook"].'</label><br>
                            </div>
                        </div>
                    </form>
                    <hr>';
                }
            ?>
            </div>
        </div>
    </div>