<?php
    //session_start();
    include("includes/permission_it.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Nhân viên IT</title>
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

<!--content start-->
    <!-- Button trigger modal -->
<div class="row">
    <div class="col-sm-6">
    <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#shutdown-button">
        Shutdown
    </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="shutdown-button" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Shut down</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="shutdown.php" accept-charset="UTF-8" id="shutdown-form"><input type="hidden" name="form_type" value="customer_login" /><input type="hidden" name="utf8" value="✓" />
                        <div class="form-group">
                            <label class="control-label" for="date-shutdown">Ngày</label>
                            <input type="text" value="" name="date-shutdown" id="date-shutdown" placeholder="31/01/2000"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="time-shutdown">Giờ</label>
                            <input type="text" value="" name="time-shutdown" id="time-shutdown" placeholder="12:30"  class="form-control">
						</div>
						<div>
							<input type="checkbox" id="shutdown-now" name="shutdown-now" value="true">
  							<label for="shutdown-now">Ngay lập tức</label><br>
						</div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Hủy</button>
                    <div class="submit">					
                        <button name="account" id="shutdown-confirm" type="submit" class="btn btn-primary">
                          <span>
                            <i class="fa fa-stop-circle"></i>
                            Xác nhận
                          </span>
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--button restart-->
    <div class="col-sm-6">
        <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#restart-button">
            Restart
        </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="restart-button" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Restart</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="restart.php" accept-charset="UTF-8" id="restart-form"><input type="hidden" name="form_type" value="customer_login" /><input type="hidden" name="utf8" value="✓" />
                            <div class="form-group">
                                <label class="control-label" for="date-restart">Ngày</label>
                                <input type="text" value="" name="date-restart" id="date-restart" placeholder="31/01/2000"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="time-restart">Giờ</label>
                                <input type="text" value="" name="time-restart" id="time-restart" placeholder="12:30"  class="form-control">
							</div>
							<div>
								<input type="checkbox" id="restart-now" name="restart-now" value="true">
  								<label for="restart-now">Ngay lập tức</label><br>
							</div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Hủy</button>
                        <div class="submit">					
                            <button name="account" id="restart-confirm" type="submit" class="btn btn-primary">
                              <span>
                                <i class="fa fa-play-circle-o"></i>
                                Xác nhận
                              </span>
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
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
	<script src="js/main.js"></script>

</body>
</html>