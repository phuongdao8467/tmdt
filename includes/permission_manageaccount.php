<?php
session_start();
if (isset($_SESSION['loggedin']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: login.html');
}
?>