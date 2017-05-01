<?php
$dbServer='localhost';
$dbUserName = 'root';
$dbPassword = '';
$dbName = 'phpsrsdb';
$dbConx = @mysql_connect($dbServer,$dbUserName,$dbPassword);
mysql_select_db($dbName,$dbConx);
$sqlstr = "SELECT * FROM item";
$medata = mysql_query($sqlstr,$dbConx);

$lowstock = "These Items Are Low In Stock:";
while($record = mysql_fetch_array($medata))
{
	if ($record['item_stock']< 4)
	{
		$lowstock = $lowstock.'\n'."Name: ".$record['item_name']." Quantity Left: ".$record['item_stock'].'\n';
	}
	else 
	{
		
	}
}
	if ($lowstock == "These Items Are Low In Stock:")
{

}
	else
{
	echo "<script> alert('$lowstock');</script>";	
}

?>