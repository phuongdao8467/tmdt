<?php 
	ob_start();
	$url = "vendorOwner.php";
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
	$result=mysqli_query($conn,"call addCoupon('$id','$date_start','$date_end','$value');");
	$check=mysqli_fetch_array($result);
	if($check[0]==-1){
		echo "ID đã được dùng!";
	}
	else{
		echo "Thành công!";
	}
	while (ob_get_status()) 
	{
	    ob_end_clean();
	}

	// no redirect
	header( "Location: $url" );
?>
 ?>