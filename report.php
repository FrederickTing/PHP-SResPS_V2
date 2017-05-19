<?php  session_start();  ?>
<DOCTYPE!>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="fusionchart.js"></script>
<Title>Report Page</Title>

</head>
<body>

<?php 
include 'sidemenu.php';
include 'export.php';
?>
<div class="body2">



    <h1><font color="grey"> Report System </font></h1>
	<hr />
	<h2> Weekly/Monthly Report </h2>
    <div class="container">
	<table class="table table-hover">
	<tr><th width="5%"> Customer Name: </th>
	<th width="15%"> Date: </th>
	<th width="5%"> Sales ID: </th>
	<th width="10%"> Total Quantity </th>
	<th width="10%"> Total Price </th>
	<th width="20%"> Item </th>
	<th width="5%"> Quantity</th>
	</tr>
    
        
		<form action ="report.php" id = "form" method = "post" name ="form">
		<p> Generate from Date 1 to Date 2 </p>
		 Date 1<input id = "date1" name = "date1" placeholder ="Date 1" type = "date">
		Date 2<input id = "date2" name = "date2" placeholder ="Date 2" type = "date">
		<input type = "submit" value = "Generate" name = "submit">
		</form>
		<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
		$dbServer='localhost';
		$dbUserName = 'root';
		$dbPassword = '';
		$dbName = 'phpsrsdb';
		$dbConx = @mysql_connect($dbServer,$dbUserName,$dbPassword);
		mysql_select_db($dbName,$dbConx);
		$date1 = $_POST["date1"];
		$date2 = $_POST["date2"];
		$sqlstr = "SELECT * FROM sales WHERE sales_date >= '$date1' AND sales_date <= '$date2'";
		$medata = mysql_query($sqlstr,$dbConx);
		
		$ttlallquan = 0;
		$ttlallprice = 0;
		
		while($record = mysql_fetch_array($medata))
		{
				echo "<tr><td>".$record['sales_name']."</td>";
				echo "<td>".$record['sales_date']."</td>";
				echo "<td>".$record['sales_id']."</td>";
				
				$ttlquan = 0;
				$ttlprice = 0;
				
				$sqlitem = "SELECT * FROM sold WHERE cust_id =".$record['sales_id'];
				$datatwo = mysql_query($sqlitem,$dbConx);
				while($recorditem = mysql_fetch_array($datatwo))
				{	
					
					$slditm = $recorditem['sold_item'];
					$sldquan = $recorditem['sold_itemquan'];
					$sql = "SELECT * FROM item WHERE item_name = '$slditm'";
					$datathree = mysql_query($sql,$dbConx);
					$datree = mysql_fetch_array($datathree);
					
					$itmprice = $datree['item_price'];
					
					$ttlprice = $ttlprice + ($itmprice*$sldquan);
					$ttlquan = $ttlquan + $sldquan;
					
				}
				echo "<td>".$ttlquan."</td>";
				echo "<td>".$ttlprice."</td>";
				$sqlitem = "SELECT * FROM sold WHERE cust_id =".$record['sales_id'];
				$datatwo = mysql_query($sqlitem,$dbConx);
				while($recorditem = mysql_fetch_array($datatwo))
				{	
					
					echo "<td>".$recorditem['sold_item']."</td>";
					echo "<td>".$recorditem['sold_itemquan']."</td>";
					
				}
				echo "</tr>";
			$ttlallquan = $ttlallquan +$ttlquan;
			$ttlallprice = $ttlallprice + $ttlprice;
		}
		
		echo "<h3>Total Quantity of Items Sold Within The Date: ".$ttlallquan."</h3><h3>".
		"Total Price of Sold Item: RM ".$ttlallprice."</h3>";
		}
		else
		{
			
		}
		?>
       
		</table>
        <form method="post" action="export.php">
        <input type="submit" name="export" value="CSV Export" class="btn btn-success">
        </form>
	
	<br><br>
	<h2> Daily Sales Report </h2>
	<table class="table table-hover">
	<tr><th width="20%"> Customer Name: </th>
	<th width="5%"> Date: </th>
	<th width="5%"> Sales ID: </th>
	<th width="5%"> Total Quantity </th>
	<th width="10%"> Total Price </th>
	<th width="20%"> Item</th>
	<th width="5%"> Quantity</th>
	</tr>
	
<?php
$dbServer='localhost';
$dbUserName = 'root';
$dbPassword = '';
$dbName = 'phpsrsdb';
$dbConx = @mysql_connect($dbServer,$dbUserName,$dbPassword);
mysql_select_db($dbName,$dbConx);
$sqlstr = "SELECT * FROM sales";
$medata = mysql_query($sqlstr,$dbConx);
while($record = mysql_fetch_array($medata))
{
		echo "<tr><td>".$record['sales_name']."</td>";
		echo "<td>".$record['sales_date']."</td>";
		echo "<td>".$record['sales_id']."</td>";
		
		$ttlquan = 0;
		$ttlprice = 0;
		$sqlitem = "SELECT * FROM sold WHERE cust_id =".$record['sales_id'];
		$datatwo = mysql_query($sqlitem,$dbConx);
		while($recorditem = mysql_fetch_array($datatwo))
		{	
			
			$slditm = $recorditem['sold_item'];
			$sldquan = $recorditem['sold_itemquan'];
			$sql = "SELECT * FROM item WHERE item_name = '$slditm'";
			$datathree = mysql_query($sql,$dbConx);
			$datree = mysql_fetch_array($datathree);
			
			$itmprice = $datree['item_price'];
			
			$ttlprice = $ttlprice + ($itmprice*$sldquan);
			$ttlquan = $ttlquan + $sldquan;
			
		}
		echo "<td>".$ttlquan."</td>";
		echo "<td>".$ttlprice."</td>";
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

</div>
<?php
    

?>

<div id="image"></div><img src="img/Pharc.jpg"></div>
</body>
</html>
