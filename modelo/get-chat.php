<?php 
    session_start();
    if(isset($_SESSION['log_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['log_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN login ON login.log_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] == $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'.$row['msg'].'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="row"><div class="chat incoming">
                                <div class="details">
                                    <p>'.$row['msg'].'</p>
                                </div>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">Não tem mensagens de momento, envie algo para iniciar uma conversa</div>';
        }
        echo $output;
    }
?>
<!--<img src="../modelo/images/'./*$row['img']*/'" alt="">-->