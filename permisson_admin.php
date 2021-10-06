<?php
if (isset($_SESSION['user_id']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: login.html');
}else {
	if (isset($_SESSION['role']) == true) {
		// Ngược lại nếu đã đăng nhập
		$permission = $_SESSION['role'];
		// Kiểm tra quyền của người đó có phải là admin hay không
		if ($permission != '4') {
			// Nếu không phải admin thì xuất thông báo
			echo "Bạn không đủ quyền truy cập vào trang này<br>";
			echo "<a href='index.html'> Click để về lại trang chủ</a>";
			exit();
		}
	}
}
?>