<?php
require_once(ROOT_PATH. '/Models/Db.php');

class User extends Db{
    private $table = 'user';
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    /**
     * 新規登録処理
     * 
     */
    public function register_user(){

        // // パスワード
        $user_password = htmlspecialchars($_SESSION['user_password'], ENT_QUOTES, "UTF-8");

        //uniqueID生成
        $user_unique_id = rand(time(),100000000);
        
        //hash化
        $hash = password_hash($user_password,PASSWORD_DEFAULT);

        $sql = "INSERT INTO $this->table(user_unique_id,user_name,user_name_kana,user_area,user_email,user_password)
        VALUES(:user_unique_id,:user_name,:user_name_kana,:user_area,:user_email,:user_password)";
        $sth = $this->dbh->prepare($sql);

        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':user_name', $_SESSION['user_name'], PDO::PARAM_STR);
            $sth->bindParam(':user_name_kana', $_SESSION['user_name_kana'], PDO::PARAM_STR);
            $sth->bindParam(':user_area', $_SESSION['user_area'], PDO::PARAM_STR);
            $sth->bindParam(':user_email', $_SESSION['user_email'], PDO::PARAM_STR);
            $sth->bindParam(':user_password', $hash, PDO::PARAM_STR);
            $sth->bindParam(':user_unique_id', $user_unique_id, PDO::PARAM_INT);
            $sth->execute();
            $this->dbh->commit();
            $result = $sth->rowCount();
            return $result;  
        } catch (\PDOException $e) {
            echo '登録失敗'.$e->getMessage();
            $this->dbh->rollBack();
            exit();
        }
    }
    public function register_manager(){
        // パスワード
        $user_password = htmlspecialchars($_SESSION['user_password'], ENT_QUOTES, "UTF-8");

        //uniqueID生成
        $user_unique_id = rand(time(),100000000);
        
        //hash化
        $hash = password_hash($user_password,PASSWORD_DEFAULT);

        $sql = "INSERT INTO $this->table(user_unique_id,user_name,user_name_kana,user_area,user_email,user_password,role)
        VALUES(:user_unique_id,:user_name,:user_name_kana,:user_area,:user_email,:user_password,:role)";
        $sth = $this->dbh->prepare($sql);

        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':user_name', $_SESSION['user_name'], PDO::PARAM_STR);
            $sth->bindParam(':user_name_kana', $_SESSION['user_name_kana'], PDO::PARAM_STR);
            $sth->bindParam(':user_area', $_SESSION['user_area'], PDO::PARAM_STR);
            $sth->bindParam(':user_email', $_SESSION['user_email'], PDO::PARAM_STR);
            $sth->bindParam(':user_password', $hash, PDO::PARAM_STR);
            $sth->bindParam(':user_unique_id', $user_unique_id, PDO::PARAM_INT);
            $sth->bindParam(':role', $_SESSION['role'], PDO::PARAM_INT);
            $sth->execute();
            $this->dbh->commit();
            $result = $sth->rowCount();
            return $result;  
        } catch (\PDOException $e) {
            echo '登録失敗'.$e->getMessage();
            $this->dbh->rollBack();
            exit();
        }
    }
    /**
     * emailからユーザを取得
     * @param string $email
     *
     */
    // メールアドレスでDBに存在するか判定（repass）
    public function getUserByEmail(){
    
       //SQLの実行
    $sql = "SELECT * FROM $this->table WHERE user_email = :user_email";
    try {
    $sth = $this->dbh->prepare($sql);
    $sth->bindParam(':user_email', $_POST['user_email'], PDO::PARAM_STR);
    $sth->execute();
    $user = $sth->fetch(PDO::FETCH_ASSOC);
    return $user;
    } catch (\PDOException $e) {
        echo 'メールアドレスが見つかりません'.$e->getMessage();
        exit();
    }
   }
    // メールアドレスでDBに存在するか判定（登録の際の重複を防ぐ）
    public function getUserByEmail_regist(){
    
        //SQLの実行
     $sql = "SELECT * FROM $this->table WHERE user_email = :user_email";
     try {
     $sth = $this->dbh->prepare($sql);
     $sth->bindParam(':user_email', $_POST['user_email'], PDO::PARAM_STR);
     $sth->execute();
     $user = $sth->fetch(PDO::FETCH_ASSOC);
     return $user;
     } catch (\PDOException $e) {
         echo 'メールアドレスが見つかりません'.$e->getMessage();
         exit();
     }
    }

   //ユーザーリスト全取得
   public function selectAll($page = 0):Array {       //:Arrayは返り値の方を示す
    $sql = "SELECT *
            FROM $this->table";
    //$sql .= " WHERE $this->table.role = 0";
    $sql .= ' LIMIT 30 OFFSET '.(30 * $page);
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    }
    //ページカウント用
    public function countAll():Int {
        $sql = 'SELECT count(*) as count FROM user';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $count = $sth->fetchColumn();
        return $count;
    }

    //詳細をクリックしたときにuser_unique_idを取得
    public function getByUniqueId($user_unique_id = 0):Array{
    $sql = "SELECT *
            FROM $this->table";
    $sql .= " WHERE $this->table.user_unique_id = :user_unique_id";
    $stmt = $this->dbh->prepare($sql);
    $stmt->bindParam(':user_unique_id',$user_unique_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
    }
    public function getByUniqueId_fromRegiset(){
        $sql = "SELECT user_unique_id
                FROM $this->table";
        $sql .= " WHERE $this->table.user_email = :user_email";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':user_email',$_SESSION['user_email'], PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
        }
    
    //ユーザー削除
    public function user_delete($user_unique_id = 0){
        $sql = "DELETE FROM  $this->table";
        $sql .= " WHERE $this->table.user_unique_id = :user_unique_id";
        try {
            $this->dbh->beginTransaction();
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':user_unique_id',$user_unique_id,PDO::PARAM_INT);
            $result = $sth->execute();
            $this->dbh->commit();
            return $result;
        } catch (\PDOException $e) {
            echo '削除失敗'.$e->getMessage();
            $this->dbh->rollBack();
            exit();
        }
   
    }
    //ユーザー更新
    public function user_update():INT{
        $sql = "UPDATE user
                SET 
                user_name  = :user_name,
                user_name_kana  = :user_name_kana,
                user_area   = :user_area,
                user_email = :user_email, 
                role       = :role";
        $sql .= " WHERE user_unique_id = :user_unique_id";
        try {
            $this->dbh->beginTransaction();
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':user_name',$_SESSION['fuser_name'],PDO::PARAM_STR);
            $sth->bindParam(':user_name_kana',$_SESSION['fuser_name_kana'],PDO::PARAM_STR);
            $sth->bindParam(':user_area',$_SESSION['fuser_area'],PDO::PARAM_STR);
            $sth->bindParam(':user_email',$_SESSION['fuser_email'],PDO::PARAM_STR);
            $sth->bindParam(':user_unique_id',$_SESSION['fuser_unique_id'],PDO::PARAM_INT);
            $sth->bindParam(':role',$_SESSION['frole'],PDO::PARAM_INT);
            $sth->execute();
            $this->dbh->commit();
            $result = $sth->rowCount();
            return $result; 
        } catch (\PDOException $e) {
            echo '編集更新失敗'.$e->getMessage();
            $this->dbh->rollBack();
            exit();
        }
   
    }

    //ユーザー登録と同時にuser_infoにユニークIDを登録
    public function getHeadUser(){
    
        //SQLの実行
        $sql = "SELECT u.user_id,u.user_unique_id,u.user_name,u.user_name_kana,u.user_area,u.user_email,u.user_password,u.role,u.gift,ui.user_img AS user_img 
                FROM user u 
                JOIN user_info ui 
                ON u.user_unique_id = ui.user_unique_id";
        $sql .= " WHERE u.user_unique_id = :friends_unique_id";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(":friends_unique_id",$_GET['user_unique_id'],PDO::PARAM_INT);
        $sth->execute();
        $user = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    //ユーザーがパスの変更
    public function pass_change(){

        // // パスワード
        $user_password = htmlspecialchars($_POST['user_password'], ENT_QUOTES, "UTF-8");
        
        //hash化
        $hash = password_hash($user_password,PASSWORD_DEFAULT);

        $sql = "UPDATE $this->table SET user_password = :user_password";
        $sql .= " WHERE user_unique_id = :user_unique_id";

        $sth = $this->dbh->prepare($sql);

        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($sql);
            
            $sth->bindParam(':user_password', $hash, PDO::PARAM_STR);
            $sth->bindParam(':user_unique_id', $_SESSION['user_unique_id'], PDO::PARAM_INT);
            $sth->execute();
            $this->dbh->commit();
            $result = $sth->rowCount();
            return $result;  
        } catch (\PDOException $e) {
            echo '変更失敗'.$e->getMessage();
            $this->dbh->rollBack();
            exit();
        }
    }

    //ユーザーがパスの変更ログイン時の忘れた時
    public function pass_change_forget(){

        // // パスワード
        $user_password = htmlspecialchars($_POST['user_password'], ENT_QUOTES, "UTF-8");
        
        //hash化
        $hash = password_hash($user_password,PASSWORD_DEFAULT);

        $sql = "UPDATE $this->table SET user_password = :user_password";
        $sql .= " WHERE user_unique_id = :user_unique_id";

        $sth = $this->dbh->prepare($sql);

        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($sql);
            
            $sth->bindParam(':user_password', $hash, PDO::PARAM_STR);
            $sth->bindParam(':user_unique_id', $_GET['user_unique_id'], PDO::PARAM_INT);
            $sth->execute();
            $this->dbh->commit();
            $result = $sth->rowCount();
            return $result;  
        } catch (\PDOException $e) {
            echo '変更失敗'.$e->getMessage();
            $this->dbh->rollBack();
            exit();
        }
    }
    //検索名前 friends
    public function getFriendsName(){
    
        //SQLの実行
     $sql = "SELECT u.user_unique_id,u.user_name,u.role,ui.user_img AS user_img 
            FROM user u 
            JOIN user_info ui 
            ON u.user_unique_id = ui.user_unique_id WHERE u.user_name LIKE :search_name";
     try {
     $sth = $this->dbh->prepare($sql);
     $name = "%".$_POST['search_name']."%";
     $sth->bindParam(":search_name",$name , PDO::PARAM_STR);
     $sth->execute();
     $user = $sth->fetchAll(PDO::FETCH_ASSOC);
     return $user;
     } catch (\PDOException $e) {
         echo 'メールアドレスが見つかりません'.$e->getMessage();
         exit();
     }
    }
    //検索名前でmanager
    public function getUserName(){
    
        //SQLの実行
     $sql = "SELECT * FROM $this->table WHERE user_name LIKE :search_name";
     try {
     $sth = $this->dbh->prepare($sql);
     $name = "%".$_POST['search_name']."%";
     $sth->bindParam(":search_name",$name , PDO::PARAM_STR);
     $sth->execute();
     $user = $sth->fetchAll(PDO::FETCH_ASSOC);
     return $user;
     } catch (\PDOException $e) {
         echo 'メールアドレスが見つかりません'.$e->getMessage();
         exit();
     }
    }
    //検索エリアで
    public function getUserArea(){
    
        //SQLの実行
        $sql = "SELECT * FROM $this->table WHERE user_area LIKE :search_area";
        $sth = $this->dbh->prepare($sql);
        $area = "%".$_POST['search_area']."%";
        $sth->bindParam(":search_area",$area , PDO::PARAM_STR);
        $sth->execute();
        $user = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $user;
       }

    //結合でuser_imgを取得

    public function getImgAndUser(){
    
        //SQLの実行
        $sql = "SELECT u.user_id,u.user_unique_id,u.user_name,u.user_name_kana,u.user_area,u.user_email,u.user_password,u.role,u.gift,ui.user_img AS user_img 
                FROM user u 
                JOIN user_info ui 
                ON u.user_unique_id = ui.user_unique_id";
        $sql .= " WHERE u.user_unique_id = :user_unique_id";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(":user_unique_id",$_SESSION['user_unique_id'],PDO::PARAM_INT);
        $sth->execute();
        $user = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    //トップ画面のユーザー　一覧ログインユーザー以外
    public function getFriendsUser(){
    
        //SQLの実行
        $sql = "SELECT u.user_id,u.user_unique_id,u.user_name,u.user_name_kana,u.user_area,u.user_email,u.user_password,u.role,u.gift,ui.user_img AS user_img 
                FROM user u 
                JOIN user_info ui 
                ON u.user_unique_id = ui.user_unique_id";
        $sql .= " WHERE NOT u.user_unique_id = :user_unique_id";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(":user_unique_id",$_SESSION['user_unique_id'],PDO::PARAM_INT);
        $sth->execute();
        $user = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }
        //GetでIMGと名前を取得
    public function get_send_profile(){
    
        //SQLの実行
        $sql = "SELECT u.user_unique_id,u.user_name,ui.user_img AS user_img 
                FROM user u 
                JOIN user_info ui 
                ON u.user_unique_id = ui.user_unique_id";
        $sql .= " WHERE u.user_unique_id = :user_unique_id";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(":user_unique_id",$_GET['user_unique_id'],PDO::PARAM_INT);
        $sth->execute();
        $user = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }


    //ギフトを送った側のマイナス処理

    public function user_gift_minus(){
        if(isset($_POST['outgoing_msg_id'])){
        $outgoing_msg_id = $_POST['outgoing_msg_id'];
        }

        $sql = "UPDATE $this->table SET  gift = gift-1";
        $sql .= " WHERE user_unique_id = :outgoing_msg_id";

        
        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':outgoing_msg_id', $outgoing_msg_id, PDO::PARAM_INT);
            
            $result = $sth->execute();
            $this->dbh->commit();
            return $result;
        } catch (\PDOException $e) {
            echo '更新失敗'.$e->getMessage();
            //$this->dbh->rollBack();
            exit();
        }

        }

        //ギフトを受け取った側のプラス処理

        public function user_gift_point_plus(){
            if(isset($_POST['incoming_msg_id'])){
            $incoming_msg_id = $_POST['incoming_msg_id'];
            }
        
            $sql = "UPDATE $this->table SET  gift_point = gift_point+1";
            $sql .= " WHERE user_unique_id = :incoming_msg_id";
    
            
            $this->dbh->beginTransaction();
            try {
                $sth = $this->dbh->prepare($sql);
                $sth->bindParam(':incoming_msg_id', $incoming_msg_id, PDO::PARAM_INT);
                
                $result = $sth->execute();
                $this->dbh->commit();
                return $result;
            } catch (\PDOException $e) {
                echo '更新失敗'.$e->getMessage();
                //$this->dbh->rollBack();
                exit();
            }
    
            }

        public function count_msg_get_point(){
            if(isset($_SESSION['user_unique_id'])){
            $user_unique_id = $_SESSION['user_unique_id'];
            }
            if(isset($_POST['incoming_msg_id'])){
            $friends_unique_id = $_POST['incoming_msg_id'];
            }
            $sql2 = "SELECT incoming_msg_id AND outgoing_msg_id
                    FROM PrivateChatRoom 
                    WHERE (outgoing_msg_id = :outgoing_msg_id AND incoming_msg_id =:incoming_msg_id) 
                    OR (outgoing_msg_id = :incoming_msg_id AND incoming_msg_id = :outgoing_msg_id)";
            $sth2 = $this->dbh->prepare($sql2);
            $sth2->bindParam(':outgoing_msg_id', $user_unique_id, PDO::PARAM_INT);
            $sth2->bindParam(':incoming_msg_id', $friends_unique_id, PDO::PARAM_INT);
            
            
            //$this->dbh->commit();
            $sth2->execute();
            $count = $sth2 -> rowCount();
            
            if($count == 50){
                $sql_fuser = "UPDATE $this->table SET  gift_point = gift_point+5";
                $sql_fuser .= " WHERE user_unique_id = :incoming_msg_id";
                $sql_user = "UPDATE $this->table SET  gift_point = gift_point+5";
                $sql_user .= " WHERE user_unique_id = :outgoing_msg_id";
            }elseif($count == 100){
                $sql_fuser = "UPDATE $this->table SET  gift_point = gift_point+10";
                $sql_fuser .= " WHERE user_unique_id = :incoming_msg_id";
                $sql_user = "UPDATE $this->table SET  gift_point = gift_point+10";
                $sql_user .= " WHERE user_unique_id = :outgoing_msg_id";
            }elseif($count == 150){
                $sql_fuser = "UPDATE $this->table SET  gift_point = gift_point+5";
                $sql_fuser .= " WHERE user_unique_id = :incoming_msg_id";
                $sql_user = "UPDATE $this->table SET  gift_point = gift_point+5";
                $sql_user .= " WHERE user_unique_id = :outgoing_msg_id";
            }elseif($count == 200){
                $sql_fuser = "UPDATE $this->table SET  gift_point = gift_point+10";
                $sql_fuser .= " WHERE user_unique_id = :incoming_msg_id";
                $sql_user = "UPDATE $this->table SET  gift_point = gift_point+10";
                $sql_user .= " WHERE user_unique_id = :outgoing_msg_id";
            }elseif($count == 250){
                $sql_fuser = "UPDATE $this->table SET  gift_point = gift_point+5";
                $sql_fuser .= " WHERE user_unique_id = :incoming_msg_id";
                $sql_user = "UPDATE $this->table SET  gift_point = gift_point+5";
                $sql_user .= " WHERE user_unique_id = :outgoing_msg_id";
            }elseif($count == 300){
                $sql_fuser = "UPDATE $this->table SET  gift_point = gift_point+10";
                $sql_fuser .= " WHERE user_unique_id = :incoming_msg_id";
                $sql_user = "UPDATE $this->table SET  gift_point = gift_point+10";
                $sql_user .= " WHERE user_unique_id = :outgoing_msg_id";
            }elseif($count == 350){
                $sql_fuser = "UPDATE $this->table SET  gift_point = gift_point+5";
                $sql_fuser .= " WHERE user_unique_id = :incoming_msg_id";
                $sql_user = "UPDATE $this->table SET  gift_point = gift_point+5";
                $sql_user .= " WHERE user_unique_id = :outgoing_msg_id";
            }elseif($count == 400){
                $sql_fuser = "UPDATE $this->table SET  gift_point = gift_point+10";
                $sql_fuser .= " WHERE user_unique_id = :incoming_msg_id";
                $sql_user = "UPDATE $this->table SET  gift_point = gift_point+10";
                $sql_user .= " WHERE user_unique_id = :outgoing_msg_id";
            }elseif($count == 450){
                $sql_fuser = "UPDATE $this->table SET  gift_point = gift_point+5";
                $sql_fuser .= " WHERE user_unique_id = :incoming_msg_id";
                $sql_user = "UPDATE $this->table SET  gift_point = gift_point+5";
                $sql_user .= " WHERE user_unique_id = :outgoing_msg_id";
            }elseif($count == 500){
                $sql_fuser = "UPDATE $this->table SET  gift_point = gift_point+10";
                $sql_fuser .= " WHERE user_unique_id = :incoming_msg_id";
                $sql_user = "UPDATE $this->table SET  gift_point = gift_point+10";
                $sql_user .= " WHERE user_unique_id = :outgoing_msg_id";
            }elseif($count == 550){
                $sql_fuser = "UPDATE $this->table SET  gift_point = gift_point+5";
                $sql_fuser .= " WHERE user_unique_id = :incoming_msg_id";
                $sql_user = "UPDATE $this->table SET  gift_point = gift_point+5";
                $sql_user .= " WHERE user_unique_id = :outgoing_msg_id";
            }elseif($count == 600){
                $sql_fuser = "UPDATE $this->table SET  gift_point = gift_point+10";
                $sql_fuser .= " WHERE user_unique_id = :incoming_msg_id";
                $sql_user = "UPDATE $this->table SET  gift_point = gift_point+10";
                $sql_user .= " WHERE user_unique_id = :outgoing_msg_id";
            }elseif($count == 650){
                $sql_fuser = "UPDATE $this->table SET  gift_point = gift_point+5";
                $sql_fuser .= " WHERE user_unique_id = :incoming_msg_id";
                $sql_user = "UPDATE $this->table SET  gift_point = gift_point+5";
                $sql_user .= " WHERE user_unique_id = :outgoing_msg_id";
            }
            if(isset($sql_user) && isset($sql_fuser) ){
                $sth_user = $this->dbh->prepare($sql_user);
                $sth_user->bindParam(':outgoing_msg_id', $user_unique_id, PDO::PARAM_INT);
                $sth_user->execute();
                $sth_fuser = $this->dbh->prepare($sql_fuser);
                $sth_fuser->bindParam(':incoming_msg_id', $friends_unique_id, PDO::PARAM_INT);
                $sth_fuser->execute();
            }else{
                return $count;
            }
            
            


        }

        //ポイント更新時に新しいデータを取得
        public function get_by_data():Array{
            $sql = "SELECT *
                    FROM $this->table";
            $sql .= " WHERE $this->table.user_unique_id = :user_unique_id";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':user_unique_id',$_SESSION['user_unique_id'], PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
            }

        //Gift購入時の処理　owngiftのプラス
        public function item1_plus(){

        $sql = "UPDATE $this->table SET own_item1 = own_item1+1";
        $sql .= " WHERE $this->table.user_unique_id = :user_unique_id";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':user_unique_id',$_SESSION['user_unique_id'], PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt -> rowCount();
        return $count;
        }

        public function item2_plus(){

            $sql = "UPDATE $this->table SET own_item2 = own_item2+1";
            $sql .= " WHERE $this->table.user_unique_id = :user_unique_id";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':user_unique_id',$_SESSION['user_unique_id'], PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt -> rowCount();
            return $count;
        }
        public function item3_plus(){

            $sql = "UPDATE $this->table SET own_item3 = own_item3+1";
            $sql .= " WHERE $this->table.user_unique_id = :user_unique_id";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':user_unique_id',$_SESSION['user_unique_id'], PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt -> rowCount();
            return $count;
        }

        public function item4_plus(){

            $sql = "UPDATE $this->table SET own_item4 = own_item4+1";
            $sql .= " WHERE $this->table.user_unique_id = :user_unique_id";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':user_unique_id',$_SESSION['user_unique_id'], PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt -> rowCount();
            return $count;
        }


        //Gift購入時のポイント消費処理
        public function point_minus_50(){

            $sql = "UPDATE $this->table SET gift_point = gift_point-50";
            $sql .= " WHERE $this->table.user_unique_id = :user_unique_id";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':user_unique_id',$_SESSION['user_unique_id'], PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt -> rowCount();
            return $count;
        }
        public function point_minus_100(){

            $sql = "UPDATE $this->table SET gift_point = gift_point-100";
            $sql .= " WHERE $this->table.user_unique_id = :user_unique_id";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':user_unique_id',$_SESSION['user_unique_id'], PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt -> rowCount();
            return $count;
        }
        public function point_minus_150(){

            $sql = "UPDATE $this->table SET gift_point = gift_point-150";
            $sql .= " WHERE $this->table.user_unique_id = :user_unique_id";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':user_unique_id',$_SESSION['user_unique_id'], PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt -> rowCount();
            return $count;
        }

}
?>