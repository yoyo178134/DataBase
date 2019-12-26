<?php
    //require_once 'kumomo_connect.php';
    //require_once 'functions.php';
    
    /*if(!isset($_SESSION)){
        session_start();
    }*/

    $serverSocket = webSocket('127.0.0.1',8080);
    $socketArray = array($serverSocket);
    $cilentArray = array();
    $userIDtoID = array();
    $id = 1;

    while(true){
        $newSocketArray = $socketArray;
        $write=NULL;
        $except=NULL;
        socket_select($newSocketArray, $write, $except, NULL);

        foreach($newSocketArray as $socket){
            if($socket==$serverSocket){
                $clientSocket = socket_accept($serverSocket);
                $socketArray[] = $clientSocket;
                $key = $id++;
                $cilentArray[$key]=array(
                    'socket'=>$clientSocket,
                    'handshake'=>false
                );
            }
            else{
                $buffer = '';
                $bytes=socket_recv($socket,$buffer,1024,0);
                $clientKey = findClientKey($socket);
                //echo $buffer;
                if($bytes==0){
                    disconnect($socket, $clientKey);
                    echo "bye\n";
                    continue;
                }
                if(!$cilentArray[$clientKey]['handshake']){
                    handshake($clientKey, $buffer);
                }
                else{
                    $msg = msg_decode($buffer);
                    //echo $msg;
                    userIDtoID($msg, $clientKey);
                    if($msg == false)
                        continue;
                    msg_send($msg, $clientKey);
                }
            }
        }
    }

    function disconnect($clientSocket, $key){
        global $socketArray, $cilentArray, $userIDtoID;
        unset($cilentArray[$key]);
        $index = array_search($clientSocket, $socketArray);
        unset($socketArray[$index]);
        unset($userIDtoID[$key]);
        socket_close($clientSocket);
    }

    function webSocket($address,$port){
        $server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_set_option($server, SOL_SOCKET, SO_REUSEADDR, 1);//1表示接受所有的数据包
        socket_bind($server, $address, $port);
        socket_listen($server);
        echo 'Server Started : '.date('Y-m-d H:i:s')."\n";
        echo 'Listening on   : '.$address.' port '.$port."\n";
        return $server;
    }

    function handshake($clientKey,$buffer){
        global $cilentArray;
        $buf  = substr($buffer,strpos($buffer,'Sec-WebSocket-Key:')+18);
        $key  = trim(substr($buf,0,strpos($buf,"\r\n")));
        $new_key = base64_encode(sha1($key."258EAFA5-E914-47DA-95CA-C5AB0DC85B11",true));
         
        //按照协议组合信息进行返回
        $new_message = "HTTP/1.1 101 Switching Protocols\r\n";
        $new_message .= "Upgrade: websocket\r\n";
        $new_message .= "Sec-WebSocket-Version: 13\r\n";
        $new_message .= "Connection: Upgrade\r\n";
        $new_message .= "Sec-WebSocket-Accept: " . $new_key . "\r\n\r\n";
        socket_write($cilentArray[$clientKey]['socket'],$new_message,strlen($new_message));
        $cilentArray[$clientKey]['handshake']=true;
        return true;
    }

    function findClientKey($socket){
        global $cilentArray;
        foreach($cilentArray as $key => $value){
            if($socket==$value['socket'])
                return $key;
        }
        return false;
    }

    function userIDtoID($msg, $clientKey){
        global $userIDtoID;
        $msg = json_decode($msg);
        if($msg->receive_id == -1){
            $userIDtoID[$clientKey]=array(
                'userID'=>$msg->send_id
            );
        }
        //echo json_encode($userIDtoID);
    }

    function findReceiverID($msg){
        global $userIDtoID;
        $msg = json_decode($msg);
        foreach($userIDtoID as $key=> $value){
            if($msg->receive_id==$value['userID'])
                return $key;
        }
    }

    function msg_encode($msg){
        $b1 = 0x80 | (0x1 & 0x0f);
		$length = strlen($msg);
		
		if($length <= 125)
			$header = pack('CC', $b1, $length);
		elseif($length > 125 && $length < 65536)
			$header = pack('CCn', $b1, 126, $length);
		elseif($length >= 65536)
			$header = pack('CCNN', $b1, 127, $length);
		return $header.$msg;
    }

    function msg_decode($buffer){
        $length = ord($buffer[1]) & 127;
		if($length == 126) {
			$masks = substr($buffer, 4, 4);
			$data = substr($buffer, 8);
		}
		elseif($length == 127) {
			$masks = substr($buffer, 10, 4);
			$data = substr($buffer, 14);
		}
		else {
			$masks = substr($buffer, 2, 4);
			$data = substr($buffer, 6);
		}
		$buffer = "";
		for ($i = 0; $i < strlen($data); ++$i) {
			$buffer .= $data[$i] ^ $masks[$i%4];
		}
		return $buffer;
    }

    function msg_send($msg, $clientKey){
        global $cilentArray, $socketArray;
        $receiverKey = findReceiverID($msg);
        echo $receiverKey;
        $temp_msg = json_decode($msg);
        //if($msg->receive_id != 1)
        //    msgSend($msg->text, $msg->receive_id);//MySQL
        $msg_ar1 = array('text'=>$temp_msg->text,'send_id'=>$temp_msg->send_id, 'receive_id'=>$temp_msg->receive_id, 
                        'time'=>date("Y-m-d H:i:s"), 'isRead'=>1, 'isOwner'=> 1);
        $msg_ar2 = array('text'=>$temp_msg->text,'send_id'=>$temp_msg->receive_id, 'receive_id'=>$temp_msg->send_id, 
                        'time'=>date("Y-m-d H:i:s"), 'isRead'=>1, 'isOwner'=> 0);
        $str1 = msg_encode(json_encode($msg_ar1));
        $str2 = msg_encode(json_encode($msg_ar2));
        echo $str1;
        socket_write($cilentArray[$clientKey]['socket'], $str1, strlen($str1));//傳送端

        if($receiverKey!=null){
            if(in_array($cilentArray[$receiverKey]['socket'], $socketArray)){
                socket_write($cilentArray[$receiverKey]['socket'], $str2, strlen($str2));//接受端
                //msgRead($temp_msg->receive_id);//MySQL
            }
        }
    }

?>