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
        <div id="articleList">

            <template class="item">
                <div class="articleBlock">
                    <div class="card-panel">
                        <div class="section">
                            <div class="row">
                                <div class="col s7 m9">
                                    <h5 id="name">###</h5>
                                </div>
                                <div class="col s5 m3">
                                    <p class="right-align grey-text"><small id="time">####-##-## ##:##:##</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="section">
                            <blockquote>
                                <p class="right-align" style="display: none;">
                                    <a class="waves-effect waves-yellow btn-flat" id="delete" >
                                        <i class="material-icons right">delete</i>
                                    </a>
                                </p>
                                <div class="row">
                                    <div class="col s12 m8 offset-m1">
                                        <p id="text">############</p>
                                    </div>
                                </div>
                                <p class="right-align">
                                    <a class="waves-effect waves-yellow btn-flat" id="thumb">
                                        <i class="material-icons left" >thumb_up</i><span id="likes">#</span>
                                    </a>
                                    <div id="id" style="display:none;">##</div>
                                    <div id="poster_id" style="display:none;">##</div>
                                </p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </template>

        </div>
    </div>

    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red tooltipped" href="articleAdd.php" data-position="left"
            data-tooltip="新增文章">
            <i class="large material-icons">add</i>
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

    <script type="text/javascript">
        var getTemplate = function (){
            var html = $("template.item").html();
            return $(html).clone();
        }
        var userid;



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
                    userid =  data.id
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.status);
                    alert(XMLHttpRequest.readyState);
                    alert(textStatus);
                }
            })

            $.ajax({
                type: "GET",
                url: "php/twitterLoad.php",
                dataType: "json",
                success: function (data) {
                    var temp;
                    var mix = '';
                    console.log(data)
                    $.each(data, function (key,ele){
                        temp = getTemplate();
                        let id = ele.id;
                        temp.find("#id").text(ele.id)
                        temp.find("#name").text(ele.name)
                        temp.find("#text").text(ele.text)
                        temp.find("#time").text(ele.time)
                        temp.find("#likes").text(ele.likes)
                        temp.find("#poster_id").text(ele.poster_id)
                        temp.find("#likes").attr("class", "like"+id);
                        temp.find("#delete").addClass("delBut"+id)
                        temp.find("#thumb").attr('onclick',"thumbclick(" + id + ")");
                        temp.find("#delete").parent().hide();
                        if(ele.poster_id === userid){
                            temp.find("#delete").attr('onclick',"deleteOnclick(" + id  + ")");
                            temp.find("#delete").parent().show();
                        }/*else{
                            temp.find("#delete").attr('onclick',"");
                        }*/
                        mix += temp[0].outerHTML;
                    })
                    $("#articleList").html(mix);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.status);
                    alert(XMLHttpRequest.readyState);
                    alert(textStatus);
                }
            })

            
            
        });


        function thumbclick(id){
            $.ajax({
                type: "POST",
                url: "php/twitterLike.php",
                dataType: "text",
                data:{id : id},
                success: function (data) {
                    console.log(data)
                    $(".like"+id).text(parseInt($(".like"+id).text())+1)
                    
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.status);
                    alert(XMLHttpRequest.readyState);
                    alert(textStatus);
                }
            })
        }
        function deleteOnclick(id){
            console.log(id)
            $.ajax({
                type: "POST",
                url: "php/twitterDelete.php",
                dataType: "html",
                data:{id : id},
                success: function (data) {
                    $(".delBut"+id+"").parent().parent().parent().parent().parent().fadeOut();
                    console.log(data);
                    M.toast({html: "Delete Success"});           
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.status);
                    alert(XMLHttpRequest.readyState);
                    alert(textStatus);
                }
            })
            

        }

        
    </script>
</body>

</html>
