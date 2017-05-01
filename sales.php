<?php   session_start();  ?>
<DOCTYPE!>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<Title>Sales Module</Title>

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
		
	}
}

function div_show()
{
	document.getElementById('poppy').style.display = "block";
}
function div_hide()
{
	document.getElementById('poppy').style.display = "none";
}

 </script>

</head>
<body>
<style>
body {margin:0;}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
    background-color: #4CAF50;
    color: white;
}
</style>
<?php 
include 'stock.php';
include 'sidemenu.php';
?>
<div class="body2"> 
<script>
	$(document).ready(function(){
		$('table tr').click(function(){
			$(this).addClass('selected').siblings().removeClass('selected');    
			var value=$(this).find('td:first').next('td').next('td').html();
			var nem=$(this).find('td:first').html();
			
			window.location.href ="modify.php?id="+value+"&nem="+nem;
		});
	});
</script>
<div id = "poppy">
 <div id ="popupContact">
 <form class ="form2" action ="sales.php" id = "form" method = "post" name = "form">
 <button  type ="button" class ="add" id = "close" onclick = "div_hide()">Close</button>
 <h2 class = "addsalestitle">Add Sales </h2>
 <hr>
 <input id = "name" name ="name" placeholder ="Name" type = "text">
 <input id = "date" name ="date" placeholder = "Date" type ="date">
 
 <div id = "dynamicInput">
<?php
	$dbServer='localhost';
	$dbUserName = 'root';
	$dbPassword = '';
	$dbName = 'phpsrsdb';
	$dbConx = @mysql_connect($dbServer,$dbUserName,$dbPassword);
	mysql_select_db($dbName,$dbConx);

	$sqlstr = "SELECT item_name FROM item";
	$medata = mysql_query($sqlstr,$dbConx);

		echo "<class ='itemchoose'><td class ='itemchoose'>Item 1 <select class = 'selectname' name ='select' id= 'select'>";
	$option='';
		while($rs = mysql_fetch_array($medata))
	{
		$option.='<option value ="'.$rs["item_name"].'">'.$rs["item_name"].'</option>';
	}
		$option.='</select>';
		$option2 ='Quantity<select class ="valuenum" name ="value" id="value">';
		$option3='<option value ="1">1</option><option value ="2">2</option><option value ="3">3</option><option value ="4">4</option><option value ="5">5</option></select>';
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
			alert("Maximum Item Per Cart");
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
 <a href="javascript:%20check_empty()" id = "submitadd" name = "submitadd" class ="add"> Save </a>
 </form>
 </div>
</div>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$solditem = $_POST["select"];
	$soldquan = $_POST["value"];
	
	$sqlstr = "SELECT * FROM item WHERE item_name = '$solditem'";
	$medata =mysql_query($sqlstr,$dbConx);
	$rcditem = mysql_fetch_array($medata);
	$rquan = $rcditem['item_stock'];
	
		if ($rquan +1 > $soldquan)
	{
		$name = $_POST["name"];
		$date = $_POST["date"];
		
		$sqlstr = "INSERT INTO sales(sales_name,sales_date) VALUES
		('$name','$date')";
		mysql_query($sqlstr,$dbConx);
		
		$sqlstr = "SELECT sales_id FROM sales ORDER BY id LIMIT 1";
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
				$sqlstr = "SELECT * FROM item WHERE item_name = '$solditem2'";
				$medata =mysql_query($sqlstr,$dbConx);
				$rcditem = mysql_fetch_array($medata);
				$rquan = $rcditem['item_stock'];
					if ($rquan +1 > $soldquan2)
				{
					$sqlstr = "INSERT INTO sold (cust_id,sold_item,sold_itemquan)
					VALUES ((SELECT sales_id FROM sales WHERE sales_name ='$name' AND sales_date='$date'),'$solditem2','$soldquan2')";
					mysql_query($sqlstr,$dbConx);
					$sqlstr = "UPDATE item SET item_stock = item_stock - '$soldquan2' 
					WHERE item_name = '$solditem2'";
					mysql_query($sqlstr,$dbConx);
				}
					else
					{
						echo "<script>alert('Items selected not enough')</script>";
					}
				}
					else{}
						$x++;
			}
			unset($_POST);
		}
			else
	{
		echo "<script>alert('Items selected not enough')</script>";
	}
}
else
{
	
}
?>
	<h1> Sales </h1>
	<hr />
	<br><br>
	<table>
	<tr><td> Customer Name: </td>
	<td> Date: </td>
	<td> Sales ID: </td>
	<td> Item/Quantity : </td>
	</tr>
	
<?php
$sqlstr = "SELECT * FROM sales";
$medata = mysql_query($sqlstr,$dbConx);
while($record = mysql_fetch_array($medata))
{
		echo "<tr><td>".$record['sales_name']."</td>";
		echo "<td>".$record['sales_date']."</td>";
		echo "<td>".$record['sales_id']."</td>";
		$sqlitem = "SELECT * FROM sold WHERE cust_id =".$record['sales_id'];
		$datatwo = mysql_query($sqlitem,$dbConx);
		while($recorditem = mysql_fetch_array($datatwo))
		{	
			
			echo "<td>".$recorditem['sold_item']."</td>";
			echo "<td>".$recorditem['sold_itemquan']."</td>";
			
		}
		echo "</tr>";
}
?>
	</table>
	<br>
	<br>
	<button type="button" class="add" id="popup" onclick = "div_show()"> Add new sale </button> 
	<p class="view">Edit Sales Record</a>
	
</div>

</body>
</html>
