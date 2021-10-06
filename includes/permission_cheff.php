<?php
	session_start();
	if (isset($_SESSION['loggedin']) == false) {
		// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
		header('Location: login.html');
	}else {
	$conn=mysqli_connect("localhost","root","root");
	if(!$conn){
		die(mysqli_error($conn));
	}
	$value=$_SESSION['value'];
	$result=mysqli_select_db($conn,"smartfood");
	$conn->set_charset('utf8');
	$result=mysqli_query($conn,"call getUser_id('$value');");
	$check=mysqli_fetch_array($result);
	$user_id=$check['user_id'];
	mysqli_next_result($conn);
	$result=mysqli_query($conn,"call getRole('$user_id');");
	$check=mysqli_fetch_array($result);
	$role=$check['role1'];
	if (isset($role) == true) {
		if ($role!= '2') {
			// Nếu không phải admin thì xuất thông báo
			echo "Bạn không đủ quyền truy cập vào trang này<br>";
			echo "<a href='index.php'> Click để về lại trang chủ</a>";
			exit();
		}
	}
}
?>