<DOCTYPE!>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<Title>Modify Sales</Title>
<script>
function check_empty()
{
	if (document.getElementById('name').value == "" || document.getElementById('stock').value == "")
	{
		alert ("Fill All Fields");
	}
	else
	{
		document.getElementById('form').submit();
		alert("Form Submitted Successfully");
	}
}
</script>
</head>
<body>

<div class="top">
	<img></img>Welcome, &lt;User&gt; <!--Have php check if used is logged in-->
	<img></img>&lt;Date&gt; <!--Use .js get today's date -->
	<img></img>&lt;Log Out&gt; <!--function required-->
</div>
<?php 
include 'sidemenu.php';
?>
<div class="body2">
<form class ="form2" action ="modifyitem.php" id = "form" method = "post" name = "form">
    <input id = "itemid" name ="itemid" placeholder ="Item ID" type = "text" value = "<?php echo $_GET['id'] ?>"> 
    <input id = "name" name ="name" placeholder ="Item Name" type = "text" value ="<?php echo $_GET['nem'] ?>">
    <input id = "stock" name ="stock" placeholder = "Stock" type ="number">
    <input id = "price" name ="price" placeholder = "Price" type ="number">
 <div id ="dynamicInput">
 
 <a href="javascript:%20check_empty()" id = "submitadd" name = "submitadd" class ="add"> Save Changes </a>
 <input type = "submit" value = "Delete" id = "delethis" name = "delethis" class ="delet">
 </form>
</div>

<?php
$dbServer='localhost';
$dbUserName = 'root';
$dbPassword = '';
$dbName = 'phpsrsdb';
$dbConx = @mysql_connect($dbServer,$dbUserName,$dbPassword);
mysql_select_db($dbName,$dbConx);
if( isset( $_REQUEST['delethis'] ))
{
	$itemid = $_POST["itemid"];
	
	$sqlstr = "DELETE FROM item WHERE item_id='$itemid'";
	$medata = mysql_query($sqlstr,$dbConx);

}
else
{
	
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$itemid = $_POST["itemid"];
	$name = $_POST["name"];
	$stock = $_POST["stock"];
	$price = $_POST["price"];
	
	$sqlstr = "UPDATE item SET item_name ='$name',item_stock='$stock',item_price='$price'
	WHERE item_id = '$itemid'";
	
	mysql_query($sqlstr,$dbConx);
	
	
	header('Location: item.php');
	unset($_POST);
}
           else
{
	
}
?>
</div>


</body>
</html>