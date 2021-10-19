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
	<title>Giỏ hàng</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
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
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
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

	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-02.jpg);">
		<!-- <h2 class="l-text2 t-center">
			Cart
		</h2> -->
	</section>

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart" id="table_item">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Sản phẩm</th>
							<th class="column-3">Giá</th>
							<th class="column-4 p-l-70">Số lượng</th>
							<th class="column-5">Tổng</th>
						</tr>
						<?php
						$conn = mysqli_connect("localhost", "root", '');
						if (!$conn) {
							die(mysqli_error($conn));
						}
						$result = mysqli_select_db($conn, "smartfood");
						$conn->set_charset('utf8');
						$result = mysqli_query($conn, "call showOrderUser($user_id);");
						$count = 1;
						$orders = array();
						$food = array();
						$num = array();
						while ($row = mysqli_fetch_array($result)) {
							$order_id = $row['orderlist_id'];
							$food_id = $row['food_id'];
							if ($row['status2'] != '1') continue;
							$num1 = $row['num'];
							array_push($food, $food_id);
							array_push($num, $num1);
							array_push($orders, $order_id);
						}
						$mi = new MultipleIterator();
						$mi->attachIterator(new ArrayIterator($orders));
						$mi->attachIterator(new ArrayIterator($food));
						$mi->attachIterator(new ArrayIterator($num));
						$sum = 0;
						$discount = 0;
						mysqli_next_result($conn);
						foreach ($mi as $value) {
							list($order_id, $food_id, $num) = $value;
							$result1 = mysqli_query($conn, "select image,name,price from food where food_id='$food_id'");

							while ($row = mysqli_fetch_array($result1)) {
						?>
								<tr class="table-row">
									<td class="column-0" style="display: none;"><?php echo $order_id; ?> </td>
									<td class="column-1">
										<div class="cart-img-product b-rad-4 o-f-hidden">
											<img src="<?php echo "images/" . $row['image']; ?>" style="height: 100px; width:150px;" alt="IMG-PRODUCT">
										</div>
									</td>
									<td class="column-2"><?php echo $row['name']; ?>
									</td>
									<td class="column-3"><?php echo $row['price']; ?> VND</td>
									<td class="column-4">
										<div class="flex-w bo5 of-hidden w-size17">
											<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
												<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
											</button>

											<input class="size8 m-text18 t-center num-product" type="number" name="num-product1" value="<?php echo $num; ?>">

											<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
												<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
											</button>
										</div>
									</td>
									<td class="column-5"><?php echo $row['price'] * $num;
															$sum = $sum + ($row['price'] * $num); ?> VND</td>
								</tr>
						<?php }
						} ?>

					</table>
				</div>
			</div>

			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="flex-w flex-m w-full-sm">
					<div class="size11 bo4 m-r-10">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code" placeholder="Coupon Code">
					</div>

					<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<!-- Button -->
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="button-apply">
							Áp dụng mã giảm giá
						</button>
					</div>
				</div>

				<div class="size10 trans-0-4 m-t-10 m-b-10">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="button-update" name="update">
						Cập nhật giỏ hàng
					</button>
				</div>
			</div>
			<!--list of coupon can use-->
			<h3 class="m-text20 p-b-24">
				Mã giảm giá của bạn
			</h3>
			<div class="container">
				<div class="row">
					<div class="col-sm-20 col-md-6">
						<div class="table-responsive">
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
						<!--history of cart-->
					</div>
					<div class="col-sm-6">
						<!-- Total -->
						<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
							<h5 class="m-text20 p-b-24">
								Cart Totals
							</h5>

							<div class="flex-w flex-sb-m p-t-26 p-b-30">
								<span class="m-text22 w-size19 w-full-sm">
									Địa chỉ:
								</span>
								<div class="size11 bo4 m-r-10">
									<input class="sizefull s-text7 p-l-22 p-r-22" type="text" placeholder="Địa chỉ" id="address">
								</div>

								<span class="m-text22 w-full-sm">
									Số điện thoại:
								</span>
								<div class="size11 bo4 m-r-10">
									<input class="sizefull s-text7 p-l-22 p-r-22" type="text" placeholder="Số điện thoại" id="phone-number">
								</div>

								<span class="m-text22 w-full-sm">
									Tên người nhận:
								</span>
								<div class="size11 bo4 m-r-10">
									<input class="sizefull s-text7 p-l-22 p-r-22" type="text" placeholder="Người nhận" id="receiver">
								</div>
						
							</div>
							
							<div class="flex-w flex-sb-m p-t-26 p-b-30">
								<span class="m-text22 w-size19 w-full-sm">
									Total:
								</span>

								<span class="m-text21 w-size20 w-full-sm" id="amount">
									<?php echo $sum - $discount . "VND"; ?>
								</span>
								<span class="m-text22 w-full-sm">
									Phương thức thanh toán:
								</span>
								<form>
									<label class="radio-inline">
										<input type="radio" name="genderS" value="1" checked="checked">Tiền Mặt</input>
									</label>
								</form>
							</div>
							<div class="size15 trans-0-4">
								<!-- Button -->
								<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="payment">
									Proceed to Checkout
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>



	<!-- Footer -->
	<?php include("includes/footer.php");?>



	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>


	<script>
		$(function() {
			$("button#payment").click(function() {
				var y = document.getElementsByClassName("column-0");
				var Order_id = [].map.call(y, function(node) {
					return node.textContent || node.innerText || "";
				});
				var coupon_id = document.getElementsByName("coupon-code")[0].value;
				var user_id = "<?php echo $user_id; ?>";
				var address = document.getElementById('address').value;
				var phone = document.getElementById('phone-number').value;
				var myName = document.getElementById('receiver').value;
				if (user_id == '' | address == '' | phone == '') {
					alert("Tên, Số điện thoại và Địa chỉ không được trống!");
					return;
				}
				var postData = new FormData();
				var amount;
				var bill_id;
				postData.append('order_id', Order_id);
				postData.append('coupon_id', coupon_id);
				postData.append('user_id', user_id);
				postData.append('address', address);
				postData.append('phone', phone);
				postData.append('name', myName);
				$.ajax({
					type: 'POST',
					url: 'create_bill.php',
					processData: false,
					contentType: false,
					data: postData,
					success: function(msg) {
						const obj = JSON.parse(msg);
						bill_id = obj.bill_id;
						amount = obj.amount;

						var f = document.createElement('form');
						f.method = 'POST';
						f.action = 'payreturn.php';
						var i = document.createElement('input');
						i.name = 'orderId';
						i.value = bill_id;
						f.appendChild(i);
						var i1 = document.createElement('input');
						i1.name = 'amount';
						i1.value = amount;
						f.appendChild(i1);
						document.body.appendChild(f);
						f.submit();
					},
					error: function() {
						alert("failure");
					}
				});
			});
			//twitter bootstrap script
			$("button#button-update").click(function() {
				var rows = $('#table_item> tbody > tr')
				for (i = 1; i < rows.length; i++) {
					var tr = rows[i];
					var Order_id = tr.cells[0].innerHTML;
					var Quantity = tr.cells[4].getElementsByTagName("input").item(0).value;
					// alert(Order_id);
					// alert(Quantity);
					var postData = new FormData();
					postData.append('order_id', Order_id);
					postData.append('num', Quantity);
					$.ajax({
						type: 'POST',
						url: 'update_order.php',
						processData: false,
						contentType: false,
						data: postData,
						success: function(msg) {
							location.reload();
						},
						error: function() {
							alert("failure");
						}
					});

				}


			});
			$('.size8 m-text18 t-center num-product').on('input', function() {
				alert('Input changed');
			});
			$('div[class="cart-img-product b-rad-4 o-f-hidden"]').click(function() {
				var str2 = $(this).parent().parent();
				orderlist_id = Object.values(str2)[0].cells[0].innerHTML;
				var postData = new FormData();
				postData.append('orderlist_id', orderlist_id);
				$.ajax({
					type: 'POST',
					url: 'delete_order.php',
					processData: false,
					contentType: false,
					data: postData,
					success: function(msg) {
						location.reload();
					},
					error: function() {
						alert("failure");
					}
				});
			});
			$("button#button-apply").click(function() {
				var coupon_id = document.getElementsByName("coupon-code")[0].value;
				var postData = new FormData();
				postData.append('coupon_id', coupon_id);
				var user_id = "<?php echo $user_id; ?>";
				postData.append('user_id', user_id);
				$.ajax({
					type: 'POST',
					url: 'check_coupon.php',
					processData: false,
					contentType: false,
					data: postData,
					success: function(msg) {
						alert("Thành công");
						var amount = document.getElementById("amount");
						const obj = JSON.parse(msg);
						discount = obj.discount;
						var sum = "<?php echo $sum; ?>";
						var ret = sum - discount;
						if (ret < 0) ret = 0;
						amount.textContent = String(ret) + "VND";
					},
					error: function() {
						alert("failure");
					}
				});

			});

		});
	</script>
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

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
		$('input[type=number]').change(function() {
			var str = $(this).parent().parent().parent();
			str = Object.values(str)[0].cells[3].innerHTML;
			var num = Object.values($(this))[0].value;

			str = str.substr(0, str.length - 4);
			var str2 = $(this).parent().parent().parent()[0].cells[5];
			str2.innerHTML = num * str + " VND";
		});
		$('button[class="btn-num-product-down color1 flex-c-m size7 bg8 eff2"]').click(function() {
			var str = $(this).parent();
			var str1 = Object.values(str)[0].children[1];
			num = parseInt(str1.value) - 1;
			var str2 = Object.values(str.parent().parent())[0];
			price = str2.cells[3].innerHTML;
			total = str2.cells[5];
			total.innerHTML = num * price.substr(0, price.length - 4) + " VND";
		});


		$('button[class="btn-num-product-up color1 flex-c-m size7 bg8 eff2"]').click(function() {
			var str = $(this).parent();
			var str1 = Object.values(str)[0].children[1];
			num = parseInt(str1.value) + 1;
			var str2 = Object.values(str.parent().parent())[0];
			price = str2.cells[3].innerHTML;
			total = str2.cells[5];
			total.innerHTML = num * price.substr(0, price.length - 4) + " VND";
		});
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>