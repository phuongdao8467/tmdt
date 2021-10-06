<?php
header('Content-type: text/html; charset=utf-8');


$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa'; //Put your secret key in there

if (!empty($_GET)) {
    $partnerCode = $_GET["partnerCode"];
    $accessKey = $_GET["accessKey"];
    $orderId = $_GET["orderId"];
    $localMessage = $_GET["localMessage"];
    $message = $_GET["message"];
    $transId = $_GET["transId"];
    $orderInfo = $_GET["orderInfo"];
    $amount = $_GET["amount"];
    $errorCode = $_GET["errorCode"];
    $responseTime = $_GET["responseTime"];
    $requestId = $_GET["requestId"];
    $extraData = $_GET["extraData"];
    $payType = $_GET["payType"];
    $orderType = $_GET["orderType"];
    $extraData = $_GET["extraData"];
    $m2signature = $_GET["signature"]; //MoMo signature


    //Checksum
    $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo .
        "&orderType=" . $orderType . "&transId=" . $transId . "&message=" . $message . "&localMessage=" . $localMessage . "&responseTime=" . $responseTime . "&errorCode=" . $errorCode .
        "&payType=" . $payType . "&extraData=" . $extraData;

    $partnerSignature = hash_hmac("sha256", $rawHash, $secretKey);

    echo "<script>console.log('Debug huhu Objects: " . $rawHash . "' );</script>";
    echo "<script>console.log('Debug huhu Objects: " . $partnerSignature . "' );</script>";


    if ($m2signature == $partnerSignature) {
        if ($errorCode == '0') {
            $conn=mysqli_connect("localhost","root","root");
            if(!$conn){
                die(mysqli_error($conn));
            }
                $conn->set_charset('utf8');
                $result=mysqli_select_db($conn,"smartfood");
                $status=2;
                $bill_id=$orderId;
                $result=mysqli_query($conn,"UPDATE orderlist set status2='$status' where bill_id='$bill_id'");
                $check=mysqli_fetch_array($result);
                $result=mysqli_query($conn,"UPDATE bill set status='1' where bill_id='$bill_id'");
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
                header("refresh: 1;url=../myOrder.php");
                
        } else {
            $result = '<div class="alert alert-danger"><strong>Payment status: </strong>' . $message .'/'.$localMessage. '</div>';
        }
    } else {
        $result = '<div class="alert alert-danger">This transaction could be hacked, please check your signature and returned signature</div>';
    }
}

