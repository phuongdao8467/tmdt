<?php
  session_start();
  include("includes/permission_cheff.php");
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
	<title>Nhân viên</title>
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
                            <th scope="col">Liên lạc</th>
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
  								$result=mysqli_query($conn,"select orderlist_id, phonenumber, user.name as username, food.name as foodname, orderlist.num, status2, time1, value from orderlist, food, user, bill where orderlist.food_id=food.food_id and orderlist.user_id=user.user_id and orderlist.bill_id=bill.bill_id;");
  								$orders=array();
  								$food = array();
  								$num=array();
  								$count=1;
  								while ($row=mysqli_fetch_array($result)) {
  									// if ($row['status2']==1 or $row['status2']==4 or $row['status2']==5){
  									// 	continue;
									  // }									  
  								?>
                          <tr>
                          	<td style="display: none;"><?php echo $row['orderlist_id']; ?></td>
                            <th scope="row"><?php echo $count; $count=$count+1; ?></th>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['phonenumber']; ?></td>
                            <td><?php echo $row['foodname']; ?></td>
                            <td><?php echo $row['num']; ?></td>
                            <td><?php echo $row['value']; ?></td>
                            
                            <td><?php echo date("H:i",strtotime($row['time1'])); ?></td>
                            <td>
                              <select class="custom-select form-control" id="selectStatus" name="selectStatus">
                                <option value="1" <?php if ($row['status2']==1) echo 'selected' ?> >Chưa thanh toán</option>
                                <option value="2" <?php if ($row['status2']==3) echo 'selected' ?> >Đang giao</option>
                                <option value="3" <?php if ($row['status2']==5) echo 'selected' ?> >Đã giao</option>
                              </select>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                </div>
              </div>
            </div>
            <!--manage order area end-->
            <!--manage eating area start-->
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Quản lí sản phẩm.
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionOne">
                <div class="card-body">
                    <table class="table table-hover table-responsive" accept-charset="UTF-8">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col" style="width: 100px;">Hình</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giới thiệu</th>
                            <th scope="col">Giá bán</th>
                            <th scope="col">Số lượng</th>
							              <th scope="col"></th>
							              <th scope="col"></th>
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
            					$result=mysqli_query($conn,"call getfood();");
            					$count=1;
								while ($row=mysqli_fetch_array($result)) {
									
								?>
                          <tr>
                            <td scope="row"><?php echo $count; ?></td>
                            <td><img src="<?php echo "images/".$row['image'];?>" alt="<?php echo "Hình ".$count;$count=$count+1;?>" class="img-fluid img-thumbnail"></td>
                            <td style="display:none;"><?php echo $row['food_id'];?></td>
                            <td ><?php echo $row['name'];?></td>
                            <td><?php echo $row['description'];?></td>	
                            <td><?php echo $row['price'];?></td>
                            <td><?php echo $row['num'];?></td>
                              <!--delete mon an-->
                              <td><button type="button" id="deletefood" class="btn btn-secondary">Xóa</button></td>
							  <!--modify button-->
							  <td><button type="button" onclick="modifyEating()" class="btn btn-primary" data-toggle="modal" data-target="#modify-eating">
								Sửa</button>
								<div class="modal fade" id="modify-eating" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="modifyEatingNotice">Chỉnh sửa thông tin sản phẩm</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										<form method="post"  id="modify-eating" accept-charset="UTF-8">
											<div  id="modify-eating-form" >
											    <fieldset id="modify-chosen-eating" class="form-horizontal">
											    	<div class="form-group required" style="display:none;">
												  <label  class="control-label" for="food_id">Id</label>
												  <div class="col-sm-10">
													<input type="text" value="" name="eating[food_id]" id="food_id"  class="form-control"  autofocus>
												  </div>
												</div>
												<div class="form-group required">
												  <label  class="control-label" for="name">Tên sản phẩm</label>
												  <div class="col-sm-10">
													<input type="text" value="" name="eating[name]" id="name" placeholder="Tên món ăn"  class="form-control"  autofocus>
												  </div>
												</div>
											
												<div class="form-group required">
												  <label  class="control-label" for="description">Giới thiệu</label>
												  <div class="col-sm-10">
													<input type="text" value="" name="eating[description]" id="description" placeholder="Giới thiệu"  class="form-control"  autocorrect="off">
												  </div>
												</div>
												<div class="form-group required">
													<label  class="control-label" for="price">Giá bán</label>
													<div class="col-sm-10">
													  <input type="text" value="" name="eating[price]" id="price" placeholder="10000VND"  class="form-control"  autocorrect="off">
													</div>
												</div>
                        <div class="form-group required">
													<label  class="control-label" for="num">Số lượng</label>
													<div class="col-sm-10">
													  <input type="text" value="" name="eating[num]" id="num" placeholder="10"  class="form-control"  autocorrect="off">
													</div>
												</div>
												<div class="form-group required">
													<label for="image-description">Hình minh họa</label>
													<input type="file" class="form-control-file" id="image-description" name="image-description">
												</div>
												</fieldset>  
											</div>
										                               
									  </div>
									<div class="modal-footer">
										<div>					
											<button name="save-modify" id="button-modify-eating1" class="btn btn-primary">
											  <span>
												<i class="fa fa-hacker-news left"></i>
												Lưu
											  </span>
											</button>
											 &nbsp;
											hoặc <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
										</div>
									</div>
								</form> 
									</div>
								  </div>
								</div></td>
                          </tr>
                          <?php
						}
						?>
                        </tbody>
					</table>
					<script>
						function modifyEating() {
					  // event.target will be the input element.
						var td = event.target.parentNode; 
						  var tr = td.parentNode; // the row to be removed
						  var food_id=tr.cells[2].innerHTML;
						  var name=tr.cells[3].innerHTML;
						  var description=tr.cells[4].innerHTML;
						  var price=tr.cells[5].innerHTML;
              var num=tr.cells[6].innerHTML;
						  var x= document.getElementById("modify-eating");
						  x.style.display="block";
						var name2=document.getElementsByName("eating[name]")[0];
						var food_id2=document.getElementsByName("eating[food_id]")[0];
						var description2=document.getElementsByName("eating[description]")[0];
						var price2=document.getElementsByName("eating[price]")[0];
            var num2=document.getElementsByName("eating[num]")[0];
						name2.value=name;
						food_id2.value=food_id;
						description2.value=description;
						price2.value=price;
            num2.value=num;
					}
					</script>
                      <!-- Button add eating modal -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                        Thêm sản phẩm mới.
                      </button>
  					
  					          <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Thông tin sản phẩm</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                
                                    
                                    	<div class="modal-body">
                                    		<form method="post" id="add-new-eating" class="contact" accept-charset="UTF-8">
                                    	<input type="hidden" name="form_type" value="add-new-eating" /><input type="hidden" name="utf8" value="✓" />
                                        <div  id="add-new-eating-form" >
                                            <div class="form-group required">
                                              <label  class="control-label" for="name">Tên sản phẩm</label>
                                              <div class="col-sm-10">
                                                <input type="text" value="" name="eating[name]" id="name" placeholder="Tên sản phẩm"  class="form-control"  autofocus>
                                              </div>
                                            </div>
                                        
                                            <div class="form-group required">
                                              <label  class="control-label" for="description">Giới thiệu</label>
                                              <div class="col-sm-10">
                                                <input type="text" value="" name="eating[description]" id="description" placeholder="Giới thiệu"  class="form-control"  autocorrect="off" autocapitalize="off">
                                              </div>
                                            </div>
                                            <div class="form-group required">
                                                <label  class="control-label" for="price">Giá bán</label>
                                                <div class="col-sm-10">
                                                  <input type="text" value="" name="eating[price]" id="price" placeholder="10.000VND"  class="form-control"  autocorrect="off" autocapitalize="off">
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                              <label  class="control-label" for="num">Số lượng</label>
                                              <div class="col-sm-10">
                                                <input type="text" value="" name="eating[num]" id="num" placeholder="10"  class="form-control"  autocorrect="off">
                                              </div>
                                            </div>
                                            <div class="form-group required">
                                                <label for="image-description">Hình minh họa</label>
                                                <input type="file" name="fileToUpload" id="fileToUpload">
                                            </div>
										</div>
										</form>  
										</div>
									                              
                                
                                <div class="modal-footer">
                                    <div class="submit">					
                                        <button class="btn btn-success" id="submit1"><i class="glyphicon glyphicon-inbox"></i> Thêm</button>
                                         &nbsp;
                                        hoặc <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<!--end of modal-->
					
                </div>
              </div>
            </div>
            <!--manage eating area end-->
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
    $('#selectStatus').change(function(){
      var tr=$(this).parent().parent();
      tr=Object.values(tr)[0].cells[0].innerHTML;
      var status = document.getElementById('selectStatus');
      var postData= new FormData();
      postData.append('orderlist_id',tr);
      postData.append('status2',status.value);
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
      
    });
    $("button#deletefood").click(function(){
    	var td = event.target.parentNode; 
      		var tr = td.parentNode; // the row to be removed
      		var name=tr.cells[3].innerHTML;
         var postData = new FormData();
         postData.append("name",name);
            $.ajax({
                type:'POST',
                url:'deletefood.php',
                processData: false,
                contentType: false,
                data : postData,
                success: function(msg){
					alert('Thành công');
                location.reload();
                },
                error: function(){
                    alert("failure");
                }
            });
    });
    $("button#submit1").click(function(){
         var postData = new FormData($("form#add-new-eating")[0]);
            $.ajax({
                type:'POST',
                url:'add_menu.php',
                processData: false,
                contentType: false,
                data : postData,
                success: function(msg){
                alert(msg);
                $("#staticBackdrop").modal('hide');
                location.reload();
                },
                error: function(){
                    alert("failure");
                }
            });
    });
    $("button#button-modify-eating1").click(function(){
        var postData = new FormData($("form#modify-eating")[0]);
            $.ajax({
                type:'POST',
                url:'modifyfood.php',
                processData: false,
                contentType: false,
                data : postData,
                success: function(msg){
					      alert(msg);
                // $("#thanks").html(msg);
                $("#modify-eating").modal('hide');
                location.reload();
                },
                error: function(){
                    alert("failure");
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
