<?php
$orderlist_id=$_POST['orderlist_id'];
$conn = mysqli_connect("localhost", "root", "root");
if (!$conn) {
    die(mysqli_error($conn));
}
//echo "OK!<br>";
$conn->set_charset('utf8');
$result = mysqli_select_db($conn, "smartfood");
$result = mysqli_query($conn, "delete from orderlist where orderlist_id='$orderlist_id'");
$check = mysqli_fetch_array($result);

