<?php
    if(!isset($_SESSION)){
        session_start();
    }
    

    function checkHasAccont($account){
         $result = null;
         $sql = "SELECT account FROM user WHERE account = '{$account}'";
         $query = mysqli_query($_SESSION['link'], $sql);
         if($query){
            if(mysqli_num_rows($query) >= 1){//看是否有此資料
                $result = true;
            }
            else{
                $result = false;
            }
        }
        else{
            mysqli_error($_SESSION['link']);
        }
        return $result;
    }

    function signup($account, $password, $passwordConfirm, $name, $birthdate, $career ,$gender){
        $result = null;
        if($password != $passwordConfirm){
            $result = false;
        }
        else{
            if(checkHasAccont($account)){
                return false;
            }
            $sql = "INSERT INTO user VALUES('','{$account}', '{$password}', '{$name}', '{$birthdate}', '{$career}', '{$gender}')";
            $query = mysqli_query($_SESSION['link'], $sql);
            //使用 mysqli_affected_rows判別有1筆異動的資料
            
            if($query){
                if(mysqli_affected_rows($_SESSION['link']) == 1){
                    $result = true;
                }
            }
            else{
                mysqli_error($_SESSION['link']);
            }
        }
        return $result;
    }

    function checkLogin($account, $password){
        $result = null;
        $sql = "SELECT * FROM user WHERE account = '{$account}' AND password = '{$password}'";
        $query = mysqli_query($_SESSION['link'], $sql);
        if($query){
            
            if(mysqli_num_rows($query) == 1){//看有沒有該筆資料
                
                $user = mysqli_fetch_assoc($query);
                $result = true;

                //設定 is_login 並給 true 值，代表已經登入
                $_SESSION['is_login'] = true;
                //用session紀錄是哪個user登入
                $_SESSION['login_user_id'] = $user['id'];
                //除了登入頁面要驗證外其餘登入後頁面也要驗證是否登入
                //因此宣告session讓之後頁面的驗證較容易
            }
            else{
                $result = false;
            }
        }
        else{
            mysqli_error($_SESSION['link']);
        }
        return $result;
    }

    function userProfile($id){
        $data = array();
        $sql = "SELECT account, name, birthdate, career, gender FROM user WHERE id = '{$id}'";
        $query = mysqli_query($_SESSION['link'], $sql);
        if($query){
            if(mysqli_num_rows($query) == 1){
                $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
                //echo($row['account']);
                $data = $row;
            }
        }
        else{
            mysqli_error($_SESSION['link']);
        }
        return $data;
    }

    function userUpdate($id, $name, $birthdate, $career, $gender){
        $result = null;
        $sql = "UPDATE user SET name = '{$name}', birthdate = '{$birthdate}', career = '{$career}', gender = '{$gender}'
                WHERE id = '{$id}'";
        $query = mysqli_query($_SESSION['link'], $sql);
        if($query){
            $result  = true;
        }
        else{
            mysqli_error($_SESSION['link']);
        }
        return $result;
    }

    function msgSend($text, $send_id ,$receive_id){
        $result = null;
        $current_date = date("Y-m-d H:i:s");
        $text = htmlspecialchars($text);
        //$user_send_id = $_SESSION['login_user_id'];
        $sql = "INSERT INTO message VALUES('', '{$text}', {$send_id}, {$receive_id}, '{$current_date}', 1, 1),
                                          ('', '{$text}', {$send_id}, {$receive_id}, '{$current_date}', 0, 0)";
        $query = mysqli_query($_SESSION['link'], $sql);
        if($query){
            if(mysqli_affected_rows($_SESSION['link']) > 0){
                $result = true;
            }
            else{
                $result = false;
            }
        }
        else{
            mysqli_error($_SESSION['link']);
        }
        return $result;
    }

    function msgRsv($send_id, $receive_id){
        $data = array();
        $sql = "SELECT * FROM message WHERE send_id = '{$send_id}' AND receive_id = '{$receive_id}'";
        $query = mysqli_query($_SESSION['link'], $sql);
        if($query){
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                    $data[] = $row;
                }
            }
        }
        else{
            mysqli_error($_SESSION['link']);
        }
        return $data;
    }

    function msgRead($send_id, $receive_id){
        $result = null;
        $sql = "UPDATE message SET isRead = 1 WHERE send_id = '{$send_id}' AND receive_id = '{$receive_id}'";
        $query = mysqli_query($_SESSION['link'], $sql);
        if($query){
            if(mysqli_affected_rows($_SESSION['link']) > 0){
               $result = true;
            }
            else{
                $result = false;
            }
        }
        else{
            mysqli_error($_SESSION['link']);
        }
        return $result;
    }

    function msgUnreadCnt($send_id, $receive_id){
        $count = 0;
        $sql = "SELECT COUNT(id) FROM message WHERE send_id = '{$send_id}' AND receive_id = '{$receive_id}' AND isRead = 0";
        $query = mysqli_query($_SESSION['link'], $sql);
        if($query){
            if(mysqli_num_rows($query) == 1){
                $row = mysqli_fetch_assoc($query);
                $count = $row['COUNT(id)'];
            } 
        }
        else{
            mysqli_error($_SESSION['link']);
        }
        return $count;
    }

    function msgLast($send_id, $receive_id){
        $data = array();
        $sql = "SELECT * FROM message WHERE time in (SELECT MAX(time) FROM message WHERE send_id = '{$send_id}' AND receive_id = '{$receive_id}') AND isOwner = 0";
        $query = mysqli_query($_SESSION['link'], $sql);
        //echo $sql;
        if($query){
            if(mysqli_num_rows($query) == 1){
                $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
                $data = $row;
            }
        }
        else{
            mysqli_error($_SESSION['link']);
        }
        return $data;
    }

    function twitterPost($text,$poster_id){
        $result = null;
        $current_date = date("Y-m-d H:i:s");
        $text = htmlspecialchars($text);
        $sql = "INSERT INTO twitter VALUES('', '{$text}', '{$poster_id}', '{$current_date}', 0)";
        $query = mysqli_query($_SESSION['link'], $sql);
        if($query){
            if(mysqli_affected_rows($_SESSION['link']) > 0){
                $result = true;
            }
            else{
                $result = false;
            }
        }
        else{
            mysqli_error($_SESSION['link']);
        }
        return $result;
    }

    function twitterLoad($poster_id){
        $data = array();
        $sql = "SELECT * FROM twitter WHERE poster_id = '{$poster_id}'";
        $query = mysqli_query($_SESSION['link'], $sql);
        if($query){
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                    $data[] = $row;
                }
            }
        }
        else{
            mysqli_error($_SESSION['link']);
        }
        return $data;
    }

    function twitterLike($id){
        $result = null;
        $sql = "UPDATE twitter SET likes = likes + 1 WHERE id = '{$id}'";
        $query = mysqli_query($_SESSION['link'], $sql);
        if($query){
            if(mysqli_affected_rows($_SESSION['link']) > 0){
                $result = true;
            }
            else{
                $result = false;
            }
        }
        else{
            mysqli_error($_SESSION['link']);
        }
        return $result;
    }

    function twitterDelete($id){
        $result = null;
        $sql = "DELETE FROM twitter WHERE id = '{$id}'";
        $query = mysqli_query($_SESSION['link'], $sql);
        if($query){
            if(mysqli_affected_rows($_SESSION['link']) > 0){
                $result = true;
            }
            else{
                $result = false;
            }
        }
        else{
            mysqli_error($_SESSION['link']);
        }
        return $result;
    }

?>