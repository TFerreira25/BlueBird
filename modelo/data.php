<?php
    while($row = mysqli_fetch_assoc($query)){
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['log_id']}
                OR outgoing_msg_id = {$row['log_id']}) and (incoming_msg_id = {$_SESSION['log_id']}
                OR outgoing_msg_id = {$_SESSION['log_id']}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        //(mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No hay mensajes disponibles";
        if(mysqli_num_rows($query2) > 0){
            $result = $row2['msg'];
            (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
            if(isset($row2['outgoing_msg_id'])){
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Tu: " : $you = "Ele(a): ";
            }else{
                $you = "";
            }
            ($row['log_status'] == 1) ? $offline = "offline" : $offline = "";
            ($outgoing_id == $row['log_id']) ? $hid_me = "hide" : $hid_me = "";

            $output .= '<a href="?opt=1&action=5&user_id='. $row['log_id'] .'">
                        <div class="content">
                        
                        <div class="details">
                            <span>'. $row['uti_nome']. " " . $row['uti_apelido'] .'</span>
                            <p>'. $you . $msg .'</p>
                        </div>
                        </div>
                        <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                    </a>';
        }
        /*(strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Tu: " : $you = "Ele(a): ";
        }else{
            $you = "";
        }
        ($row['log_status'] == 1) ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['log_id']) ? $hid_me = "hide" : $hid_me = "";

        $output .= '<a href="chat.php?user_id='. $row['log_id'] .'">
                    <div class="content">
                    
                    <div class="details">
                        <span>'. $row['uti_nome']. " " . $row['uti_apelido'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a>';*/
    }
?>
<!--<img src="../modelo/images/'. $row['img'] .'" alt="">-->