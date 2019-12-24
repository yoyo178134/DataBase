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
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <div class="card-panel">
                    <p class="center-align"><i class="large material-icons">account_circle</i></p>
                    <p class="center-align" id="id" >###</p>
                    <div class="divider"></div>
                    <div class="row">
                        <div class="col s12 m8 offset-m2">
                            <div class="row">
                                <div class="col s6">
                                    <p class="left-align">Account : </p>
                                </div>
                                <div class="col s6">
                                    <p class="right-align" id="account">###</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6">
                                    <p class="left-align">Name : </p>
                                </div>
                                <div class="col s6">
                                    <p class="right-align" id="name">###</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6">
                                    <p class="left-align">BirthDate : </p>
                                </div>
                                <div class="col s6">
                                    <p class="right-align" id="birthdate">###</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6">
                                    <p class="left-align">Gender : </p>
                                </div>
                                <div class="col s6">
                                    <p class="right-align" id="gender">###</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6">
                                    <p class="left-align">Career : </p>
                                </div>
                                <div class="col s6">
                                    <p class="right-align" id="career">###</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="right-align">
                        <a class="btn waves-effect waves-light" href="profileUpdate.php">編輯個人資料<i
                                class="material-icons right">edit</i></a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.sidenav').sidenav();
            $('.fixed-action-btn').floatingActionButton();
            $('.tooltipped').tooltip();
            $(".dropdown-trigger").dropdown();

            $.ajax({
                type: "GET",
                url: "php/userProfile.php",
                dataType: "json",
                success: function (data) {
                    console.log(data)
                    $("#id").text("ID : " + data.id)
                    $("#account").text(data.account)
                    $("#name").text(data.name)
                    $("#birthdate").text(data.birthdate)
                    $("#gender").text(data.gender)
                    $("#career").text(data.career)
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.status);
                    alert(XMLHttpRequest.readyState);
                    alert(textStatus);
                }
            })
            return false;
        })
    </script>
</body>

</html>