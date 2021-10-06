<?php
    $conn=mysqli_connect("localhost","root","root");
	if(!$conn){
		die(mysqli_error($conn));
	}
		$conn->set_charset('utf8');
        $result=mysqli_select_db($conn,"smartfood");
        $status=3;
        $bill_id=$_POST['orderId'];
		$result=mysqli_query($conn,"UPDATE orderlist set status2='$status' where bill_id='$bill_id'");
        $check=mysqli_fetch_array($result);
        //get user_id
        $result=mysqli_query($conn,"select user_id from orderlist where bill_id='$bill_id'");
        $check=mysqli_fetch_array($result);
        $user_id=$check[0];
        //get coupon_id
        $result=mysqli_query($conn,"select coupon_id from bill where bill_id='$bill_id'");
        $check=mysqli_fetch_array($result);
        $counpon_id=$check[0];
        //get num coupon_user
        $result=mysqli_query($conn,"select num from usercoupon where user_id='$user_id'and coupon_id='$counpon_id';");
        $check=mysqli_fetch_array($result);
        $num=intval($check[0]);
        //decrease or delete usercoupon
        if($num<=1){
            $result=mysqli_query($conn,"delete from usercoupon where user_id='$user_id'and coupon_id='$counpon_id';");
        }
        else{
            $result=mysqli_query($conn,"Update usercoupon set num=num-1 where user_id='$user_id'and coupon_id='$counpon_id';");
        }
        header("refresh: 1;url=./myOrder.php");
