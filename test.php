<?php 
	$conn=mysqli_connect("localhost","root","root");

	if(!$conn){
		die(mysqli_error($conn));
	}
	//echo "OK!<br>";
	$conn->set_charset('utf8');
	$result=mysqli_select_db($conn,"smartfood");
	$status2=5;
	$orderlist_id=3;
	$result=mysqli_query($conn,"update orderlist set status2='$status2' where orderlist_id='$orderlist_id'");
	if(!$result){
		echo "Thất bại";
	}
	else{
		echo "Thành công";
	}
	$user_id = 4;
	$counpon_id = NULL;
	$result=mysqli_query($conn,"select num from usercoupon where user_id='$user_id'and coupon_id='$counpon_id';");
    $check=mysqli_fetch_array($result);
	echo gettype($check);
?>