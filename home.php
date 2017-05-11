<?php session_start();  
?>

<DOCTYPE!>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<Title>Login / Home</Title>

</head>
<body>
<!--
<?php  
?>
-->

<div class="body2"> 
<h1><em><font color="black">&#9769;People Health Pharmacy Sales Reporting System &#9769;</font></em></h1>
<h2>&#9769; Please Login before make any changes on inventory &#9769;</h2>
<h3> Login as Below :  </h3>
<br />
<form action="sales.php" >
  <div class="imgcontainer">
     <img src ="img/login2.png" alt="Logo" height="100" width="200" />
  </div>

  <div class="container">
    <label><b><font face="sans-serif">Username &darr;</font></b></label><br />
    <input type="text" name="name" placeholder="Enter Username"  required />
    <br />
    <br />
    <label><b><font face="sans-serif">Password &darr;</font></b></label><br />
    <input type="password" name="pass" placeholder="Enter Password"  required />
    <br /><br />
    <font face="sans-serif"><button type="submit" class="add">Login</button></font><br />
    <input type="checkbox" checked="checked" /><font face="sans-serif"> Remember me</font>
  </div>


</form>
</div>
<?php
    if (isset($_POST['submit']))
        {     
    include("config.php");
    session_start();    
    $username=$_POST['username'];
    $password=$_POST['password'];
    $_SESSION['login_user']=$username; 
    $query = mysql_query("SELECT username FROM login WHERE username='$username' and password='$password'");
     if (mysql_num_rows($query) != 0)
    {
     echo "<script language='javascript' type='text/javascript'> location.href='home.php' </script>";   
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
