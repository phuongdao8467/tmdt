<?php
	$user_id=$_POST['user_id'];
	$coupon_id=$_POST['coupon_id'];
	$order_id=$_POST['order_id'];
	$order_id=array_map('intval',explode(' ,', $order_id));
	$conn=mysqli_connect("localhost","root","root");
	if(!$conn){
		die(mysqli_error($conn));
	}
	//create bill_id
	$value=0;
	$bill_id=time()."";
	$conn->set_charset('utf8');
	$result=mysqli_select_db($conn,"smartfood");
	//Is coupon availble for user_id
	$result=mysqli_query($conn,"SELECT id FROM usercoupon where user_id='$user_id' and coupon_id='$coupon_id';");
	$check=mysqli_fetch_array($result);
	if($check!=NULL){
		$usercoupon_id=$check[0];
		$result=mysqli_query($conn,"SELECT value FROM coupon where coupon_id='$coupon_id';");
		$check=mysqli_fetch_array($result);
		$discount=$check[0];
	}
	else{
		$discount=0;
		$coupon_id=NULL;
	}
	foreach($order_id as $item){
		//get num and food_id
		$result=mysqli_query($conn,"SELECT food_id, num FROM orderlist where orderlist_id='$item ';");
		$row=mysqli_fetch_array($result);
		$num=$row['num'];
		$food_id=$row['food_id'];
		//get food price
		$result=mysqli_query($conn,"SELECT price FROM food where food_id='$food_id';");
		$row=mysqli_fetch_array($result);
		$price=$row['price'];
		$value+=$num*$price;
		//update bill info
		$result=mysqli_query($conn,"UPDATE orderlist set bill_id='$bill_id' where orderlist_id='$item';");
	}
	$value=$value-$discount;
	if($value<0) $value=0;
	$status=0;
	$result=mysqli_query($conn,"INSERT INTO bill (bill_id,coupon_id,value,status) values ('$bill_id','$coupon_id','$value','$status')");
	$result1['bill_id']=$bill_id;
	$result1['amount']=$value;
	echo json_encode($result1); 
?>