<?php
session_start();
$conn = mysqli_connect("localhost", "root", '');
if (!$conn) {
	die(mysqli_error($conn));
}
include("includes/permission_manageaccount.php");
$value = $_SESSION['value'];
$result = mysqli_select_db($conn, "smartfood");
$conn->set_charset('utf8');
$result = mysqli_query($conn, "call getUser_id('$value');");
$check = mysqli_fetch_array($result);
$user_id = $check['user_id'];
?>
<?php
//session_start();
include("includes/check-shutdown.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Manage account</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body class="animsition">

	<!--
					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<div class="topbar-child2-mobile">
							<span class="topbar-email">
								fashe@example.com
							</span>
							<div class="topbar-language rs1-select2">
								<select class="selection-1" name="time">
									<option>USD</option>
									<option>EUR</option>
								</select>
							</div>
						</div>
					</li>
					
					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<a href="#" class="topbar-social-item fa fa-facebook"></a>
							<a href="#" class="topbar-social-item fa fa-instagram"></a>
							<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
							<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
							<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
						</div>
					</li>
					-->

	<!-- Header -->
	<?php
	include("includes/header.php");
	?>


	<!-- Slide1 -->
	<!--End of Header Area-->
	</div>
	<div class="contentforlayout">
		<br>
		<br>
		<br>
		<br>
		<div class="container">
			<div class="row">
				<div id="content" class="col-sm-12">
					<div class="row">
						<div class="col-4">
							<div class="list-group" id="list-tab" role="tablist">
								<a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Tài khoản</a>
								<a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Chức vụ</a>
								<a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Liên lạc</a>
								<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Đổi mật khẩu</a>
							</div>
						</div>
						<div class="col-8">
							<div class="tab-content" id="nav-tabContent">
								<?php
								$conn = mysqli_connect("localhost", "root", '');
								if (!$conn) {
									die(mysqli_error($conn));
								}
								$result = mysqli_select_db($conn, "smartfood");
								$conn->set_charset('utf8');
								$result = mysqli_query($conn, "select * from user where user_id=$user_id;");
								$user_detail = mysqli_fetch_array($result);
								?>
								<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
									<p class="lead">
										Họ và tên: &ensp; <?php echo $user_detail['name']; ?>
									</p>
									<p class="lead">
										Email:&emsp; &emsp; &nbsp; <?php echo $user_detail['email']; ?>
									</p>
								</div>
								<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
									<p class="lead">
										Chức vụ: &ensp; <?php 
													switch ($user_detail['role1']) {
														case 1:
															echo "Kỹ thuật viên";
															break;
														case 2:
															echo "Nhân viên";
															break;
														case 4:
															echo "Quản trị viên";
															break;
														case 3:
															echo "Khách hàng";
															break;
													}
													?>
									</p>
								</div>
								<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">

									<p class="lead">
										Số điện thoại: &ensp; <?php echo $user_detail['phonenumber']; ?>
									</p>
								</div>
								<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
									<p class="lead">
										<div class="col-sm-6">

											<form method="post" action="#" id="create_customer" accept-charset="UTF-8"><input type="hidden" name="form_type" value="create_customer" /><input type="hidden" name="utf8" value="✓" />
												<div class="form-group required">
													<label class="lead" for="password">Mật khẩu hiện tại</label>
													<div class="col-sm-10">
														<input type="password" value="" id="current_password" placeholder="Mật khẩu hiện tại" class="form-control">
													</div>
												</div>
												<div class="form-group required">
													<label class="lead" for="password">Mật khẩu mới</label>
													<div class="col-sm-10">
														<input type="password" value="" id="create_password" placeholder="Mật khẩu mới" class="form-control">
													</div>
												</div>
												<div class="form-group required">
													<label class="lead" for="password">Nhập lại mật khẩu mới</label>
													<div class="col-sm-10">
														<input type="password" value="" id="repeat_password" placeholder="Nhập lại mật khẩu mới" class="form-control">
													</div>
												</div>
												<div>
													<button name="change-password" id="button-change-password" class="btn btn-primary">
														<span>
															<i class="fa fa-key"></i>
															Xác nhận
														</span>
													</button>
												</div>
										</div>
									</p>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<br>
			<br>
			<br>
													
		
		</div>
	    <br>
		<br>
		<br>
		<br>

		<!-- Footer -->
		<?php include("includes/footer.php");?>



		<!-- Back to top -->
		<div class="btn-back-to-top bg0-hov" id="myBtn">
			<span class="symbol-btn-back-to-top">
				<i class="fa fa-angle-double-up" aria-hidden="true"></i>
			</span>
		</div>

		<!-- Container Selection1 -->
		<div id="dropDownSelect1"></div>

		<!-- Modal Video 01-->
		<div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">

			<div class="modal-dialog" role="document" data-dismiss="modal">
				<div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

				<div class="wrap-video-mo-01">
					<div class="w-full wrap-pic-w op-0-0"><img src="images/icons/video-16-9.jpg" alt="IMG"></div>
					<div class="video-mo-01">
						<iframe src="https://www.youtube.com/embed/Nt8ZrWY2Cmk?rel=0&amp;showinfo=0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>

		<!--===============================================================================================-->
		<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
		<!--===============================================================================================-->
		<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
		<!--===============================================================================================-->
		<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
		<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<!--===============================================================================================-->
		<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
		<script type="text/javascript">
			$(".selection-1").select2({
				minimumResultsForSearch: 20,
				dropdownParent: $('#dropDownSelect1')
			});
		</script>
		<!--===============================================================================================-->
		<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
		<script type="text/javascript" src="js/slick-custom.js"></script>
		<!--===============================================================================================-->
		<script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>
		<!--===============================================================================================-->
		<script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>
		<!--===============================================================================================-->
		<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
		<script type="text/javascript">
			$('.block2-btn-addcart').each(function() {
				var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
				$(this).on('click', function() {
					swal(nameProduct, "is added to cart !", "success");
				});
			});

			$('.block2-btn-addwishlist').each(function() {
				var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
				$(this).on('click', function() {
					swal(nameProduct, "is added to wishlist !", "success");
				});
			});
			$('button#button-change-password').click(function() {
				var user_id = '<?php echo $user_id;?>';
				var create_password = document.getElementById('create_password').value;
				var repeat_password = document.getElementById('repeat_password').value;
				var current_password = document.getElementById('current_password').value;				
				if (!current_password || !create_password || !repeat_password) {
					alert("Vui lòng nhập đủ thông tin");
					return;
				}
				if (create_password != repeat_password) {
					alert("Mật khẩu lặp lại không khớp");
					return;
				}
				var postData = new FormData();
				postData.append("user_id", user_id);
				postData.append("ctpass", create_password);
				postData.append("cupass", current_password);
				$.ajax({
					type: 'POST',
					url: 'account.php',
					processData: false,
					contentType: false,
					data: postData,
					success: (msg) => {
						alert(msg);
					},
					error: (error) => {
						alert("Failure");
					}

				});

			});
		</script>
		<!--===============================================================================================-->
		<script type="text/javascript" src="vendor/parallax100/parallax100.js"></script>
		<script type="text/javascript">
			$('.parallax100').parallax100();
		</script>
		<!--===============================================================================================-->
		<script src="js/main.js"></script>

</body>

</html>