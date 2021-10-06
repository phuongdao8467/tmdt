<?php include "./phpModules/getUser.php"; ?>
<?php
    //session_start();
    include("includes/check-shutdown.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Product</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
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
	<link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
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
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/heading-pages-02.jpg);">
		<!--
		<h2 class="l-text2 t-center">
			Today's Menu
		</h2>
		<p class="m-text13 t-center">
			Make like you would at home
		</p>
		-->
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">


						<!--  -->
						<h4 class="m-text14 p-b-32">
							Lọc
						</h4>

						<div class="filter-price p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-17">
								Giá
							</div>

							<div class="wra-filter-bar">
								<div id="filter-bar"></div>
							</div>

							<div class="flex-sb-m flex-w p-t-16">
								<div class="w-size11">
									<!-- Button -->
									<button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4 price-filter">
										Lọc
									</button>
								</div>

								<div class="s-text3 p-t-10 p-b-10">
									<span id="value-lower">10.000</span> VNĐ - <span id="value-upper">500.000</span> VNĐ
								</div>
							</div>
						</div>

						<div class="search-product pos-relative bo4 of-hidden">
							<input class="s-text7 size6 p-l-23 p-r-50 search-product-input" type="text" name="search-product" placeholder="Tìm	"...">

							<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4 search-product-button">
								<i class="fs-12 fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">
							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2 sort-product" name="sorting">
									<option value='default'>Lọc theo</option>
									<option value='lowFirst'>Giá: từ nhỏ đến lớn</option>
									<option value='highFirst'>Giá: từ lớn đến nhỏ</option>
								</select>
							</div>
						</div>


					</div>

					<!-- Product -->
					<div class="row product-container">
						<?php
								$conn=mysqli_connect("localhost","root","root");
								if(!$conn){
									die(mysqli_error($conn));
								}
								$result=mysqli_select_db($conn,"smartfood");
								$conn->set_charset('utf8');
            					$result=mysqli_query($conn,"call getfood();");
            					$count=1;
								while ($row=mysqli_fetch_array($result)) {
									if($row['status']==0){
										continue;
								}
								?>
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50 product-block">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<img src="<?php echo "images/".$row['image'];?>" style="height: 200px;"  alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Thêm vào giỏ hàng
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="#" class="block2-name dis-block s-text3 p-b-5">
										<?php echo $row['name'];?>
									</a>

									<span class="block2-price m-text6 p-r-5">
										<?php echo $row['price'];?>
									</span>
									VND
								</div>
							</div>
						
						</div>
	<?php 
						}
							?>
					</div>

					<!-- Pagination -->
					<!--
					<div class="pagination flex-m flex-w p-t-26">
						<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
						<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
					</div>
					-->
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
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
		$('.block2-btn-addcart').click(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			var name = nameProduct.slice(11,-9);
			$(this).on('click', function(){
				var user_id = "<?php echo $user_id ?>";
			var postData = new FormData();
			postData.append('user_id',user_id);
			postData.append('nameProduct',name);
            $.ajax({
                type:'POST',
                url:'add_order.php',
                processData: false,
                contentType: false,
                data : postData,
                success: function(msg){
                	swal(nameProduct, "is added to cart !", "success");
					$('.header-icons-noti').html(parseInt($('.header-icons-noti').html()) + 1);
                },
                error: function(){
                    alert("failure");
                }
            });
			});
			
		});

		$('.block2-btn-addwishlist').click(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});

		$('.price-filter').click(function(){
			let lower = parseInt($('#value-lower').html());
			let upper = parseInt($('#value-upper').html());
			$('.product-block').each(function(){
				let price = parseInt($(this).find('.block2-price').html());
				if(price < lower || price > upper){
					$(this).hide();
				}
				else{
					$(this).show();
				}
			})
		});

		$('.search-product-button').click(function(){
			$('.product-block').each(function(){
				if($(this).find('.block2-name').html().includes($('.search-product-input').val())){
					$(this).show();
				}
				else{
					$(this).hide();
				}
			})
		})

		$('.sort-product').change(function(){
			if($('.sort-product').val() == 'lowFirst'){
				$('.product-container .product-block').sort((a,b)=>{return (parseInt($(b).find('.block2-price').html()) < parseInt($(a).find('.block2-price').html()) ? 1 : -1);}).appendTo('.product-container')
			}
			if($('.sort-product').val() == 'highFirst'){
				$('.product-container .product-block').sort((a,b)=>{return (parseInt($(a).find('.block2-price').html()) < parseInt($(b).find('.block2-price').html()) ? 1 : -1);}).appendTo('.product-container')
			}
			if($('.sort-product').val() == 'default'){
				$('.product-container .product-block').sort((a,b)=>{return ($(b).find('.block2-name').html() < $(a).find('.block2-name').html() ? 1 : -1);}).appendTo('.product-container')
			}

		})
	</script>

<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/noui/nouislider.min.js"></script>
	<script type="text/javascript">
		/*[ No ui ]
	    ===========================================================*/
	    var filterBar = document.getElementById('filter-bar');

	    noUiSlider.create(filterBar, {
	        start: [ 10000, 500000 ],
	        connect: true,
	        range: {
	            'min': 10000,
	            'max': 500000
	        }
	    });

	    var skipValues = [
	    document.getElementById('value-lower'),
	    document.getElementById('value-upper')
	    ];

	    filterBar.noUiSlider.on('update', function( values, handle ) {
	        skipValues[handle].innerHTML = Math.round(values[handle]) ;
	    });
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
