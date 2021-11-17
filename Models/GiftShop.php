<?php
require_once(ROOT_PATH. '/Models/Db.php');

class GiftShop extends Db{
    private $table = 'GiftShop';
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }


    public function get_item1(){
        $sql = "UPDATE $this->table SET item1 = item1-1";
        $sql .= " WHERE gift_shop_id = 1";
        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($sql);
            
            $result = $sth->execute();
            $this->dbh->commit();
            return $result;
        } catch (\PDOException $e) {
            echo '更新失敗'.$e->getMessage();
            $this->dbh->rollBack();
            exit();
        }

    }

    public function get_item2(){
        $sql = "UPDATE $this->table SET item2 = item2-1";
        $sql .= " WHERE gift_shop_id = 1";
        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($sql);
            
            $result = $sth->execute();
            $this->dbh->commit();
            return $result;
        } catch (\PDOException $e) {
            echo '更新失敗'.$e->getMessage();
            $this->dbh->rollBack();
            exit();
        }

    }
    public function get_item3(){
        $sql = "UPDATE $this->table SET item3 = item3-1";
        $sql .= " WHERE gift_shop_id = 1";

        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($sql);
            
            $result = $sth->execute();
            $this->dbh->commit();
            return $result;
        } catch (\PDOException $e) {
            echo '更新失敗'.$e->getMessage();
            $this->dbh->rollBack();
            exit();
        }

    }
    public function get_item4(){
        $sql = "UPDATE $this->table SET item4 = item4-1";
        $sql .= " WHERE gift_shop_id = 1";

        $this->dbh->beginTransaction();
        try {
            $sth = $this->dbh->prepare($sql);
            
            $result = $sth->execute();
            $this->dbh->commit();
            return $result;
        } catch (\PDOException $e) {
            echo '更新失敗'.$e->getMessage();
            $this->dbh->rollBack();
            exit();
        }

    }


}

?>