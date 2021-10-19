<?php
    session_start();
    $conn=mysqli_connect("localhost","root",'');
    if(!$conn){
        die(mysqli_error($conn));
    }
    $value=$_SESSION['value'];
    $result=mysqli_select_db($conn,"smartfood");
    $conn->set_charset('utf8');
    $result=mysqli_query($conn,"call getUser_id('$value');");
    $check=mysqli_fetch_array($result);
    $user_id=$check['user_id'];
    $result->close();
    $conn->next_result();
    if(mysqli_query($conn,"delete from sessionlogin where user_id=$user_id;")){
        echo "Logout successful.";
    } else{
        echo "ERROR: Cannot Logout. ";
    }
    $_SESSION['loggedin']=false;
    session_destroy();
    header("refresh: 1;url=./product.php");
?>