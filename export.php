<?php
if(isset($_POST["export"]))
{
    $connect= mysqli_connect("localhost","root","","phpsrsdb");
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    
    $output= fopen("php://output","w");
    fputcsv($output,array('Sales ID','Sales Name','Sales Date'));
    $query="SELECT * FROM sales ORDER BY sales_id DESC";
    $result = mysqli_query($connect,$query);
    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($output,$row);
    }
    fclose($output);
}
    
?>