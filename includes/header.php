<header class="header1">
	<!-- Header desktop -->
	<div class="container-menu-header">
		<div class="topbar">
			<span class="topbar-child1">
			Đại học Bách Khoa đại học quốc gia thành phố Hồ Chí Minh	
			</span>
		</div>

		<div class="wrap_header">
			<!-- Logo -->
			<a href="index.php" class="logo">
				<img src="images/icons/logo.png" alt="IMG-LOGO">
			</a>

			<!-- Menu -->
			<div class="wrap_menu">
				<nav class="menu">
					<ul class="main_menu">
						<li>
							<a href="index.php">Trang chủ</a>
						</li>

						<li>
							<a href="product.php">Cửa hàng</a>
						</li>
						<?php
						session_start();
						if (isset($_SESSION['loggedin']) == false) {
						} else {
							$conn = mysqli_connect("localhost", "root", "root");
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
							if (isset($role) == true) {
								// Ngược lại nếu đã đăng nhập		// Kiểm tra quyền của người đó có phải là admin hay không
								if ($role == '4') {
						?>
									<li>
										<a>Tính năng</a>
										<ul class="sub_menu">
											<li><a href="vendorOwner.php">Chủ cửa hàng</a></li>
										</ul>
									</li>
								<?php
								}
								if ($role == '2') {
								?>
									<li>
										<a>Tính năng</a>
										<ul class="sub_menu">

											<li><a href="cook.php">Đầu bếp</a></li>
										</ul>
									</li>
								<?php
								}
								if ($role == '1') {
								?>
									<li>
										<a>Tính năng</a>
										<ul class="sub_menu">

											<li><a href="ITstaff.php">Nhân viên kỹ thuât</a></li>
										</ul>
									</li>
						<?php
								}
							}
						}
						?>
						<li>
							<a href="about.php">Thông tin</a>
						</li>

						<li>
							<a href="contact.php">Liên lạc</a>
						</li>
					</ul>
				</nav>
			</div>

			<!-- Header Icon -->
			<div class="header-icons">

				<?php include "./phpModules/checkLoggedIn.php"; ?>


				<span class="linedivide1"></span>

				<a href="manageaccount.php" class="header-wrapicon1 dis-block">
					<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
				</a>

				<span class="linedivide1"></span>

				<div class="header-wrapicon2">
					<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
					<?php include "./phpModules/displayCart.php"; ?>
					<div class="header-cart-buttons">
						<div class="header-cart-wrapbtn">
							<!-- Button -->
							<a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
								Giỏ hàng
							</a>
						</div>

						<div class="header-cart-wrapbtn">
							<!-- Button -->
							<a href="myOrder.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
								Túi của tôi
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

	<!-- Header Mobile -->
	<div class="wrap_header_mobile">
		<!-- Logo moblie -->
		<a href="index.php" class="logo-mobile">
			<img src="images/icons/logo.png" alt="IMG-LOGO">
		</a>

		<!-- Button show menu -->
		<div class="btn-show-menu">
			<!-- Header Icon mobile -->
			<div class="header-icons-mobile">
				<?php include "./phpModules/checkLoggedIn.php"; ?>
				<span class="linedivide1"></span>
				<a href="manageaccount.php" class="header-wrapicon1 dis-block">
					<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
				</a>

				<span class="linedivide2"></span>

				<div class="header-wrapicon2">
					<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
					<?php include "./phpModules/displayCart.php"; ?>
					<div class="header-cart-buttons">
						<div class="header-cart-wrapbtn">
							<!-- Button -->
							<a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
								Giỏ hàng
							</a>
						</div>

						<div class="header-cart-wrapbtn">
							<!-- Button -->
							<a href="myOrder.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
								Túi của tôi
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</div>
	</div>
	</div>

	<!-- Menu Mobile -->
	<div class="wrap-side-menu">
		<nav class="side-menu">
			<ul class="main-menu">
				<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
					<span class="topbar-child1">
						Đại học Bách Khoa đại học quốc gia thành phố Hồ Chí Minh	
					</span>
				</li>
				<li class="item-menu-mobile">
					<a href="index.php">Trang chủ</a>

				</li>

				<li class="item-menu-mobile">
					<a href="product.php">Cửa hàng</a>
				</li>
				<?php
				session_start();
				if (isset($_SESSION['loggedin']) == false) {
				} else {
					$conn = mysqli_connect("localhost", "root", "root");
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
					if (isset($role) == true) {
						// Ngược lại nếu đã đăng nhập		// Kiểm tra quyền của người đó có phải là admin hay không
						if ($role == '4') {

				?>
							<li class="item-menu-mobile">
								<a>Tính năng</a>
								<ul class="sub-menu">
									<li><a href="vendorOwner.php">Chủ cửa hàng</a></li>
								</ul>
								<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
							</li>
						<?php
						}
						if ($role == '2') {
						?>
							<li class="item-menu-mobile">
								<a>Tính năng</a>
								<ul class="sub-menu">
									<li><a href="cook.php">Đầu bếp</a></li>
								</ul>
								<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
							</li>

						<?php
						}
						if ($role == '1') {
						?>
							<li class="item-menu-mobile">
								<a>Tính năng</a>
								<ul class="sub-menu">
									<li><a href="ITstaff.php">Kỹ thuật viên</a></li>
								</ul>
								<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
							</li>
				<?php
						}
					}
				}
				?>
				<li class="item-menu-mobile">
					<a href="about.php">Thông tin</a>
				</li>

				<li class="item-menu-mobile">
					<a href="contact.php">Liên lạc</a>
				</li>
			</ul>
		</nav>
	</div>
</header>