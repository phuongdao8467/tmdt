
<?php 
  session_start();
  include("includes/permission_admin.php");
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
	$result=mysqli_query($conn,"call getRole'$user_id');");
	$check=mysqli_fetch_array($result);
	$role=$check['role1'];
?>
<?php
    //session_start();
    include("includes/check-shutdown.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vendor Owner</title>
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
            <!--manage eating area start-->
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Quản lí món ăn.
                  </button>
                </h2>
              </div>
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionOne">
                <div class="card-body">
                    <table class="table table-hover" accept-charset="UTF-8">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Hình minh họa</th>
                            <th scope="col">Tên món ăn</th>
                            <th scope="col">Giới thiệu</th>
                            <th scope="col">Giá bán</th>
                            <th scope="col">Trạng thái</th>
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
                            <td><img src="<?php echo "images/".$row['image'];?>" style="height: 100px;width: 150px; "alt="<?php echo "Hình ".$count;$count=$count+1;?>" class="img-thumbnail"></td>
                            <td style="display:none;"><?php echo $row['food_id'];?></td>
                            <td ><?php echo $row['name'];?></td>
                            <td><?php echo $row['description'];?></td>	
                            <td><?php echo $row['price'];?></td>
                            <td><?php if($row['status']==1){echo "Còn";}else{echo "Hết";} ?></td>
                              <!--delete mon an-->
                              <td><button type="button" id="deletefood" class="btn btn-secondary">Xóa</button></td>
							  <!--modify button-->
							  <td><button type="button" onclick="modifyEating()" class="btn btn-primary" data-toggle="modal" data-target="#modify-eating">
								Sửa</button>
								<div class="modal fade" id="modify-eating" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="modifyEatingNotice">Chỉnh sửa thông tin món ăn</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										<form method="post"  id="modify-eating" accept-charset="UTF-8">
											<div  id="modify-eating-form" >
											    <fieldset id="modify-chosen-eating" class="form-horizontal">
											    	<div class="form-group required" style="display:none;">
												  <label  class="control-label" for="food_id">Food_id</label>
												  <div class="col-sm-10">
													<input type="text" value="" name="eating[food_id]" id="food_id"  class="form-control"  autofocus>
												  </div>
												</div>
												<div class="form-group required">
												  <label  class="control-label" for="name">Tên món ăn</label>
												  <div class="col-sm-10">
													<input type="text" value="" name="eating[name]" id="name" placeholder="Tên món ăn"  class="form-control"  autofocus>
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
						  var x= document.getElementById("modify-eating");
						  x.style.display="block";
						var name2=document.getElementsByName("eating[name]")[0];
						var food_id2=document.getElementsByName("eating[food_id]")[0];
						var description2=document.getElementsByName("eating[description]")[0];
						var price2=document.getElementsByName("eating[price]")[0];
						name2.value=name;
						food_id2.value=food_id;
						description2.value=description;
						price2.value=price;

					}
					</script>
                      <!-- Button add eating modal -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                        Thêm món mới.
                      </button>
  					
  					<!-- Modal -->
<!--                     <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    					<div class="modal-dialog">
        					<div class="modal-content">
            				<div class="modal-header">
               				 <h5 class="modal-title" id="staticBackdropLabel">Thông tin món ăn</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
            				</div>
            				<form method="post" id="add-new-eating" class="contact" accept-charset="UTF-8">
               				 	<div class="modal-body">
                    				<div class="form-group required">
                                              <label  class="control-label" for="name">Tên món ăn</label>
                                              <div class="col-sm-10">
                                                <input type="text" value="" name="eating[name]" id="name" placeholder="Tên món ăn"  class="form-control"  autofocus>
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
                    				<div class="form-group">
                        			<label for="image-description">Hình minh họa</label>
                        			<div class="col-lg-10">
                            			<input type="file" name="fileToUpload" id="fileToUpload">
                        			</div>
                    				</div>
                					</div>
            				</form> 
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
                <button class="btn btn-success" id="submit1"><i class="glyphicon glyphicon-inbox"></i> Submit</button>
            </div>
        </div>
    </div>
</div>
           -->          <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Thông tin món ăn</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                
                                    
                                    	<div class="modal-body">
                                    		<form method="post" id="add-new-eating" class="contact" accept-charset="UTF-8">
                                    	<input type="hidden" name="form_type" value="add-new-eating" /><input type="hidden" name="utf8" value="✓" />
                                        <div  id="add-new-eating-form" >
                                            <div class="form-group required">
                                              <label  class="control-label" for="name">Tên món ăn</label>
                                              <div class="col-sm-10">
                                                <input type="text" value="" name="eating[name]" id="name" placeholder="Tên món ăn"  class="form-control"  autofocus>
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
            <!--manage employee area start-->
            <div class="card">
                <div class="card-header" id="headingTwo">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Quản lí nhân viên.
                    </button>
                  </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionOne">
                  <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Họ và tên</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Email</th>
                            <th scope="col">Chức vụ</th>
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
            					$result=mysqli_query($conn,"select * from user where role1=1 or role1=2;");
            					$count=1;
								while ($row=mysqli_fetch_array($result)) {
								?>
                          <tr>
                            <td scope="row" style="display :none;"><?php echo $row['user_id']; ?></td>
                            <td scope="row"><?php echo $count; $count+=1; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['phonenumber']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php if($row['role1']==1){echo "IT";}else{echo "Đầu bếp";}?></td>
                            <!--delete info employee-->
                            <td><button type="button" id="deleteemployee" class="btn btn-secondary">Xóa</button></td>
                                <div class="modal fade" id="delete-employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="deleteNotice">Bạn muốn xóa thông tin nhân viên không?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-footer">
										  <form method="POST" action="delete-employee-info" id="button-delete-employee">
											<button type="submit" class="btn btn-secondary">Xóa</button>
										  </form>
                                          <div class="clearfix">
                                              <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                </div></td>
                          </tr>
                          <?php
                      	}
                      ?>
                        </tbody>
                    </table>
                    <!--add new info employee-->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdropThree">
                        Thêm nhân viên.
                    </button>                     
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdropThree" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelThree" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabelThree">Thông tin nhân viên</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post"  id="add-new-employee" accept-charset="UTF-8"><input type="hidden" name="form_type" value="add-new-employee" /><input type="hidden" name="utf8" value="✓" />
                                    <div  id="add-new-employee-form" >
                                        <fieldset id="new-employee" class="form-horizontal">
                                            <div class="form-group required">
                                            <label  class="control-label" for="employee[name]">Họ và tên</label>
                                                <div class="col-sm-10">
                                                    <input type="text" value="" name="employee[name]" id="employee[name]" placeholder="Nguyễn Văn A"  class="form-control"  autofocus>
                                                </div>
                                            </div>
                                                            
                                            <div class="form-group required">
                                            <label  class="control-label" for="employee[phone-number]">Số điện thoại</label>
                                                <div class="col-sm-10">
                                                    <input type="text" value="" name="employee[phone-number]" id="employee[phone-number]" placeholder="0123456789"  class="form-control"  autocorrect="off" autocapitalize="off">
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                            <label  class="control-label" for="employee[email]">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" value="" name="employee[email]" id="employee[email]" placeholder="a.nguyenvan@gmail.com"  class="form-control"  autocorrect="off" autocapitalize="off">
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                            <label  class="control-label" for="employee[password]">Mật khẩu</label>
                                                <div class="col-sm-10">
                                                    <input type="password" value="" name="employee[password]" id="employee[password]" placeholder="password"  class="form-control"  autocorrect="off" autocapitalize="off">
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                
                                                <div class="row">
                                                    <label class="col-md-4">Chức vụ</label>
                                                    <div class="col-md-4 ml-auto">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="role" id="cooker1" value="cheff" checked>
                                                        <label class="form-check-label" for="cooker1">
                                                            Đầu bếp
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="role" id="ITer1" value="IT">
                                                        <label class="form-check-label" for="ITer1">
                                                            Nhân viên IT
                                                        </label>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>                                  
                                    </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <div class="submit">					
                                        <button name="account" id="button-account" type="submit" class="btn btn-primary">
                                        <span>
                                            <i class="fa fa-hacker-news left"></i>
                                                Thêm mới
                                        </span>
                                        </button>
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
            <!--manage employee area end-->
            <!--report area start-->
            <div class="card">
                <div class="card-header" id="headingThree">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Báo cáo.
                    </button>
                  </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionOne">
                    <div class="card-body">
                      <table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope= "col">#</th>
                              <th scope= "col">Ngày</th>
                              <th scope= "col">Tổng số đơn</th>
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
            					$result=mysqli_query($conn,"select date(time1) as date,count(num) as num from orderlist group by 1");
            					$stt=0;
								while ($row=mysqli_fetch_array($result)) {
									$stt++;
									if($row['status2']==1){
										continue;
									}
                          	 ?>
                            <tr>
                              <th scope="row"><?php echo $stt; ?></th>
                              <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#<?php echo $row['date']; ?>">
								  <?php echo $row['date']; ?>
								</button>
                                <div class="modal fade" id="<?php echo $row['date']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="reportNotice">Báo cáo.</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
										<table class="table table-hover">
											<thead>
											  <tr>
												<th scope="col">#</th>
												<th scope="col">Tên món ăn</th>
												<th scope="col">Số lượng</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$conn2=mysqli_connect("localhost","root","root");
													if(!$conn2){
														die(mysqli_error($conn));
													}
													$foods=mysqli_select_db($conn2,"smartfood");
													$conn2->set_charset('utf8');
													$date = $row['date'];
													$foods=mysqli_query($conn2,"select food_id, name, sum(num) as num from (select date(orderlist.time1) as date, orderlist.food_id,orderlist.num, food.name  from orderlist left join food on orderlist.food_id= food.food_id where date(orderlist.time1)='$date') as info group by food_id;");
													$foodStt = 0;
													while ($foodRow=mysqli_fetch_array($foods)) {
														$foodStt++;
														if($foodRow['status2']==1){
															continue;
														}
												 	?>
												  <tr>
													  <th scope="row"><?php echo $foodStt; ?></th>
	                              					  <td><?php echo $foodRow['name']; ?></td>
	                              					  <td><?php echo $foodRow['num']; ?></td>
												  </tr>
												  <?php 
													};
											   	?>
											</tbody>
										</table>
									  </div>
                                    </div>
                                  </div>
								</div></td>
								<td>
									<?php echo $row['num']; ?>
								</td>
                            </tr>
                        <?php } ?>
                          </tbody>
                      </table>
                    </div>
                  </div>

            </div>
            <!--report area end-->
            <!--coupon area start-->
            <div class="card">
                <div class="card-header" id="headingFour">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      Coupon.
                    </button>
                  </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionOne">
                    <div class="card-body">
                    	<h5>Tặng coupon</h5>
                    	<table class="table table-hover">
                    		<thead>
                    		  <tr>
                              <th scope="col">Coupon ID</th>
							  <th scope="col">Tên khách hàng</th>
							  <th scope="col">Số lượng</th>
                              </tr>
                    		</thead>
                    		<tbody>
                    			<tr>
                    				<td><input type="text" style="border: 1px solid #ccc !important;" id="gift_coupon_id"></td>
									<td><input type="text" style="border: 1px solid #ccc !important;" id="gift_name"></td>
									<td><input type="text" style="border: 1px solid #ccc !important;" id="gift_num"></td>
                    				<td><button id="button-gift-coupon" type="button" class="btn btn-primary">Tặng</button></td>
                    			</tr>
                    		</tbody>
                    	</table>
                    	<h5>Danh sách coupon</h5>
                      <table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">ID</th>
                              <th scope="col">Giá trị</th>
                              <th scope="col">Ngày bắt đầu</th>
							  <th scope="col">Ngày kết thúc</th>
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
            					$result=mysqli_query($conn,"select * from coupon");
            					$stt=0;
								while ($row=mysqli_fetch_array($result)) {
									$stt++;
									if($row['status2']==1){
										continue;
									}
								?>
                            <tr>
                              <th scope="row"><?php echo $stt; ?></th>
                              
                              <!--delete coupon--><td><?php echo $row['coupon_id']; ?></td>
                              <td><?php echo $row['value']; ?></td>
                              <td><?php echo $row['start1']; ?></td>
                              <td><?php echo $row['end1']; ?></td>
                              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete-coupon" id="button-delete-coupon">Xóa</button>
                                <div class="modal fade" id="delete-coupon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="deleteNotice">Bạn muốn xóa coupon không?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-footer">
										  <form method="POST" action="delete-coupon.php">
											<button type="submit" class="btn btn-secondary">Xóa</button>
										  </form>
                                          <div class="clearfix">
                                              <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
								</div></td>
								<!--modify button-->
								<td><button type="button" onclick="modifyCoupon()" class="btn btn-primary" data-toggle="modal" data-target="#modify-coupon">Sửa</button>
									<div class="modal fade" id="modify-coupon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
										<div class="modal-content">
										  <div class="modal-header">
											<h5 class="modal-title" id="modifyCouponNotice">Chỉnh sửa thông tin coupon</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											  <span aria-hidden="true">&times;</span>
											</button>
										  </div>
										  <div class="modal-body">
											<form method="post" action="#" id="modify-coupon" accept-charset="UTF-8"><input type="hidden" name="form_type" value="modify-coupon" /><input type="hidden" name="utf8" value="✓" />
                                                <div  id="modify-coupon-form" >
                                                    <fieldset id="modify-chosen-coupon" class="form-horizontal">
                                                        <div class="form-group required">
                                                            <label  class="control-label" for="ID">ID</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" value="" name="coupon[ID]" id="ID" placeholder="QTTN-0106"  class="form-control"  autofocus>
                                                                </div>
                                                        </div>                                        
                                                        <div class="form-group required">
                                                            <label  class="control-label" for="value-coupon">Giá trị</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" value="" name="coupon[value-coupon]" id="value-coupon" placeholder="10.000VND"  class="form-control"  autocorrect="off" autocapitalize="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group required">
                                                            <label  class="control-label" for="date-start">Ngày bắt đầu</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" value="" name="coupon[date-start]" id="date-start" placeholder="31/01/2000"  class="form-control"  autocorrect="off" autocapitalize="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group required">
                                                            <label  class="control-label" for="date-end">Ngày kết thúc</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" value="" name="coupon[date-end]" id="date-end" placeholder="31/01/2000"  class="form-control"  autocorrect="off" autocapitalize="off">
                                                            </div>                                                            
                                                        </div>
                                                    </fieldset>                                  
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="submit">					
                                                        <button name="save-coupon" id="button-save-coupon" type="submit" class="btn btn-primary">
                                                        <span>
                                                            <i class="fa fa-hacker-news left"></i>
                                                                Lưu
                                                        </span>
                                                        </button>
                                                        &nbsp;
                                                        hoặc&nbsp;<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                    </div>
												</div>
											</form>
										  </div>										  
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
						function modifyCoupon() {
					  // event.target will be the input element.
						var td = event.target.parentNode; 
						  var tr = td.parentNode; // the row to be removed
						  var id=tr.cells[1].innerHTML;
						  var price=tr.cells[2].innerHTML;
						  var dateStart=tr.cells[3].innerHTML;
						  var dateEnd=tr.cells[4].innerHTML;
						  var x= document.getElementById("modify-coupon");
						  x.style.display="block";
						var id2=document.getElementsByName("coupon[ID]")[0];
						
						var price2=document.getElementsByName("coupon[value-coupon]")[0];
						var dateStart2=document.getElementsByName("coupon[date-start]")[0];
						var dateEnd2=document.getElementsByName("coupon[date-end]")[0];
						id2.value=id;
						price2.value=price;
						dateStart2.value=dateStart;
						dateEnd2.value=dateEnd;
					}
					</script>
                          <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdropTwo">
                                Thêm coupon mới.
                            </button>
  
                        <!-- Modal -->
                            <div class="modal fade" id="staticBackdropTwo" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Thông tin coupon</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="add-coupon.php" id="add-new-coupon" accept-charset="UTF-8"><input type="hidden" name="form_type" value="add-new-coupon" /><input type="hidden" name="utf8" value="✓" />
                                                <div  id="add-new-coupon-form" >
                                                    <fieldset id="new-coupon" class="form-horizontal">
                                                        <div class="form-group required">
                                                            <label  class="control-label" for="ID">ID</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" value="" name="coupon[ID]" id="ID" placeholder="ID"  class="form-control"  autofocus>
                                                                </div>
                                                        </div>                                        
                                                        <div class="form-group required">
                                                            <label  class="control-label" for="value-coupon">Giá trị</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" value="" name="coupon[value-coupon]" id="value-coupon" placeholder="10.000VND"  class="form-control"  autocorrect="off" autocapitalize="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group required">
                                                            <label  class="control-label" for="date-start">Ngày bắt đầu</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" value="" name="coupon[date-start]" id="date-start" placeholder="YYYY-MM-DD"  class="form-control"  autocorrect="off" autocapitalize="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group required">
                                                            <label  class="control-label" for="date-end">Ngày kết thúc</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" value="" name="coupon[date-end]" id="date-end" placeholder="YYYY-MM-DD"  class="form-control"  autocorrect="off" autocapitalize="off">
                                                            </div>                                                            
                                                        </div>
                                                    </fieldset>                                  
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="submit">					
                                                        <button name="coupon" id="button-coupon" type="submit" class="btn btn-primary">
                                                        <span>
                                                            <i class="fa fa-hacker-news left"></i>
                                                                Thêm mới
                                                        </span>
                                                        </button>
                                                        &nbsp;
                                                        hoặc&nbsp;<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                    </div>
												</div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                    </div>
                </div>
            </div>
            
            <!--coupon area end-->
        </div>
    </div>

	<!-- Footer -->
	<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
		<div class="flex-w p-b-90">
			<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					GET IN TOUCH
				</h4>

				<div>
					<p class="s-text7 w-size27">
						Any questions? Let us know in store at 268 Ly Thuong Kiet, Ward 14, District 10, Ho Chi Minh 
					</p>
					<!--
					<div class="flex-m p-t-30">
						<a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
					</div>
					-->
				</div>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Categories
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Food
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Drink 
					</li>
					<!-- <li class="p-b-9">
						<div id="thanks"> aaddd</div>

					</li> -->
					
				</ul>
			</div>
			<div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					Newsletter
				</h4>

				<form>
					<div class="effect1 w-size9">
						<input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
						<span class="effect1-line"></span>
					</div>

					<div class="w-size2 p-t-20">
			
						<!-- Button -->
						<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
							Subscribe
						</button>
					</div>

				</form>
			</div>

		</div>

		<div class="t-center p-l-15 p-r-15">
			<a href="#">
				<img class="h-size2" src="images/icons/paypal.png" alt="IMG-PAYPAL">
			</a>

			<a href="#">
				<img class="h-size2" src="images/icons/visa.png" alt="IMG-VISA">
			</a>

			<a href="#">
				<img class="h-size2" src="images/icons/mastercard.png" alt="IMG-MASTERCARD">
			</a>

			<a href="#">
				<img class="h-size2" src="images/icons/express.png" alt="IMG-EXPRESS">
			</a>

			<a href="#">
				<img class="h-size2" src="images/icons/discover.png" alt="IMG-DISCOVER">
			</a>

		</div>
	</footer>



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
	<!-- <script>
		function addFood() {
			var postData = new FormData($('form#add-new-eating')[0]);	
			alert(JSON.stringify(postData));
			$.ajax({
                type: "POST",
                url: "add_menu.php",
                data: postData,
                success: function(msg){
                    $("#staticBackdrop").modal('hide');
                    $("#thanks").html(msg);
                    alert(msg);
                },
                error: function(){
                    alert("failure");
                }
       });
	}
	</script> -->
	<script>
 $(function() {
    //twitter bootstrap script
    $("button#submit1").click(function(){
         var postData = new FormData($("form#add-new-eating")[0]);
            $.ajax({
                type:'POST',
                url:'add_menu.php',
                processData: false,
                contentType: false,
                data : postData,
                success: function(msg){
                alert('Thành công');
                $("#staticBackdrop").modal('hide');
                location.reload();
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
    
    $("button#button-modify-eating1").click(function(){
        var postData = new FormData($("form#modify-eating")[0]);
            $.ajax({
                type:'POST',
                url:'modifyfood.php',
                processData: false,
                contentType: false,
                data : postData,
                success: function(msg){
					alert('Thành công');
                $("#thanks").html(msg);
                $("#modify-eating").modal('hide');
                location.reload();
                },
                error: function(){
                    alert("failure");
                }
            });
    });
    $("button#deleteemployee").click(function(){
    	var td = event.target.parentNode; 
      		var tr = td.parentNode; // the row to be removed
      		var id=tr.cells[0].innerHTML;
         var postData = new FormData();
         postData.append("food_id",id);
            $.ajax({
                type:'POST',
                url:'deleteemployee.php',
                processData: false,
                contentType: false,
                data : postData,
                success: function(msg){
                location.reload();
				alert('Thành công');
                },
                error: function(){
                    alert("failure");
                }
            });
    });
    $("button#button-account").click(function(){
         var postData = new FormData($("form#add-new-employee")[0]);
            $.ajax({
                type:'POST',
                url:'add_account.php',
                processData: false,
                contentType: false,
                data : postData,
                success: function(msg){
					alert('Thành công');
                $("#staticBackdropThree").modal('hide');
                location.reload();
                },
                error: function(){
                    alert("failure");
                }
            });
    });
    $("button#button-coupon").click( () => {
    	var postData = new FormData($("form#add-new-coupon")[0]);
    		$.ajax({
    			type:'POST',
    			url:'add-coupon.php',
    			processData: false,
                contentType: false,
                data : postData,
                success: function(msg){
                location.reload();
                alert("thanh cong");
                },
                error: function(){
                    alert("failure");
                }
    		});
    });
    $("button#button-save-coupon").click( () => {
        	var postData = new FormData($("form#modify-coupon")[0]);
    		$.ajax({
    			type:'POST',
    			url:'modify-coupon.php',
    			processData: false,
                contentType: false,
                data : postData,
                success: function(msg){
                location.reload();
                alert('Thành công');
                },
                error: function(){
                    alert("failure");
                }
    		});
    });
    $("button#button-delete-coupon").click(() => {
    	var td = event.target.parentNode; 
      	var tr = td.parentNode; // the row to be removed
      	var id = tr.cells[1].innerHTML;
        var postData = new FormData();
         postData.append("coupon_id",id);
            $.ajax({
                type:'POST',
                url:'delete-coupon.php',
                processData: false,
                contentType: false,
                data : postData,
                success: function(msg){
                location.reload();
                alert('Thành công');
                },
                error: function(){
                    alert("failure");
                }
            });
    });
    $("#button-gift-coupon").click(() => {
		var name  = $("#gift_name").val();
		var coupon_id = $("#gift_coupon_id").val();
		var num = $("#gift_num").val();
		var postData = new FormData();
		postData.append("name", name);
		postData.append("coupon", coupon_id);
		postData.append("num", num);
		$.ajax({
			type: 'POST',
			url: 'gift-coupon.php',
			processData: false,
			contentType: false,
			data: postData,
			success: (msg) => {
				location.reload();
				alert(msg);
			},
			error: (error) => {
				alert("Failure");
			}

		});

    });


});
</script>





<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
