<?php 
  include_once "modelo/config.php";
?>
  <div class="row">
    <div class="col-md-3">
      <div class="wrapper card">
        <section class="users card-body">
          <header>
            <div class="content">
              <?php 

                $sql = mysqli_query($conn, "SELECT * FROM login inner join utilizador on utilizador.uti_log_id = login.log_id WHERE log_id = $_SESSION[log_id]");
                if(mysqli_num_rows($sql) > 0){
                  $row = mysqli_fetch_assoc($sql);
                }
              ?>
              <div class="details row">
                <span><?php echo $row['uti_nome']. " " . $row['uti_apelido'] ?></span>
                <!--<p><?php echo $row['log_status']; ?></p>-->
              </div>
            </div>
          </header>
          <div class="search">
            <span class="text">Clique para pesquisar -></span>
            <input type="text" placeholder="Escreva o nome">
            <button><i class="fas fa-search"></i></button>
          </div>
          <div class="users-list">
      
          </div>
        </section>
      </div>
    </div>
    <div class="col-md-9">
      <?php
      if(@$_REQUEST['user_id'] != null){
          $user_id = mysqli_real_escape_string($conn, $_REQUEST['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM login inner join utilizador on utilizador.uti_log_id = login.log_id WHERE log_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: ?opt=1&action=5");
          }
        ?>
        <div class="row">
          <div class="col-md-1">
            <a href="?opt=1&action=5" class="back-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
          <!--<img src="../modelo/images/<?php //echo $row['img']; ?>" alt="">-->
          <div class="details col-md-10">
            <span><?php echo $row['uti_nome']. " " . $row['uti_apelido'] ?></span>
            <form method="POST">
            <?php echo '<input type="hidden" value="'.$row["uti_log_id"].'" id="num_id">';?>
            </form>
            <div id="status">
            </div>
          </div>
        </div>
        <div class="chat-box">

        </div>
        <form action="#" class="typing-area">
          <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
          <input type="text" name="message" class="input-field" placeholder="Escreva aqui a sua mensagem" autocomplete="off">
          <button><i class="fab fa-telegram-plane"></i></button>
        </form>

    <script src="js/chat.js"></script>
    <?php
        }
    ?>
    </div>
  </div>
  <script src="js/usuarios.js"></script>
