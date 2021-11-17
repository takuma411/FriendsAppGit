<?php 
class Validation{
   
    public function __construct()
    {
        
    }

    public function h($s){
        return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
    }
//ここからユーザー

    // ログインVali
    public function LoginV(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $err = [];
            //user_email
            if(!$user_email = filter_input(INPUT_POST, 'user_email')){
                $err['user_email'] = 'メールアドレスを入力してください';
            }elseif((!filter_var($user_email, FILTER_VALIDATE_EMAIL))){
                $err['user_email'] = '正しいメールアドレスを入力してください';
            }
            //user_password
            $limit = 6;
            $user_password = filter_input(INPUT_POST, 'user_password');
            $user_password_lengh = strlen($user_password);
            if(!$user_password){
                $err['user_password'] = 'パスワードを入力してください';
            }elseif(!preg_match("/^[a-z0-9]+$/",$user_password)){
                $err['user_password'] = '半角英数字で入力してください';
            }elseif($limit > $user_password_lengh){
                $err['user_password'] = '半角英数字６文字以上で入力してください';
            }

            return $err;
        }
    }
    //パス再登録用のメール認証
    public function PassEmailV(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $err = [];
            //user_email
            if(!$user_email = filter_input(INPUT_POST, 'user_email')){
                $err['user_email'] = 'メールアドレスを入力してください';
            }elseif((!filter_var($user_email, FILTER_VALIDATE_EMAIL))){
                $err['user_email'] = '正しいメールアドレスを入力してください';
            }
            return $err;
        }   
    }
    
    //ログイン後パスワード変更
    public function PassChangeV(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $err = [];
            //user_password
            $limit = 6;
            $user_password = filter_input(INPUT_POST, 'user_password');
            $user_password_lengh = strlen($user_password);
            if(!$user_password){
                $err['user_password'] = 'パスワードを入力してください';
            }elseif(!preg_match("/^[a-z0-9]+$/",$user_password)){
                $err['user_password'] = '半角英数字で入力してください';
            }elseif($limit > $user_password_lengh){
                $err['user_password'] = '半角英数字６文字以上で入力してください';
            }

            return $err;
        }
    }
//ここから管理者Vali
    //登録＆編集Vali
    public function ManagerV(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $err = [];
            //氏名
            if(!$user_name = filter_input(INPUT_POST, 'user_name')){
                $err['user_name'] = '氏名を入力してください';
            }elseif(20 < mb_strlen($user_name)){
                $err['user_name'] = "氏名は20文字以内で入力してください。";
            }
            if(!$user_name_kana = filter_input(INPUT_POST, 'user_name_kana')){
                $err['user_name_kana'] = '氏名カナを入力してください';
            }elseif(20 < mb_strlen($user_name_kana)){
                $err['user_name_kana'] = "氏名カナは20文字以内で入力してください。";
            }
            //user_email
            if(!$user_email = filter_input(INPUT_POST, 'user_email')){
                $err['user_email'] = 'メールアドレスを入力してください';
            }elseif((!filter_var($user_email, FILTER_VALIDATE_EMAIL))){
                $err['user_email'] = '正しいメールアドレスを入力してください';
            }
            //user_password
            $limit = 6;
            $user_password = filter_input(INPUT_POST, 'user_password');
            $user_password_lengh = strlen($user_password);
            if(!$user_password){
                $err['user_password'] = 'パスワードを入力してください';
            }elseif(!preg_match("/^[a-z0-9]+$/",$user_password)){
                $err['user_password'] = '半角英数字で入力してください';
            }elseif($limit > $user_password_lengh){
                $err['user_password'] = '半角英数字６文字以上で入力してください';
            }
            //area
            $user_area = filter_input(INPUT_POST, 'user_area');
            if($user_area === 'エリア'){
                $err['user_area'] = 'エリアを選択してください';
            }
        
            return $err;
        }
    }
    public function ManagerE(){
        // if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $err = [];
            //氏名
            if(!$user_name = filter_input(INPUT_POST, 'user_name')){
                $err['user_name'] = '氏名を入力してください';
            }elseif(20 < mb_strlen($user_name)){
                $err['user_name'] = "氏名は20文字以内で入力してください。";
            }
            if(!$user_name_kana = filter_input(INPUT_POST, 'user_name_kana')){
                $err['user_name_kana'] = '氏名カナを入力してください';
            }elseif(20 < mb_strlen($user_name_kana)){
                $err['user_name_kana'] = "氏名カナは20文字以内で入力してください。";
            }
            //user_email
            if(!$user_email = filter_input(INPUT_POST, 'user_email')){
                $err['user_email'] = 'メールアドレスを入力してください';
            }elseif((!filter_var($user_email, FILTER_VALIDATE_EMAIL))){
                $err['user_email'] = '正しいメールアドレスを入力してください';
            }
        
            //area
            $user_area = filter_input(INPUT_POST, 'user_area');
            if($user_area === 'エリア'){
                $err['user_area'] = 'エリアを選択してください';
            }
            return $err;
        }
    
    //登録の際にメールアドレスが存在したら

    //メールアドレス認証（パス忘れ）
    public function verify_email(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $err = [];
            //user_email
            if(!$user_email = filter_input(INPUT_POST, 'user_email')){
                $err['user_email'] = 'メールアドレスを入力してください';
            }elseif((!filter_var($user_email, FILTER_VALIDATE_EMAIL))){
                $err['user_email'] = '正しいメールアドレスを入力してください';
            }        
            return $err;
        }
    }

    //購入時バリデーション
    
    



}  

?>