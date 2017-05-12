<?php
$exp_date ="2017/05/12";
$today_date ="2017/05/11";

$exp=strtotime($exp_date);
$td=strtotime($today_date);
$exstock="item expire soon! Check stock now ! ";
if($td>$exp){
    
    $diff = $td-$exp;
    $x=abs (floor($diff/(60 * 60 * 24)));
    echo "<script> alert('$exstock');</script>";
    
}else{
    $diff=$td-$exp;
    $x=abs(floor($diff/(60 * 60 * 24)));
    echo "<script>alert('$exstock');</script>";
}

?>