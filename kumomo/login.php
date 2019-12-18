

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
</head>

<body>

    <div class="container">
        <br>
        <br>
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <div class="card-panel">
                    <form id="login">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="account" name="account" type="text" class="validate">
                                <label for="account">account</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" name="password" type="password" class="validate">
                                <label for="password">password</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s6">
                                <p class="left-align">
                                    <button class="btn waves-effect waves-light" type="submit">sign in
                                        <i class="material-icons right">send</i>
                                    </button>
                                </p>
                            </div>
                            <div class="col s6">
                                <p class="right-align">
                                    <button class="btn waves-effect waves-light"
                                        onclick="location.href='signup.php'">sign up
                                        <i class="material-icons right">person_add</i>
                                    </button>
                                </p>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
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
                        alert("sign in success")
                        //location = "login.html"
                    } else if (data == "false") {
                        alert("sign in  fail")
                    } else {
                        alert("unexpecded")
                    }
                }
            })
            return false;
        })
    })
</script>

</html>