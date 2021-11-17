<?php
require_once(ROOT_PATH. '/Models/Db.php');

class PrivateChatRoom extends Db{
    private $table = 'PrivateChatRoom';
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }
    function h($s){
        return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
      }


    //メッセージ送信のSQL
    public function sendMsg(){

        if(isset($_POST['outgoing_msg_id'])){
        $outgoing_msg_id = $_POST['outgoing_msg_id'];
        }
        if(isset($_POST['incoming_msg_id'])){
        $incoming_msg_id = $_POST['incoming_msg_id'];
        }
        if(isset($_POST['msg'])){
        $msg = htmlspecialchars($_POST['msg']);
        }
        // $incoming_msg_id = $_POST['incoming_msg_id'];
        // $msg             = htmlspecialchars($_POST['msg']);

        if(!empty($msg)){
        $sql = "INSERT INTO $this->table(outgoing_msg_id,incoming_msg_id,msg)
        VALUES(:outgoing_msg_id,:incoming_msg_id,:msg)";
        $sth = $this->dbh->prepare($sql);

        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':outgoing_msg_id', $outgoing_msg_id, PDO::PARAM_INT);
            $sth->bindParam(':incoming_msg_id', $incoming_msg_id, PDO::PARAM_INT);
            $sth->bindParam(':msg', $msg, PDO::PARAM_STR);
            $sth->execute();
            $this->dbh->commit();
            $result = $sth->rowCount();
            return $result;  
        } catch (\PDOException $e) {
            echo '送信失敗'.$e->getMessage();
            $this->dbh->rollBack();
            exit();
        }

        }
    }


    public function GetMsg(){
            if(isset($_POST['outgoing_msg_id'])){
            $outgoing_msg_id = $_POST['outgoing_msg_id'];
            }
            if(isset($_POST['incoming_msg_id'])){
            $incoming_msg_id = $_POST['incoming_msg_id'];
            }
            $output = "";
            
    
            $sql = "SELECT * FROM $this->table WHERE (outgoing_msg_id = :outgoing_msg_id AND incoming_msg_id = :incoming_msg_id)
                    OR (outgoing_msg_id = :incoming_msg_id AND incoming_msg_id = :outgoing_msg_id) ORDER BY chat_message_id";
            $sth = $this->dbh->prepare($sql);

            $sql2 = "SELECT user_img FROM user_info";
            $sql2 .= " WHERE user_unique_id = :incoming_msg_id";
            
            //$this->dbh->beginTransaction();
            try {
                $sth = $this->dbh->prepare($sql);
                $sth->bindParam(':outgoing_msg_id', $outgoing_msg_id, PDO::PARAM_INT);
                $sth->bindParam(':incoming_msg_id', $incoming_msg_id, PDO::PARAM_INT);
                
                $sth->execute();
                //$this->dbh->commit();
                $result = $sth->rowCount();

                $sth2 = $this->dbh->prepare($sql2);
                $sth2->bindParam(':incoming_msg_id', $incoming_msg_id, PDO::PARAM_INT);
                
                $sth2->execute();
                $img_get = $sth2->fetch(PDO::FETCH_ASSOC);
                
                
                if($result > 0){
                    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                        if($row['outgoing_msg_id'] === $outgoing_msg_id){
                            if(empty($row['msg_img'])){
                            $output .= '<div class="chat-outgoing">
                                        <div class="details">
                                        <div class="outgoing_msg">
                                        <p>'. $row['msg'] .'</p>
                                        </div>
                                        
                                        </div>
                                        </div>';
                            }elseif(!empty($row['msg_img'])){
                                $output .= '<div class="chat-outgoing">
                                <div class="details">
                                <div class="outgoing_msg">
                                <img src="/img/'.$row['msg_img'].'">
                                </div>
                                
                                </div>
                                </div>';
                                // $output .= '
                                // <div class="outgoing_msg_">
                                // <img src="/img/'.$row['msg_img'].'">
                                // </div>';
                            }
                        }else{
                            if(empty($img_get['user_img']) && empty($row['msg_img'])){
                                // $output .= '<div class="chat-incoming">
                                // <div class="details">
                                //    <div class="incoming_img">
                                //    <img src="/img/'.$img_get['user_img'].'" class="icon_img">
                                //    </div>
                                //    <div class="incoming_msg">
                                //    <p>'. $row['msg'] .'</p>
                                //    </div>
                                
                                
                                // </div>
                                // </div>';
                                $output .= '<div class="chat-incoming">
                                    <div class="details">
                                        <div class="incoming_img">
                                        <img src="/img/defo.png" class="icon_img>
                                        </div>
                                        <div class="incoming_msg">
                                        <p>'. $row['msg'] .'</p>
                                        </div>
                                    
                                    
                                    </div>
                                    </div>';
                            }elseif(!empty($img_get['user_img']) && !empty($row['msg_img'])){
                                $output .= '<div class="chat-incoming">
                                <div class="details">
                                   <div class="incoming_img">
                                   <img src="/img/'.$img_get['user_img'].'" class="icon_img">
                                   </div>
                                   <div class="incoming_msg_img">
                                   <img src="/img/'.$row['msg_img'].'" class="msg_img">
                                   </div>
                                
                                
                                </div>
                                </div>';
                            }elseif(!empty($img_get['user_img']) && empty($row['msg_img'])){
                                $output .= '<div class="chat-incoming">
                                            <div class="details">
                                               <div class="incoming_img">
                                               <img src="/img/'.$img_get['user_img'].'" class="icon_img">
                                               </div>
                                               <div class="incoming_msg">
                                               <p>'. $row['msg'] .'</p>
                                               </div>
                                            
                                            
                                            </div>
                                            </div>';
                            }elseif(empty($img_get['user_img']) && !empty($row['msg_img'])){
                                $output .= '<div class="chat-incoming">
                                <div class="details">
                                    <div class="incoming_img">
                                    <img src="/img/defo.png" class="icon_img>
                                    </div>
                                    <div class="incoming_msg_img">
                                    <img src="/img/'.$row['msg_img'].'" class="msg_img">
                                    </div>
                                
                                
                                </div>
                                </div>';
                            }
                        }
                        
                    }
                    return $output;
                }

            } catch (\PDOException $e) {
                echo '送信失敗'.$e->getMessage();
                //$this->dbh->rollBack();
                exit();
            }
    
            }
    
            public function insert_msg_img(){
                if(isset($_POST['outgoing_msg_id'])){
                $outgoing_msg_id = $_POST['outgoing_msg_id'];
                }
                if(isset($_POST['incoming_msg_id'])){
                $incoming_msg_id = $_POST['incoming_msg_id'];
                }
                //画像送信
                if($_FILES['msg_img']){
                    $msg_img_name      = $_FILES['msg_img']['name'];
                    $msg_img_type      = $_FILES['msg_img']['type'];
                    $msg_img_tmp_name  = $_FILES['msg_img']['tmp_name'];
                
                    $msg_img_explode = explode('.',$msg_img_name);
                    $msg_img_txt     = end($msg_img_explode);
                    $extensions       = ["png","jpag","jpg"];
                
                    if(in_array($msg_img_txt,$extensions) === true){
                    $time = time();
                    $new_img_name = $time.$msg_img_name;
                    if(move_uploaded_file($msg_img_tmp_name,"img/".$new_img_name)){
                        $msg_img = $new_img_name;
                
                    }
                    }
                }
                
        
                if(!empty($msg_img)){
                    $sql = "INSERT INTO $this->table(outgoing_msg_id,incoming_msg_id,msg_img)
                    VALUES(:outgoing_msg_id,:incoming_msg_id,:msg_img)";
                    $sth = $this->dbh->prepare($sql);
                }
    
                
                $this->dbh->beginTransaction();
                try {
                    $sth = $this->dbh->prepare($sql);
                    $sth->bindParam(':outgoing_msg_id', $outgoing_msg_id, PDO::PARAM_INT);
                    $sth->bindParam(':incoming_msg_id', $incoming_msg_id, PDO::PARAM_INT);
                    $sth->bindParam(':msg_img', $msg_img, PDO::PARAM_STR);
                    
                    $result = $sth->execute();
                    $this->dbh->commit();
                        return $result;
                } catch (\PDOException $e) {
                    echo '更新失敗'.$e->getMessage();
                    $this->dbh->rollBack();
                    exit();
                }
            }
        

        //チャットのやりとり回数を記録してポイントを付与
        public function msg_count_point(){

            if(isset($_SESSION['user_unique_id'])){
            $user_unique_id = $_SESSION['user_unique_id'];
            }
            if(isset($_GET['user_unique_id'])){
            $friends_unique_id = $_GET['user_unique_id'];
            }

            $sql = "SELECT incoming_msg_id AND outgoing_msg_id
                    FROM $this->table 
                    WHERE (outgoing_msg_id = :outgoing_msg_id AND incoming_msg_id =:incoming_msg_id) 
                    OR (outgoing_msg_id = :incoming_msg_id AND incoming_msg_id = :outgoing_msg_id)";
                    try {
                        $sth = $this->dbh->prepare($sql);
                        $sth->bindParam(':outgoing_msg_id', $user_unique_id, PDO::PARAM_INT);
                        $sth->bindParam(':incoming_msg_id', $friends_unique_id, PDO::PARAM_INT);
                        
                        
                        //$this->dbh->commit();
                        $sth->execute();
                        $count = $sth -> rowCount();
                        return $count;
                        
                    } catch (\PDOException $e) {
                        echo '送信失敗'.$e->getMessage();
                        //$this->dbh->rollBack();
                        exit();
                    }
                }


                public function test_img(){
                    
        
                    $sql = "SELECT * FROM PrivateChatRoom WHERE chat_message_id = 424";
                            try {
                                $sth = $this->dbh->prepare($sql);
                                
                                
                                //$this->dbh->commit();
                                $sth->execute();
                                $result = $sth->fetch(PDO::FETCH_ASSOC);
                                
                                return $result;
                                
                            } catch (\PDOException $e) {
                                echo '送信失敗'.$e->getMessage();
                                //$this->dbh->rollBack();
                                exit();
                            }
                        }
                

    


}
?>