<?php
    $id = $_GET['id'];
    session_start() ;
    if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
    {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>kumomo</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Icon CSS-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript">

    </script>

    <style type="text/css">
        .messageList {
            padding: 1em;
        }

        .messageBox {
            border: 2px solid #80cbc4;
            background-color: #e0f2f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
            max-width: 40%;
        }

        .messageBox span {
            word-break: break-all;
        }

        .messageInput {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }

        @media #{$small-and-down} {
            .messageBox {
                max-width: 60%;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="nav-wrapper teal lighten-2">
            <div class="container">
                <a href="#!" class="brand-logo hide-on-med-and-down">Kumomo 聊一下</a>
                <a href="#!" class="brand-logo hide-on-large-only">Kumomo</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="article.php">文章</a></li>
                    <li><a href="chatroom.php">聊天室</a></li>
                    <li><a href="profile.php">個人頁面</a></li>
                    <li><a class="waves-effect waves-light btn" href="php/logout.php">登出</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li><a href="article.php">文章</a></li>
        <li><a href="chatroom.php">聊天室</a></li>
        <li><a href="profile.php">個人頁面</a></li>
        <li><a class="waves-effect waves-light btn" href="php/logout.php">登出</a></li>
    </ul>

    <div class="container">
        <br><br>
        <div class="messageList">
            <div id="recvId" class="hide"><?php echo $id ?></div>

            <template class="messageReceived">
                <div class="row">
                    <div class="messageBox left">
                        <span id="RecvMsg">##########</span>
                    </div>
                </div>
            </template>
            
            <template class="messageSend">
                <div class="row">
                    <div class="messageBox right"> 
                        <span id="SendMsg">##########</span>
                    </div>
                </div>
            </template>

        </div>

        <div class="messageInput">
            <div class="row">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s10 m9 offset-m1">
                            <i class="material-icons prefix">mode_edit</i>
                            <input id="message" type="text" class="validate">
                            <label for="message">Message</label>
                        </div>
                        <div class="input-field col s2 m1">
                            <button class="btn waves-effect waves-light right" type="submit">
                                <i class="material-icons">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function getRecvTemp(params) {
            return $("template.messageReceived").html().clone();
        }

        function  getSendTemp(params) {
            return $("template.messageSend").html().clone();
        }

        function writeMessage(params) {
            
        }
        $.ajax({
                type: "GET",
                url: "php/msgAllSendRsvphp.php",
                dataType: "json",
                date: $(#recvId).text,
                success: function (data) {
                    var temp;
                    var mix = '';
                    console.log(data)
                    /*
                    $.each(data, function (key,ele){
                        temp = getTemplate();
                        let id = ele.receive_id;
                        let name = ele.receive_name;
                        temp.find("#id").text(ele.receive_id)
                        temp.find("#name").text(ele.receive_name)
                        temp.find("#text").text(ele.text)
                        temp.find("#time").text(ele.time)
                        temp.find("#unReadNum").text(ele.unReadCnt)
                        temp.find("#href").attr("href","chat.php?id="+id);
                        mix += temp[0].outerHTML;
                    })
                    */

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.status);
                    alert(XMLHttpRequest.readyState);
                    alert(textStatus);
                }
            })

        $(document).ready(function () {
            $('.sidenav').sidenav();
            $('.fixed-action-btn').floatingActionButton();
            $('.tooltipped').tooltip();
            $(".dropdown-trigger").dropdown();
            $('.modal').modal();
        });
    </script>
</body>

</html>