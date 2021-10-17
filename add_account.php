<?php
	$name=$_POST['employee']['name'];
	$phoneNumber=$_POST['employee']['phone-number'];
	$email=$_POST['employee']['email'];
	$password=$_POST['employee']['password'];
	$role=$_POST['role']=='cheff'?2:1;
	$gender=1;
	$conn=mysqli_connect("localhost","root",'');
	if(!$conn){
		die(mysqli_error($conn));
	}
	//echo "OK!<br>";
		$conn->set_charset('utf8');
		$result=mysqli_select_db($conn,"smartfood");
		$result=mysqli_query($conn,"call addUser('$name','$email','$password','$phoneNumber','$gender','$role');");
		$check=mysqli_fetch_array($result);
		if($check[0]==-1){
			echo "Email đã được dùng!";
		}
		else{
			echo "Thành công!";
		}
?>