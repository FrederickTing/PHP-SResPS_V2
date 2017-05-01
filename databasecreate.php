<?php 

$dbServer='localhost';
$dbUserName = 'root';
$dbPassword = '';
$dbName = 'phpsrsdb';

$dbConx = @mysql_connect($dbServer,$dbUserName,$dbPassword);

 

	if (mysql_select_db($dbName) == false)
	{
		$strSql = "CREATE DATABASE $dbName"; 
		$queryResult = @mysql_query($strSql,$dbConx);
		
		if ($queryResult == true){
		
		 echo "<p>Database '$dbName' successfully created</p>";
		 mysql_select_db($dbName);
		 
		 $tableName = 'item';
		 $strSql = "SHOW TABLES LIKES '$tableName' ";
		 $queryResult = @mysql_query($dbConx, $strSql); 
		
		 
			if(@mysql_num_rows($queryResult) == NULL){
				$strSql = "CREATE TABLE $tableName (item_id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY, item_name VARCHAR(50) NOT NULL, item_price DOUBLE NOT NULL, item_stock INT NOT NULL)";
				$queryResult = @mysql_query($strSql, $dbConx);
				
				
				if($queryResult){
					echo "<p>Table successfully created </p>";
					$strSql = "ALTER TABLE item AUTO_INCREMENT = 5000";
					$queryResult = @mysql_query ($strSql, $dbConx);
					
                    if($queryResult){
						echo "<p> Successfully alter increment </p>";
					}
					else{
						echo "<p> error in altering </p>";
					}
				}
				else{
					echo "<p>unable to create table</p>";
				}
				
			}
            else{
				echo "<p> Table already exist </p>";
			}
		 
		 mysql_select_db($dbName);
		 $tableName = 'sales';
		 $strSql = "SHOW TABLES LIKES '$tableName' ";
		 $dbConx = @mysql_connect($dbServer,$dbUserName,$dbPassword);
		 $queryResult = @mysql_query($dbConx, $strSql);  
		 
			if(@mysql_num_rows($queryResult) == NULL){
				$strSql = "CREATE TABLE $tableName (sales_id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY, sales_name VARCHAR(50) NOT NULL, sales_date DATE NOT NULL)";
				$queryResult = @mysql_query($strSql, $dbConx);
						
				
				if($queryResult){
					echo "<p>Table successfully created </p>";
					$strSql = "ALTER TABLE sales AUTO_INCREMENT = 200000";
					$queryResult = @mysql_query ($strSql, $dbConx);
					
                    if($queryResult){
						echo "<p> Successfully alter increment </p>";
					}
					else{
						echo "<p> error in altering </p>";
					}
				}
				else{
					echo "<p>Unable to create table. Error Code ".
						mysql_errno().":".mysql_error()."</p>";
				}
				
			}
            else{
				echo "<p> Table already exist </p>";
			}
		 
		
		 mysql_select_db($dbName);
		 $tableName = 'sold';
		 $strSql = "SHOW TABLES LIKES '$tableName' ";
		 $dbConx = @mysql_connect($dbServer,$dbUserName,$dbPassword);
		 $queryResult = @mysql_query($dbConx, $strSql); 
		  
		 
			if(@mysql_num_rows($queryResult) == NULL){
				$strSql = "CREATE TABLE $tableName (sold_id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				cust_id INT NOT NULL,sold_item VARCHAR(50),sold_itemquan INT, INDEX pn_user_index(cust_id),
				FOREIGN KEY(cust_id) REFERENCES sales(sales_id))";
				$queryResult = @mysql_query($strSql, $dbConx);
				
				
				if($queryResult)
				{
					echo "<p>Table successfully created </p>";
					$strSql = "ALTER TABLE sold AUTO_INCREMENT = 1000000000";
					$queryResult = @mysql_query ($strSql, $dbConx);
                    
					if($queryResult){
						echo "<p> Successfully alter increment </p>";
					}
					else{
						echo "<p> error in altering </p>";
					}
				}
				else{
					echo "<p>Unable to create table. Error Code ".
						mysql_errno().":".mysql_error()."</p>";
				}
				
			}
            else{
				echo "<p> Table already exist </p>";
			}
		 
		 
		 
		}
		else{
			echo "<p>Unable to connect to the database server.<br /> Error Code "
			. mysql_errno().":". mysql_error()."</p>"; 
		}
		
		
	}
	else{
		
	}
        if (mysql_connect() == false ){
		  echo "<p>Error to connect to the database server.<br /> Error Code ". mysql_errno().":". mysql_error()."</p>";
	}
	else{
		
	}
	
	
	mysql_close($dbConx);


?>