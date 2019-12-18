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
                    <li><a href="chat.php">聊天室</a></li>
                    <li><a href="profile.php">個人頁面</a></li>
                    <li><a class="waves-effect waves-light btn" href="php/logout.php">登出</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li><a href="article.php">文章</a></li>
        <li><a href="chat.php">聊天室</a></li>
        <li><a href="profile.php">個人頁面</a></li>
        <li><a class="waves-effect waves-light btn" href="php/logout.php">登出</a></li>
    </ul>

    <div class="container">
        <br>
        <br>
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <div class="card-panel">
                    <form id="form">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="name" name="name" type="text" class="validate" required>
                                <label for="name">name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="birthdate" name="birthdate" type="text" class="datepicker" required>
                                <label for="birthdate">birthdate</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="career" name="career" type="text" class="validate" required>
                                <label for="career">career</label>
                            </div>
                        </div>
                        <span><label>gender</label></span>
                        <div class="row">
                            <div class="input-field col s4">
                                <label>
                                    <input name="gender" type="radio" value="m" required/>
                                    <span>male</span>
                                </label>
                            </div>
                            <div class="input-field col s4">
                                <label>
                                    <input name="gender" type="radio" value="f" />
                                    <span>female</span>
                                </label>
                            </div>
                            <div class="input-field col s4">
                                <label>
                                    <input name="gender" type="radio" value="s" />
                                    <span>secret</span>
                                </label>
                            </div>
                        </div>
                        <br>
                        <br>
                        <p class="right-align"><button class="btn waves-effect waves-light" type="submit"
                                name="action">確認修改
                                <i class="material-icons right">check</i>
                            </button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
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
                    $("#name").val(data.name)
                    $("#birthdate").val(data.birthdate)
                    $("input[@type=radio]").attr("checked",data.gender)
                    $("#career").val(data.career)
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.status);
                    alert(XMLHttpRequest.readyState);
                    alert(textStatus);
                }
            })
            return false;

        });

        $("#form").submit(function(e){
            var form = $(this);
            $.ajax({
                type: "POST",
                url: "php/userUpdate.php",
                data: form.serialize(),
                success: function (data) {
                    console.log(data)
                    if (data == "true") {
                        alert("success")
                        location = "profile.php"
                    } else if (data == "false") {
                        alert("fail")
                    } else {
                        alert("unexpecded")
                    }
                }
            })
            return false;
        })
    </script>
</body>

</html>