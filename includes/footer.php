<footer class="bg-light text-center text-primary navbar-fixed-bottom mt-5" style="position: relative">
<?php
    include 'connections/conn.php';
    $dados = mysqli_fetch_array(mysqli_query($conn, "SELECT webdados.*, distritos.*, concelhos.*, freguesias.* FROM webdados 
                                                    inner join distritos on distritos.distritosid = webdados.wb_distrito 
                                                    join concelhos on concelhos.concelhoid = webdados.wb_concelho 
                                                    join freguesias on freguesias.freguesiaid = webdados.wb_freguesia"));
    $email = mysqli_fetch_array(mysqli_query($conn, "SELECT log_email FROM login where log_id = 1"));
    echo '<div class="col-md-2"></div>
    <div class="col-md-8 offset-md-2">
        <div class="row">
            <div class="col">
                <br>
                <label>Contactos:</label><br>
                <p><b>Telemovel: </b> '.$dados["wb_contacto"].'</p>
                <p><b>Email: </b> '.$email["log_email"].'</p>
                <p><b>Morada: </b> '.$dados["wb_morada"].'<br>'.$dados["freguesia"].', '.$dados["concelho"].', '.$dados["distrito"].'</p>
            </div>
            <div class="col">
                <br>
                <label><b>Informações:</b></label><br>';
                include 'includes/lista_footer.php';
            echo '</div>
            <div class="col">
                <br>
                <label>Reclamações:</label><br>
                <p><a href="index.php?opt=14" style="text-decoration:none;" class="text-primary">Termos & Condições</a></p>
                <p><a href="https://www.livroreclamacoes.pt/inicio" class="text-primary" style="text-decoration:none;">Livro de Reclamações Online</a></p>
            </div>
        </div>
    </div><br>
    <div class="col-md-8 text-center offset-md-2">
        <a href="'.$dados["wb_face"].'" class="text-primary" target="_blank" role="button"><i class="fab fa-facebook-f fa-lg"></i></a>
        <a href="'.$dados["wb_insta"].'" class="text-primary" target="_blank" role="button"><i class="fab fa-instagram fa-lg"></i></a>
    </div><br>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © '.date("Y").' Copyright: SoftYoungs
    </div>
    <div class="col-md-2"></div>';
    //insere o novo email na newsletter
    if(isset($_POST["btn_newsletter"])){
        include 'connections/conn.php';
        mysqli_query($conn, "INSERT INTO newsletter (news_email) values ('$_POST[news_email]')");
    }
?>
</footer>
<!-- Footer -->