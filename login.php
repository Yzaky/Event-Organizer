<?php
require('bootstrap.php');

$invalid_login = false;

if (!empty($_POST)) {
    if ($user = User::auth($_POST["email"], $_POST["password"])) {
        $_SESSION["user"] = $user;
        $_SESSION["is_logged_in"] = true;
    	header("Location: index.php");
    }
    else {
    	$invalid_login = true;
    }
}
?>

<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Event Organizer - Authentification</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link rel="stylesheet" href="css/main.css">

     
    </head>
    <body>
        <div class="container">

            <div class="row">
                <div class="span6 offset3 well">
                    <h1>Welcome to Event Organizer!</h1>
                    <p>Event organizer is a website designed to allow users to participate in many events and also specify their availability.
                    Users can create events, get invited into ones and a lot more !</p>
                    <?php if ($invalid_login): ?>
                          <div class="alert alert-error">
                               Email or Password are incorrect.
                          </div>
                    <?php endif ?>

                    <form method="post" action="login.php" id="connectV">
                      <fieldset>
                        <legend>Authentification</legend>
                        <label>Email</label>
                        <input type="text" name="email" id="email" value="<?php echo (array_key_exists('email', $_POST) ? $_POST['email'] : '') ?>" />
                        <label>Password</label>
                        <input type="password" name="password" id="password" />
                      </fieldset>

                      <input class="btn btn-primary" type="submit" value="Log-In !" />
                      <a id="add-users" class="btn btn-success pull-right"><i class="icon-plus"></i></a>
                      <a id="hide-add-users-form" class="btn pull-right hide"><i class="icon-minus"></i></a>
                    </form>
                 
                </div>

             
            </div>
            
            

        </div> <!-- /container -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>

        <!--new account-->

        <div class="container">
    <div class="row">
        <div class="span12">
          
        </div>
        <div class="span12">
            <form onsubmit="return false" action="javascript:void(0)" class="form-horizontal pull-right" style="display: none" id="add-user-form">
                <legend style="text-align: right">New user</legend>

                <div class="control-group">
                    <label for="email" class="control-label">E-mail</label>
                    <div class="controls">
                        <input type="text" class="span2" id="email1">
                    </div>
                </div><!-- End email -->

                <div class="control-group">
                    <label for="firstname" class="control-label">First Name</label>
                    <div class="controls">
                        <input type="text" class="span2" id="firstname1">
                    </div>
                </div><!-- End firstname -->

                <div class="control-group">
                    <label for="lastname" class="control-label">Last Name</label>
                    <div class="controls">
                        <input type="text" class="span2" id="lastname1">
                    </div>
                </div><!-- End lastname -->

                <div class="control-group">
                    <label for="password" class="control-label">Password</label>
                    <div class="controls">
                        <input type="password" class="span2" id="password1">
                    </div>
                </div><!-- End password -->

                <div class="control-group">
                    <label for="password2" class="control-label">Confirm Password</label>
                    <div class="controls">
                        <input type="password" class="span2" id="password2">
                    </div>
                </div><!-- End password2 -->

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" id="save-user">Sign-Up!</button>
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
            var email = $('#email1').val();
            var firstname = $('#firstname1').val();
            var lastname = $('#lastname1').val();
            var password = $('#password1').val();
            var password2 = $('#password2').val();

            /* verification  e-mail*/
            if(email === "")
                return alert('Email is empty.');
             if ( !(/^[a-z0-9]+_?[a-z0-9]+@[a-z]+.[a-z]{2,3}$/.test(email)))
                return alert('Email format should be as follows : myname@domain.com / nom_prenom@domain.com / me23@yahoo.com');
            
            /* verification prenom */
            if(firstname === "")
                return alert('First name can not be empty.');
            if(/[0-9]/.test(firstname))
                return alert('First name can not contain numbers.');
                
            /* verification nom */
          if(lastname === "")
                return alert('Last name can not be empty');
            if(/[0-9]/.test(lastname))
                return alert('Last name can not contain numbers.');
                
            /* verification du password */
            if(password === "")
                return alert('Password can not be empty.');
            if(password2 == "")
                return alert('Password confirmation can not be empty');
            if(password != password2)
                return alert('Password confirmation does not match.');
            
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
                 
                  $('#add-user-form').slideUp('slow', function() {
                $('#hide-add-users-form').addClass('hide');
                $('#add-users').removeClass('hide');
               
            });

                }
            });
        });
    });
</script>

    </body>
</html>
