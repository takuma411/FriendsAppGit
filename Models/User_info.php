<?php
require_once(ROOT_PATH. '/Models/Db.php');

class User_info extends Db{
    private $table = 'user_info';
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    function h($s){
        return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
      }

    /**
     * 新規登録直後にinfoテーブルにも登録
     * uniqueを使って
     * 
     */
    public function register_user_info(){
        
        $sql = "INSERT INTO $this->table(user_unique_id)
        VALUES(:user_unique_id)";
        $sth = $this->dbh->prepare($sql);

        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':user_unique_id', $_SESSION['user_unique_id'], PDO::PARAM_INT);
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

    //プロフィール更新
    public function update_profile(){
        $user_info_name = "";
        $user_info_age = "";
        $user_info_from = "";
        $user_info_dept = "";
        $user_info_hobies = "";
        $user_info_free ="";
        // $user_img ="";
        // $$user_unique_id ="";
        // $user_unique_id       = $_SESSION['user_unique_id'];
        $user_info_name       = h($_POST['user_info_name']);
        $user_info_age        = h($_POST['user_info_age']);
        $user_info_from       = h($_POST['user_info_from']);
        $user_info_dept       = h($_POST['user_info_dept']);
        $user_info_hobies     = h($_POST['user_info_hobies']);
        $user_info_free       = h($_POST['user_info_free']);
        
        $sql = "UPDATE user_info
                SET 
                user_info_name      = :user_info_name,
                user_info_age       = :user_info_age,
                user_info_hobies    = :user_info_hobies, 
                user_info_from      = :user_info_from,
                user_info_dept      = :user_info_dept,
                user_info_free      = :user_info_free,
                user_img            = :user_img";

        $sql .= " WHERE user_unique_id = :user_unique_id";
        try {
            $this->dbh->beginTransaction();
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':user_info_name',$user_info_name,PDO::PARAM_STR);
            $sth->bindParam(':user_info_age',$user_info_age,PDO::PARAM_STR);
            $sth->bindParam(':user_info_hobies',$user_info_hobies,PDO::PARAM_STR);
            $sth->bindParam(':user_info_from',$user_info_from,PDO::PARAM_STR);
            $sth->bindParam(':user_info_dept',$user_info_dept,PDO::PARAM_STR);
            $sth->bindParam(':user_info_free',$user_info_free,PDO::PARAM_STR);
            $sth->bindParam(':user_img',$_SESSION['user_img'],PDO::PARAM_STR);
            $sth->bindParam(':user_unique_id',$_SESSION['user_unique_id'],PDO::PARAM_STR);

            // $sth->bindParam(':user_info_name',$_POST['user_info_name'],PDO::PARAM_STR);
            // $sth->bindParam(':user_info_age',$_POST['user_info_age'],PDO::PARAM_STR);
            // $sth->bindParam(':user_info_hobies',$_POST['user_info_hobies'],PDO::PARAM_STR);
            // $sth->bindParam(':user_info_from',$_POST['user_info_from'],PDO::PARAM_STR);
            // $sth->bindParam(':user_info_dept',$_POST['user_info_dept'],PDO::PARAM_STR);
            // $sth->bindParam(':user_info_free',$_POST['user_info_free'],PDO::PARAM_STR);
            // $sth->bindParam(':user_img',$_SESSION['user_img'],PDO::PARAM_STR);
            // $sth->bindParam(':user_unique_id',$_POST['user_info_name'],PDO::PARAM_STR);
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

    //profile全取得uniqueidで
    public function select_profile(){
         //SQLの実行
         $sql = "SELECT * FROM $this->table WHERE user_unique_id = :user_unique_id";
         try {
         $sth = $this->dbh->prepare($sql);
         $sth->bindParam(':user_unique_id', $_SESSION['user_unique_id'], PDO::PARAM_INT);
         $sth->execute();
         $user = $sth->fetch(PDO::FETCH_ASSOC);
         return $user;
         } catch (\PDOException $e) {
            echo 'メールアドレスが見つかりません'.$e->getMessage();
            exit();
         }

    }

    //getでIDを受け取り、フレンドのプロフィールを表示
    public function get_profile(){
        //SQLの実行
        $sql = "SELECT * FROM $this->table WHERE user_unique_id = :user_unique_id";
        try {
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':user_unique_id', $_GET['user_unique_id'], PDO::PARAM_INT);
        $sth->execute();
        $user = $sth->fetch(PDO::FETCH_ASSOC);
        return $user;
        } catch (\PDOException $e) {
           echo 'メールアドレスが見つかりません'.$e->getMessage();
           exit();
        }
    }
}
?>    