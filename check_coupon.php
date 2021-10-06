<?php
    $user_id=$_POST['user_id'];
    $coupon_id=$_POST['coupon_id'];
    $conn=mysqli_connect("localhost","root","root");
    if(!$conn){
        die(mysqli_error($conn));
    }
    $result=mysqli_select_db($conn,"smartfood");
    $result=mysqli_query($conn,"select usercoupon.coupon_id,num,end1,value from usercoupon,coupon where usercoupon.coupon_id=coupon.coupon_id and user_id='$user_id' and usercoupon.coupon_id='$coupon_id';
    ");
    $row=mysqli_fetch_array($result);
    if($row['value']==NULL){
        $result1['discount']=0;
	    echo json_encode($result1); 
    }
    else{
        $result1['discount']=$row['value'];
	    echo json_encode($result1); 
    }
?>