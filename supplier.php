<?php
  session_start();
  include("includes/permission_supplier.php");
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
 ?>
 <?php
    //session_start();
    include("includes/check-shutdown.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Nhà cung cấp</title>
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
    </div>
    <div class="contentforlayout">
    <br>
    <div class="container">
        <div class="accordion" id="accordionOne">
            <!--manage menu area-->
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Quản lí đơn hàng.
                  </button>
                </h2>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionOne">
                <div class="card-body">
                    <table class="table table-hover table-responsive">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên người mua</th>
                            <th scope="col" style="width: 100px">Hình</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng</th>
                            <th scope="col">Thời gian đặt hàng</th>                      
                            <th scope="col">Trạng thái</th>
                          </tr>
                        </thead>
                        <tbody>
                        	<?php
  								$conn=mysqli_connect("localhost","root","root");
  								if(!$conn){
     								die(mysqli_error($conn));
  								}
  								$result=mysqli_select_db($conn,"smartfood");
  								$conn->set_charset('utf8');
  								//$user_id=$_SESSION['user_id'];
  								$result=mysqli_query($conn,"select orderlist_id, image, user.name as username, food.name as foodname, num, status2, time1, value from orderlist, food, user, bill where orderlist.food_id=food.food_id and orderlist.user_id=user.user_id and orderlist.bill_id=bill.bill_id;");
  								$orders=array();
  								$food = array();
  								$num=array();
  								$count=1;
  								while ($row=mysqli_fetch_array($result)) {
  									if ($row['status2']==1 or $row['status2']==4 or $row['status2']==5){
  										continue;
									  }									  
  								?>
                          <tr>
                          	<td style="display: none;"><?php echo $row['orderlist_id']; ?></td>
                            <th scope="row"><?php echo $count; $count=$count+1; ?></th>
                            <td><?php echo $row['username']; ?></td>
                            <td><img src="<?php echo "images/".$row['image']; ?>" alt="hình 1" class="img-fluid"></td>                            
                            <td><?php echo $row['foodname']; ?></td>
                            <td><?php echo $row['num']; ?></td>
                            <td><?php echo $row['value']; ?></td>
                            
                            <td><?php echo date("H:i",strtotime($row['time1'])); ?></td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?php echo $row['status2'] ?>" id="defaultCheck1">
                              </div></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                </div>
              </div>
            </div>
            <!--manage order area end-->
            <!--manage menu area start-->
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Quản lí thực đơn.
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionOne">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Hình minh họa</th>
                            <th scope="col">Tên món ăn</th>
                            <th scope="col">Giới thiệu</th>
                            <th scope="col">Giá bán</th>
                            <th scope="col">Trạng thái</th>
                          </tr>
                        </thead>
                        <tbody>
                        	<?php
  								$conn=mysqli_connect("localhost","root","root");
  								if(!$conn){
     								die(mysqli_error($conn));
  								}
  								$result=mysqli_select_db($conn,"smartfood");
  								$conn->set_charset('utf8');
  								//$user_id=$_SESSION['user_id'];
  								$result=mysqli_query($conn,"call getFood();");
  								$count=1;
  								while ($row=mysqli_fetch_array($result)) {
  								?>
                          <tr>
                          	<td style="display: none;"><?php echo $row['food_id']; ?></td>
                            <th scope="row"><?php echo $count;?></th>
                            <td><img src="<?php echo "images/".$row['image']; ?>" style="height: 200px; width: 200px;"alt="hình 1" class="img-thumbnail"></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" name="<?php echo "gridRadios".$count;?>" <?php if($row['status']=='1'){echo 'checked="checked"';}?> id="not-sold-out" value="option1" >
                                <label class="form-check-label" for="gridRadios1">
                                  Còn
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="<?php echo "gridRadios".$count; $count=$count+1; ?>" <?php if($row['status']=='0'){echo 'checked="checked"';}?>id="sold-out" value="option2">
                                <label class="form-check-label" for="gridRadios2">
                                    Hết
                                </label>
                              </div></td>
                          </tr>
                      <?php } ?>
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
            <!--manage menu area end-->
          </div>
    </div>

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
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});
	</script>
	<script>
		$('input[type=checkbox]').click(function() {
    if($(this).is(':checked')) {
        var tr=$(this).parent().parent().parent();
        tr=Object.values(tr)[0].cells[0].innerHTML;
        var postData= new FormData();
        postData.append('orderlist_id',tr);
        postData.append('status2',1);
        $.ajax({
                type:'POST',
                url:'setOrder.php',
                processData: false,
                contentType: false,
                data : postData,
                success: function(msg){
                alert(msg);
                },
                error: function(){
                    alert("failure");
                }
            });
    } else {
    	var tr=$(this).parent().parent().parent();
        tr=Object.values(tr)[0].cells[0].innerHTML;
        var postData= new FormData();
        postData.append('orderlist_id',tr);
        postData.append('status2',0);
         $.ajax({
                type:'POST',
                url:'setOrder.php',
                processData: false,
                contentType: false,
                data : postData,
                success: function(msg){
                alert(msg);
                },
                error: function(){
                    alert("failure");
                }
            });
    }
});
		$('input[type=radio]').click(function() {
    if($(this).is(':checked')) {
        var tr=$(this).parent().parent().parent();
        tr=Object.values(tr)[0].cells[0].innerHTML;
        var postData= new FormData();
        
        var t2=$(this);
        t2=Object.values(t2)[0].value;
        postData.append('food_id',tr);
        postData.append('status',t2);
        $.ajax({
                type:'POST',
                url:'setfood.php',
                processData: false,
                contentType: false,
                data : postData,
                success: function(msg){
                alert(msg);
                },
                error: function(){
                    alert("failure");
                }
            });
    } 
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
