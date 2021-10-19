<div class="row">
    <div class="col-md-3">
        <section class="users">
            <header>
                <div class="content">
                <?php 
                    $sql = mysqli_query($conn, "SELECT * FROM login inner join utilizador on login.log_id = utilizador.uti_log_id WHERE log_id = {$_SESSION['log_id']}");
                    if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                    }
                ?>
                <img src="../modelo/images/<?php echo $row['img']; ?>" alt="">
                <div class="details">
                    <span><?php echo $row['uti_nome']. " " . $row['uti_sobrenome'] ?></span>
                    <p><?php echo $row['log_status']; ?></p>
                </div>
                </div>
            </header>
            <div class="search">
                <span class="text"></span>
                <input type="text" placeholder="Ingrese el nombre para buscar ...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
                
            </div>
        </section>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col" widht="100" height="600">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse rerum, harum placeat deserunt sed optio magni eum repudiandae error voluptatum provident accusantium eveniet alias quam aliquam soluta ea earum tempora.
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <input type="text" class="w-100" class="form-control text-primary" placeholder="escreva aqui a sua mensagem">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<script type="text/javascript">
/*$(document).ready(function() {
    $.ajax({type: "POST",url: 'groupchatroom.php?g='+valor, // your PHP generating ONLY the inner DIV code
        success: function(html){
            $("#output").html(html);
        }
    }); //first initialize
    setTimeout(refresh_gallery(),1000); // refresh every 1 secs
});*/
</script>