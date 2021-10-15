<?php 

$id = $_POST['coupon_id'];

$conn=mysqli_connect("localhost","root",'';
	if(!$conn){
		die(mysqli_error($conn));
	}
	$conn->set_charset('utf8');
	$result=mysqli_select_db($conn,"smartfood");
	$result=mysqli_query($conn,"call deleteCoupon('$id');");
	$check=mysqli_fetch_array($result);
	if($check[0]==-1){
		echo "Không thành công!";
	}
	else{
		echo "Thành công!";
	}
 ?>