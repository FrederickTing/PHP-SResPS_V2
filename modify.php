<?php   session_start();  ?>
<DOCTYPE!>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<Title>Modify Sales</Title>
<script>
function check_empty()
{
	if (document.getElementById('name').value == "" || document.getElementById('date').value == "")
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
<form class ="form2" action ="modify.php" id = "form" method = "post" name = "form">
    <input id = "saleid" name ="saleid" placeholder ="Sales ID" type = "text" value = "<?php echo $_GET['id'] ?>"> 
    <input id = "name" name ="name" placeholder ="Name" type = "text" value ="<?php echo $_GET['nem'] ?>">
    <input id = "date" name ="date" placeholder = "Date" type ="date">
 <div id ="dynamicInput">
 <?php
$dbServer='localhost';
$dbUserName = 'root';
$dbPassword = '';
$dbName = 'phpsrsdb';
$dbConx = @mysql_connect($dbServer,$dbUserName,$dbPassword);
mysql_select_db($dbName,$dbConx);

$sqlstr = "SELECT item_name FROM item";
$medata = mysql_query($sqlstr,$dbConx);

echo "<table><tr class ='itemchoose'><td class ='itemchoose'>Item 1 <select class = 'selectname' name ='select' id= 'select'>";
$option='';
while($rs = mysql_fetch_array($medata))
	{
		$option.='<option value ="'.$rs["item_name"].'">'.$rs["item_name"].'</option>';
	}
	$option.='</select></td><td class ="itemchoose">';
	$option2 ='Quantity<select class ="valuenum" name ="value" id="value">';
	$option3='<option value ="1">1</option><option value ="2">2</option><option value ="3">3</option><option value ="4">4</option><option value ="5">5</option></select></td></tr></table>';
echo $option;
echo $option2;
echo $option3;


 ?>
 
 </div>
 
 <script>
 var counter = 1;
 var limit = 10;
 var js_data= '<?php echo $option; ?>';
 var js_data2 = '<?php echo $option3;?>';
 
 function addInput(divName){
		if (counter == limit)
		{
			alert("Limited Item Per Cart");
		}
		else
		{
			var newdiv = document.createElement('div');
			newdiv.innerHTML = '<table><tr class ="itemchoose"><td class ="itemchoose">Item ' + (counter+1)+' <select class = "selectname" name="select'+(counter+1)+'" id="select'+(counter+1)+'">'+js_data+'Quantity<select class ="valuenum" name ="value'+(counter+1)+'" id="value'+(counter+1)+'">'+js_data2;
			document.getElementById(divName).appendChild(newdiv);
			counter++;
		}
	}

 </script>
 
 
 <input type = "button" value = "Add Item" onClick ="addInput('dynamicInput');">
 <a href="javascript:%20check_empty()" id = "submitadd" name = "submitadd" class ="add"> Save Changes </a>
 <input type = "submit" value = "Delete" id = "delethis" name = "delethis" class ="delet">
 </form>
</div>

<?php
if( isset( $_REQUEST['delethis'] ))
{
	$saleid = $_POST["saleid"];
	$sqlstr = "SELECT * FROM sold WHERE cust_id ='$saleid'";
	$medata = mysql_query($sqlstr,$dbConx);
	while($recorditem = mysql_fetch_array($medata))
	{
		$ritem = $recorditem['sold_itemquan'];
		$rname = $recorditem['sold_item'];
		$sqlstr= "UPDATE item
		SET item_stock = item_stock + '$ritem' 
		WHERE item_name = '$rname'";
		mysql_query($sqlstr,$dbConx);
	}
	$sqlstr = "DELETE FROM sold WHERE cust_id='$saleid'";
	$medata = mysql_query($sqlstr,$dbConx);
	
	$sqlstr = "DELETE FROM sales WHERE sales_id='$saleid'";
	$medata = mysql_query($sqlstr,$dbConx);
	header('Location: sales.php');

}
else
{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$saleid = $_POST["saleid"];
		$name = $_POST["name"];
		$date = $_POST["date"];
		
		$sqlstr = "SELECT * FROM sold WHERE cust_id ='$saleid'";
		$medata = mysql_query($sqlstr,$dbConx);
		while($recorditem = mysql_fetch_array($medata))
		{
			$ritem = $recorditem['sold_itemquan'];
			$rname = $recorditem['sold_item'];
			$sqlstr= "UPDATE item
			SET item_stock = item_stock + '$ritem' 
			WHERE item_name = '$rname'";
			mysql_query($sqlstr,$dbConx);
		}
		
		$sqlstr = "UPDATE sales SET sales_name ='$name',sales_date='$date'
		WHERE sales_id = '$saleid'";
		
		mysql_query($sqlstr,$dbConx);
		
		$sqlstr = "SELECT sales_id FROM sales ORDER BY id LIMIT 1";
		$medata = mysql_query($sqlstr,$dbConx);
		
		$sqlstr = "DELETE FROM sold WHERE cust_id='$saleid'";
		$medata = mysql_query($sqlstr,$dbConx);
		$solditem = $_POST["select"];
		$soldquan = $_POST["value"];
		
		$sqlstr = "INSERT INTO sold (cust_id,sold_item,sold_itemquan)
		VALUES ((SELECT sales_id FROM sales WHERE sales_name ='$name' AND sales_date='$date'),'$solditem','$soldquan')";
		mysql_query($sqlstr,$dbConx);
		
		$sqlstr = "UPDATE item SET item_stock = item_stock - '$soldquan' 
		WHERE item_name = '$solditem'";
		mysql_query($sqlstr,$dbConx);
		
		$x=2;
		while($x<=10)
		{   
			
			@$solditem2 = $_POST["select".$x.""];
			@$soldquan2 = $_POST["value".$x.""];
			if(isset($solditem2))
			{
			$sqlstr = "INSERT INTO sold (cust_id,sold_item,sold_itemquan)
			VALUES ((SELECT sales_id FROM sales WHERE sales_name ='$name' AND sales_date='$date'),'$solditem2','$soldquan2')";
			mysql_query($sqlstr,$dbConx);
			$sqlstr = "UPDATE item SET item_stock = item_stock - '$soldquan' 
			WHERE item_name = '$solditem'";
			mysql_query($sqlstr,$dbConx);
			}
			else{}
			$x++;
		}
		header('Location: sales.php');
		unset($_POST);
	}
	else
	{
		
	}
		
}

?>


</body>
</html>