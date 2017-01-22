
<?php
include('../bootstrap.php');

$new_user = array(
	'email' => $_POST['email'],
	'password' => $_POST['password'],
	'firstname' => $_POST['firstname'],
	'lastname' => $_POST['lastname']
	 );
echo "allo";

        $mysqli = db_connect();
         echo'oui1';
        $email = $new_user['email'];
         echo'oui2';
        $password = $new_user['password'];
         echo'oui3';
        $firstname = $new_user['firstname'];
         echo'oui4';
        $lastname = $new_user['lastname'];
         echo'oui5';
        $query = "insert into users (email, password, firstname, lastname) values('$email', '$password', '$firstname', '$lastname')";
         echo'oui6';
        $mysqli->query($query);
        $mysqli->close();
        echo'oui';
       
    

?>
