<?php 
	$orderlist_id=$_POST['orderlist_id'];
	$status2=$_POST['status2'];
	$conn=mysqli_connect("localhost","root",'');

	if(!$conn){
		die(mysqli_error($conn));
	}
	//echo "OK!<br>";
	$conn->set_charset('utf8');
	$result=mysqli_select_db($conn,"smartfood");
	// $result=mysqli_query($conn,"select status2  from orderlist where orderlist_id='$orderlist_id'");
	// $check=mysqli_fetch_array($result);
	// if($check[0]==3){
	// 	$status2=5;
	// }
	// elseif($check[0]==5){
	// 	$status2=3;
	// }
	// elseif($check[0]==2){
	// 	$status2=4;
	// }
	// elseif($check[0]==4){
	// 	$status2=2;
	// }
	// else{
	// 	$status2=4;
	// }
	$result=mysqli_query($conn,"update orderlist set status2='$status2' where orderlist_id='$orderlist_id'");
	// $check=mysqli_fetch_array($result);
	if(!$result){
		echo "Thất bại";
	}
	else{
		echo "Thành công";
	}
?>