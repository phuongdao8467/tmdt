<?php 
	session_start();
	if(isset($_SESSION['value']) == false){
		$_SESSION['user_id']=null;
		return;
	}
	$conn=mysqli_connect("localhost","root","root");
	if(!$conn){
		die(mysqli_error($conn));
	}
	$value=$_SESSION['value'];
	$result=mysqli_select_db($conn,"smartfood");
	$conn->set_charset('utf8');
	$result=mysqli_query($conn,"call getUser_id('$value');");
	$check=mysqli_fetch_array($result);
	$_SESSION['user_id']=$check['user_id'];
?>