<?php
session_start();
// Do Something
$_SESSION['user']= $user_id;
$_SESSION['password'] =$pass;


if(isset($submit)){

    if($user=="user" && $pass=="pass"){
        $_SESSION['user']= $user;   
        //if correct password and name store in session 

}
else {

    echo "Invalid user and password";
    header("Locatin:form.php");

}

if(isset($_SESSION['user'])) 
{

//your home page code here

exit;
}
}
?>

