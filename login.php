<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
    <title>Login/Home</title>
</head>
<body>
<center><h1><em><font color="black">&#9769;People Health Pharmacy Sales Reporting System &#9769;</font></em></h1></center>
<center><h2>&#9769; Please Login before make any changes on inventory &#9769;</h2></center>
<center><h3> Login as Below :  </h3></center>
    <table align="center" bgcolor="#CCCCCC" border="0" cellpadding="0"
    cellspacing="1" width="300">
        <tr>
            <td>
                <form method="post" name="Login">
                    <table bgcolor="#FFFFFF" border="0" cellpadding="1"
                    cellspacing="1" width="100%">
                        <tr>
                            <td align="center" colspan="3"><strong>User
                            Login</strong></td>
                        </tr>
                        <tr>
                            <td width="78">Username</td>
                            <td width="6">:</td>
                            <td width="294"><input id="username" name=
                            "username" type="text"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>:</td>
                            <td><input id="password" name="password" type=
                            "password"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input name="submit" type="submit" value=
                            "Login"> <input name="reset" type="reset" value=
                            "reset"></td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
    </table>
    <?php
    if (isset($_POST['submit']))
        {     
    include("config.php");
    $username=$_POST['username'];
    $password=$_POST['password'];
    $_SESSION['login_user']=$username; 
    $query = mysql_query("SELECT username FROM login WHERE username='$username' and password='$password'");
     if (mysql_num_rows($query) != 0)
    {
     echo "<script language='javascript' type='text/javascript'> location.href='sales.php' </script>";   
      }
      else
      {
    echo "<script type='text/javascript'>alert('User Name Or Password Invalid!')</script>";
    }
    }
    ?>
    <div id="image"></div><img src="img/Pharc.jpg"></div>
</body>
</html>