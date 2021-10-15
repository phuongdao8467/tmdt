<?php 
	$id = $_POST['coupon']['ID'];
	$value = $_POST['coupon']['value-coupon'];
	$date_start = $_POST['coupon']['date-start'];
	$date_end = $_POST['coupon']['date-end'];
	$conn=mysqli_connect("localhost","root",'');
	if(!$conn){
		die(mysqli_error($conn));
	}
	$conn->set_charset('utf8');
	$result=mysqli_select_db($conn,"smartfood");
	$result=mysqli_query($conn,"call modifyCoupon('$id','$date_start','$date_end','$value');");
	$check=mysqli_fetch_array($result);
	if($check[0]==-1){
		echo "Không thành công!";
	}
	else{
		echo "Thành công!";
	}
 ?>