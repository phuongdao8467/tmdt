<?php
session_start();
include("includes/permission_manageaccount.php");
$conn = mysqli_connect("localhost", "root", '');
if (!$conn) {
	die(mysqli_error($conn));
}
$value = $_SESSION['value'];
$result = mysqli_select_db($conn, "smartfood");
$conn->set_charset('utf8');
$result = mysqli_query($conn, "call getUser_id('$value');");
$check = mysqli_fetch_array($result);
$user_id = $check['user_id'];
mysqli_next_result($conn);
$result = mysqli_query($conn, "call getRole('$user_id');");
$check = mysqli_fetch_array($result);
$role = $check['role1'];
?>
<?php
    //session_start();
    include("includes/check-shutdown.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Bữa ăn của tôi</title>
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

	<!-- Header -->
	<?php
	include("includes/header.php");
	?>



	<!-- Slide1 -->
	<!--End of Header Area-->
	<!--start of content-->

	<body>
		<div class="container">
			<ul class="justify-content-center nav nav-tabs list-inline">
				<li class="active list-group-item" data-toggle="tab" href="#myOrder">Bữa ăn của tôi</li>	
				<li class="list-group-item" data-toggle="tab" href="#myCoupon">Mã giảm giá của tôi</li>
			</ul>
			<div class="tab-content">
				<!--table of order-->
				<div id="myOrder" class="tab-pane table-responsive in active">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Hình ảnh</th>
								<th>Tên món</th>
								<th>Số lượng</th>
								<th>Phương thức thanh toán</th>
								<th>Trạng Thái</th>
							</tr>
						</thead>
						<?php
						$conn = mysqli_connect("localhost", "root", '');
						if (!$conn) {
							die(mysqli_error($conn));
						}
						$food_id = mysqli_select_db($conn, "smartfood");
						$food_prop = mysqli_select_db($conn, "smartfood");
						$conn->set_charset('utf8');
						$order = mysqli_query($conn, "select * from orderlist where user_id=$user_id;");
						$total_price = 0;
						while ($row = mysqli_fetch_array($order)) {
							$food_item_id = $row['food_id'];
							$food_item = '';
							$food_prop = mysqli_query($conn, "select * from food where food_id=$food_item_id;");
							$food_item = mysqli_fetch_array($food_prop);
							$total_price = intval($total_price) + intval($row['num']) * intval($food_item['price']);
						?>
							<tbody>
								<tr>
									<td><img src="<?php echo "images/" . $food_item['image']; ?>" class="img-circle" alt="Mỳ cay" width="100" height="100"></td>
									<td><?php echo $food_item['name']; ?></td>
									<td><?php echo $row['num']; ?></td>
									<td><?php if ($row['status2'] == 2 or $row['status2'] == 4) {
											echo "Online";
										}
										if ($row['status2'] == 5 or $row['status2'] == 3) {
											echo "Tiền Mặt";
										} ?></td>
									<td><?php if ($row['status2'] == 4 or $row['status2'] == 5) {
											echo "Đã Hoàn Thành";
										}
										if ($row['status2'] == 2 or $row['status2'] == 3) {
											echo "Đang Chuẩn bị";
										}
										?>
									</td>
								</tr>
							</tbody>
						<?php } ?>

					</table>
				</div>
				<!--table of my coupon-->
				<div id="myCoupon" class="tab-pane table-responsive">
					<table class="table" id="table_coupon">
						<thead>
							<tr>
								<th class="column-1">#</th>
								<th class="column-2">Mã giảm giá</th>
								<th class="column-3">Giá trị</th>
								<th class="column-4 p-l-70">Hạn sử dụng</th>
								<th class="column-5">Số lượng</th>
							</tr>
						</thead>
						<?php
						$conn = mysqli_connect("localhost", "root", '');
						if (!$conn) {
							die(mysqli_error($conn));
						}
						$result = mysqli_select_db($conn, "smartfood");
						$result = mysqli_query($conn, "select usercoupon.coupon_id,num,end1,value from usercoupon,coupon where usercoupon.coupon_id=coupon.coupon_id and user_id='$user_id';
										");
						$order = 0;
						while ($row = mysqli_fetch_array($result)) {
							$order += 1;
						?>
							<tbody>
								<tr class="table-row">
									<th class="column-1"><?php echo $order; ?></th>
									<td class="column-2"><?php echo $row['coupon_id']; ?></td>
									<td class="column-3"><?php echo $row['value']; ?> VND</td>
									<td class="column-4 p-l-70"><?php echo $row['end1']; ?></td>
									<td class="column-5"><?php echo $row['num']; ?></td>
								</tr>
							</tbody>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</body>

	<!--end of content-->
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
	</script>

	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>