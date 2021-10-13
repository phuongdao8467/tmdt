<?php 
	$conn=mysqli_connect("localhost","root","root");

	if(!$conn){
		die(mysqli_error($conn));
	}
	//echo "OK!<br>";
	$conn->set_charset('utf8');
	$result=mysqli_select_db($conn,"smartfood");
	$status2=3;
	$orderlist_id=3;
	$result=mysqli_query($conn,"update orderlist set status2='$status2' where orderlist_id='$orderlist_id'");
	if(!$result){
		echo "Thất bại";
	}
	else{
		echo "Thành công";
	}
?>