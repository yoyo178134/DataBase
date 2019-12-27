<?php
    session_start() ;
    if(isset($_SESSION['is_login']) && $_SESSION['is_login'])
    {
        header("Location: article.php");
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

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <style type="text/css">
        body {
            min-height: 100vh;
            background-image: linear-gradient(to top, #fbc2eb 0%, #a6c1ee 100%);
        }

        .card {

            border-radius: 10px;

        }

        h3 {
            font-family: montserrat;
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

    <div class="container">
        <br>
        <br>

        <div class="row">
            <div class="col s12 m8 offset-m2">
                <div class="card-panel card">
                    <h3>Kumomo</h3>
                    <form id="login">
                        <div class="row">
                            <div class="input-field col s10 offset-s1">
                                <input id="account" name="account" type="text" class="validate">
                                <label for="account">account</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s10 offset-s1">
                                <input id="password" name="password" type="password" class="validate">
                                <label for="password">password</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s10  offset-s1">
                                <p class="center-align">
                                    <button class="btn waves-effect waves-light" style="width: 100%;" type="submit">
                                        Login
                                        <i class="material-icons right">send</i>
                                    </button>
                                </p>
                                <p class="center-align">
                                    If you don't have account , please&nbsp;
                                    <a href="signup.php">sign up</a>.
                                </p>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<script type="text/javascript">
    $(function () {
        $("#login").submit(function (e) {
            var form = $(this);
            $.ajax({
                type: "POST",
                url: "php/login.php",
                data: form.serialize(),
                success: function (data) {
                    console.log(data)
                    if (data == "true") {
                        M.toast({ html: "Login Success", displayLength: 500, completeCallback: function () { window.location.replace("article.php") } })
                        //window.location.replace("article.php");
                    } else if (data == "false") {
                        M.toast({ html: "Login Fail" })
                    } else {
                        M.toast({ html: "Unexpected" })
                    }
                }
            })
            return false;
        })
    })
</script>

</html>