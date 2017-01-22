<?php
require('bootstrap.php');
/*
// Redirect to login if not logged in
if (! $_SESSION['is_logged_in']) {
    //header('Location: login.php');
}

if(! isset($_GET['p'])) {
    $content = 'admin/events.php';
    $menu = 1;
}
else {
    $content = 'admin/'.$_GET['p'].'.php';
    $menu = 2;
}

// Fetching user's info from the session
$user = $_SESSION['user'];
echo $_SESSION['user'];
//$user=1;
*/

$content = 'admin/users.php';
?>

<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>MeetingSet - Admin</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link href='http://fonts.googleapis.com/css?family=Reenie+Beanie' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
        <link rel="stylesheet" href="css/main.css">

       
    </head>
    <body>
       

      

        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>

        <script src="js/vendor/jquery-ui-1.9.2.custom.js"></script>


<div class="container">
    <div class="row">
        <div class="span12">
            <a id="add-users" class="btn btn-success pull-right"><i class="icon-plus"></i></a>
            <a id="hide-add-users-form" class="btn pull-right hide"><i class="icon-minus"></i></a>
        </div>
        <div class="span12">
            <form onsubmit="return false" action="javascript:void(0)" class="form-horizontal pull-right" style="display: none" id="add-user-form">
                <legend style="text-align: right">Nouvel usager</legend>

                <div class="control-group">
                    <label for="email" class="control-label">E-mail</label>
                    <div class="controls">
                        <input type="text" class="span2" id="email">
                    </div>
                </div><!-- End email -->

                <div class="control-group">
                    <label for="firstname" class="control-label">Prénom</label>
                    <div class="controls">
                        <input type="text" class="span2" id="firstname">
                    </div>
                </div><!-- End firstname -->

                <div class="control-group">
                    <label for="lastname" class="control-label">Nom de famille</label>
                    <div class="controls">
                        <input type="text" class="span2" id="lastname">
                    </div>
                </div><!-- End lastname -->

                <div class="control-group">
                    <label for="password" class="control-label">Mot de passe</label>
                    <div class="controls">
                        <input type="password" class="span2" id="password">
                    </div>
                </div><!-- End password -->

                <div class="control-group">
                    <label for="password2" class="control-label">Confirmation</label>
                    <div class="controls">
                        <input type="password" class="span2" id="password2">
                    </div>
                </div><!-- End password2 -->

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" id="save-user">Ajouter</button>
                    <img style="margin-left: 10px" class="hide" src="img/ajax-loader.gif" id="loader" alt="Loader">
                </div>
            </form>
        </div>
       
    </div>
</div>

<script type="text/javascript">
    $(function () {
       

        $('#add-users').on('click', function() {
            $('#add-user-form').slideDown('slow', function() {
                $('#add-users').addClass('hide');
                $('#hide-add-users-form').removeClass('hide');
            });
        });


        $('#hide-add-users-form').on('click', function() {
            $('#add-user-form').slideUp('slow', function() {
                $('#hide-add-users-form').addClass('hide');
                $('#add-users').removeClass('hide');
            });
        });

        

        $('#add-user-form').submit(function() {
            var email = $('#email').val();
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var password = $('#password').val();
            var password2 = $('#password2').val();

            if (! email || ! firstname || ! lastname || ! password || ! password2) {
                //return alert('Tous les champs doivent être remplies');
return alert("allo");
            }

            if (password != password2) 
                return alert('La confirmation ne correspond pas au mot de passe');

            var data = {
                email: email,
                firstname: firstname,
                lastname: lastname,
                password: password
            };

            $('#save-user').attr('disabled', true);
            $('#loader').removeClass('hide');

            $.ajax({
                url: "admin/insert_user.php",
                data: data,
                type: "POST",
                success: function(user_id) {
                  alert(user_id);
                }
            });
        });
    });
</script>






    </body>
</html>