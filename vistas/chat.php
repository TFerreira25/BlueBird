
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_REQUEST['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM login inner join utilizador on utilizador.uti_log_id = login.log_id WHERE log_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: usuarios.php");
          }
        ?>
        <a href="usuarios.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <!--<img src="../modelo/images/<?php //echo $row['img']; ?>" alt="">-->
        <div class="details">
          <span><?php echo $row['uti_nome']. " " . $row['uti_apelido'] ?></span>
          <p><?php 
              switch($row['log_status']){
                case '0':
                  echo 'Online';
                  break;
                case '1':
                  echo 'Offline';
                  break;
              }
             ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Escreva a sua mensagem" autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="js/chat.js"></script>
