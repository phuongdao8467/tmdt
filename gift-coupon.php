<?php
ini_set('xdebug.overload_var_dump', 0);
$name = $_POST['name'];
$coupon_id = $_POST['coupon'];
$num = intval($_POST['num']);
$conn = mysqli_connect("localhost", "root", "root");
if (!$conn) {
	die(mysqli_error($conn));
}
$conn->set_charset('utf8');
$result = mysqli_select_db($conn, "smartfood");
$list = array();
$result = mysqli_query($conn, "select user_id from user where name LIKE '%$name%'");
while ($check = mysqli_fetch_array($result)) {
	array_push($list, $check['user_id']);
}
foreach ($list as $user_id) {
	$result = mysqli_query($conn, "call addCouponUser('$user_id','$coupon_id','$num');");
	$check = mysqli_fetch_array($result);
	if ($check[0] == -1) {
		echo "Lỗi";
		return;
	} elseif ($check[0] == 1) {

	} else {
		echo mysqli_error($conn);
	}
}
echo "Thành công!";
