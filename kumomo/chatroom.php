<?php
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
        <ul class="collection">
            <li class="collection-item">
                <a href="chat.php" class="black-text">
                    <div class="row">
                        <div class="col s4 m2">
                            <i class="medium material-icons">account_circle</i>
                            <h6 class="title">郭垣佑</h6>
                        </div>
                        <div class="col s6 m8">
                            <p class="truncate">閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴
                                閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴
                                閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴閉嘴
                            </p>
                        </div>
                        <div class="col s2 m2">
                            <p class="right-align large"><span class="new badge" data-badge-caption="">1</span></p>
                        </div>
                    </div>
                    <p class="right-align grey-text""><small>2019-06-28 00:02:00</small></p>
                </a>
            </li>
        </ul>
    </div>

    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red tooltipped modal-trigger" href="#searchUser" data-position="left"
            data-tooltip="找尋使用者">
            <i class="large material-icons">search</i>
        </a>
        <!--
                <ul>
                    <li><a class="btn-floating red  tooltipped" data-position="left" data-tooltip="個人操作"><i
                                class="material-icons">insert_chart</i></a></li>
                    <li><a class="btn-floating yellow darken-1  tooltipped" data-position="left" data-tooltip="個人操作"><i
                                class="material-icons">format_quote</i></a></li>
                    <li><a class="btn-floating green  tooltipped" data-position="left" data-tooltip="個人操作"><i
                                class="material-icons">publish</i></a></li>
                    <li><a class="btn-floating blue  tooltipped" data-position="left" data-tooltip="個人操作"><i
                                class="material-icons">attach_file</i></a></li>
                </ul>
                -->
    </div>

    <div id="searchUser" class="modal">
        <div class="modal-content">
            <h6>請輸入要查詢的使用者ID</h6>
            <br>
            <div class="row">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="icon_prefix" type="number" class="validate" max="9999999999">
                            <label for="icon_prefix">使用者ID</label>
                        </div>
                    </div>
                    <p class="right-align">
                        <button class="btn waves-effect waves-light" type="submit">查詢
                            <i class="material-icons right">search</i>
                        </button>
                    </p>
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
