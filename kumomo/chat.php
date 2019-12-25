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
            border: 2px solid #dedede;
            background-color: #f1f1f1;
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
            bottom: 5px;
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
            <div class="row">
                <div class="messageBox left">
                    <span>123</span>
                </div>
            </div>
            <div class="row">
                <div class="messageBox right"> 
                    <span>45jhfjsdhfdslhfiushdiulhasliujfnjfnjnjfnvjfnvjnfjvnfjnvfjnvjfvjfnvjfnvjfnvjfnjekdnwkdjkwmdmdwkdiuashdliuhasuil6</span>
                </div>
            </div>
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