<?php 
	$name_food=$_POST['nameProduct'];
	$user_id=$_POST['user_id'];
	$conn=mysqli_connect("localhost","root","root");
	if(!$conn){
		die(mysqli_error($conn));
	}
	//echo "OK!<br>";
	$conn->set_charset('utf8');
	$result=mysqli_select_db($conn,"smartfood");
	$result=mysqli_query($conn,"select food_id from food where name='$name_food' ;");
	$check=mysqli_fetch_array($result);
	$food_id=$check['food_id'];
	$num=1;
	$time=date('Y-m-d H:i:s');
	$status=1;
	$result=mysqli_query($conn,"call addOrder('$user_id','$food_id','$num','$time','$status');");
	$check=mysqli_fetch_array($result);
	if($check[0]!=-1){
		echo "Thành công";
	}
	else{
		echo "Thất bại";
	}
?>