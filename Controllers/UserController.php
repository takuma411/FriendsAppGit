<?php
require_once(ROOT_PATH .'/Models/User.php');
require_once(ROOT_PATH .'/Models/User_info.php');
require_once(ROOT_PATH .'/Models/PrivateChatRoom.php');
require_once(ROOT_PATH .'/Models/GiftShop.php');


class UserController {

    private $request;       //リクエストパラメータGET,POST
    private $User;
    private $User_info;
    private $PrivateChatRoom;
    private $GiftShop;

    public function __construct(){
        //パラメータ取得
        $this->request['get'] = $_GET;
        $this->request['post']= $_POST;


        //モデルオブジェクト生成
        $this->User = new User();
        //別モデルと連携User_info
        $dbh = $this->User->get_db_handler();
        $this->User_info = new User_info($dbh);

        $this->PrivateChatRoom = new PrivateChatRoom($dbh);

        $this->GiftShop = new GiftShop($dbh);

    }
    public function ChackEmail(){
        $user = $this->User->getUserByEmail();
        $params = [
            'user' => $user,
        ];
        return $params;
    }
    public function ChackEmail_regist(){
        $user = $this->User->getUserByEmail_regist();
        return $user;
    }
    public function GetUnique_reg(){
        $user = $this->User->getByUniqueId_fromRegiset();
        return $user;
    }
    

    public function regist_user(){

        $user = $this->User->register_user();
        return $user;
    }
    public function regist_manager(){
        $manager = $this->User->register_manager();
        return $manager;
    }

    public function user_list(){
        $page = 0;
        if(isset($this->request['get']['page'])){
            $page = $this->request['get']['page'];
        }

        $users = $this->User->selectAll($page);
        $users_count = $this->User->countAll();
        $params = [
            'user' => $users,
            'pages' =>$users_count /30
        ];
        return $params;
    }
    //管理者詳細画面
    public function user_detail(){
        if(empty($this->request['get']['user_unique_id'])){
            echo '指定のパラメータが不正です。ページを表示できません';
            exit();
        }
        $user = $this->User->getByUniqueId($this->request['get']['user_unique_id']);
        $params = [
            'user' => $user,
        ];
        return $params;
    }

    //ユーザー削除
    public function delete(){
        if(empty($this->request['get']['user_unique_id'])){
            echo '指定のパラメータが不正です。このページを表示できません。';
            exit();  
        }
        $result = $this->User->user_delete($this->request['get']['user_unique_id']);
        $params = [
            'user' => $result
        ];
        return $params;
    }
    //ユーザー更新
    public function update(){
        if(empty($this->request['get']['user_unique_id'])){
            echo '指定のパラメータが不正です。このページを表示できません。';
            exit();  
        }
        $result = $this->User->user_update($this->request['get']['user_unique_id']);
        $params = [
            'user' => $result
        ];
        return $params;
    }

    //user_info
    public function create_info(){
        $user = $this->User_info->register_user_info();
        return $user;
    }
    //profile更新
    public function UpdataProfole(){
        $user = $this->User_info->update_profile();
        return $user;
    }
    //uniqueでプロファイル取得
    public function SelectProfile(){
        if(empty($this->request['get']['user_unique_id'])){
            echo '指定のパラメータが不正です。このページを表示できません。';
            exit();  
        }
        $user = $this->User_info->select_profile($this->request['get']['user_unique_id']);
        $params = [
            'user' => $user
        ];
        return $params;
    }
    //chat画面　相手の名前とプロフィールをヘッダーに
    public function FriendsHead(){
        if(empty($this->request['get']['user_unique_id'])){
            echo '指定のパラメータが不正です。このページを表示できません。';
            exit();  
        }
        $user = $this->User->getHeadUser($this->request['get']['user_unique_id']);
        $params = [
            'user' => $user
        ];
        return $params;
    }
    //パス変更
    public function ChangePass(){
        $user = $this->User->pass_change();
        return $user;
    }
    //forgetパス変更
    public function PassChangeForget(){
        $user = $this->User->pass_change_forget();
        return $user;
    }
    //検索　名前friends page
    public function user_search_friends(){

        $users = $this->User->getFriendsName();
        
        // $params = [
        //     'name' => $users,
        // ];
        return $users;
    }
    //検索　名前manager page
    public function user_search(){

        $users = $this->User->getUserName();
        
        $params = [
            'name' => $users,
        ];
        return $params;
    }
    //検索　名前
    public function area_search(){

        $users = $this->User->getUserArea();
    
        $params = [
            'area' => $users,
        ];
        return $params;
    }
    //img結合
    
    public function ImgAndUser(){
        $users = $this->User->getImgAndUser();
    
        $params = [
            'user' => $users,
        ];
        return $params;
    }
    //トップ　ログインユーザー以外の表示
    public function FriendsUser(){
        $users = $this->User->getFriendsUser();
    
        $params = [
            'user' => $users,
        ];
        return $params;
    }

    //Chat Send
    public function Send_Msg(){
        $msg = $this->PrivateChatRoom->sendMsg();
        return $msg;
    }

    //Chat Get
    public function Get_Msg(){
        $msg = $this->PrivateChatRoom->GetMsg();
        return $msg;
    }
    //Chat Gift Get
    // public function Get_Gift_Msg(){
    //     $msg = $this->PrivateChatRoom->GetMsgGift();
    //     return $msg;
    // }


    //friends_user profile get
    public function GetProfile(){
        $info = $this->User_info->get_profile();
        $params = [
            'info' => $info,
        ];
        return $params;
    }

    //get送信でhead取得
    public function GetSendHead(){
        $users = $this->User->get_send_profile();
    
        // $params = [
        //     'user' => $users,
        // ];
        return $users;
    
    }

     //ギフトを受け取った側のプラス処理
     public function UserGiftPointPlus(){
        $users = $this->User->user_gift_point_plus();
        return $users;
     }


     //ギフトを送った側のマイナス処理
     public function UserGiftMinus(){
        $users = $this->User->user_gift_minus();
        return $users;
     }

    //Msg画像送信（insert）
    public function InsertMsgImg(){
        $users = $this->PrivateChatRoom->insert_msg_img();
        return $users;
    }
    //Msg画像取得
    // public function GetMsgImg(){
    //     $users = $this->PrivateChatRoom->insert_msg_img();
    //     return $users;
    // }

    //msg_count_point
    public function MsgCountPoint(){
        $users = $this->PrivateChatRoom->msg_count_point();
        return $users;
    }

    //Dbの最新のデータを受け取る
    public function GetByData(){
        $users = $this->User->get_by_data();
        return $users;
    }

    //buyitem
    public function BuyItem1(){
        $this->GiftShop->get_item1();
        $this->User->point_minus_50();
        $this->User->item1_plus();
    }

    public function BuyItem2(){
        $this->GiftShop->get_item2();
        $this->User->point_minus_100();
        $this->User->item2_plus();
    }

    public function BuyItem3(){
        $this->GiftShop->get_item3();
        $this->User->point_minus_50();
        $this->User->item3_plus();
    }

    public function BuyItem4(){
        $this->GiftShop->get_item4();
        $this->User->point_minus_150();
        $this->User->item4_plus();
    }

    //メッセージ回数に応じてポイント付与
    public function CountMsgGetPoint(){
        $this->User->count_msg_get_point();
    }

    public function TestImg(){
       $users = $this->PrivateChatRoom->test_img();

        return $users;

    }
}
?>