<DOCTYPE!>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<Title>Home</Title>

</head>
<body>
<?php
include 'databasecreate.php';
?>

<?php 
include 'stock.php';
//include 'sidemenu.php';
?>
<div class="body2"> 
<h1>People Health Pharmacy Sales Reporting System</h1>
<h2> Please Login before make any changes on inventory </h2>
<h3> Login Below :  </h3>
<br>

<form action="sales.php">
  <div class="imgcontainer">
     <img src ="img/login.png" alt="Logo" height="100" width="100">
  </div>

  <div class="container">
    <label><b>Username</b></label><br>
    <input type="text" placeholder="Enter Username"  required>
    <br>
    <br>
    <label><b>Password</b></label><br>
    <input type="password" placeholder="Enter Password"  required>
    <br><br>
    <button type="submit">Login</button><br>
    <input type="checkbox" checked="checked"> Remember me
  </div>

    
</form>
</div>

</body>
</html>
