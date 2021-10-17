
<?php 
	$food_id=$_POST['food_id'];
	$status=$_POST['status'];
	if($status=='option1'){
		$status=1;
	}
	else{
		$status=0;
	}
	$conn=mysqli_connect("localhost","root",'');

	if(!$conn){
		die(mysqli_error($conn));
	}
	//echo "OK!<br>";
	$conn->set_charset('utf8');
	$result=mysqli_select_db($conn,"smartfood");
	$result=mysqli_query($conn,"call setfood('$food_id','$status');");
	$check=mysqli_fetch_array($result);
	if($check==-1){
		echo "Thất bại";
	}
	else{
		echo "Thành công";
	}
?>