<?php
ini_set('xdebug.overload_var_dump', 0);
ini_set('display_errors', 'Off');
$user_id=$_POST['user_id'];
$ctpass=$_POST['ctpass'];
$cupass=$_POST['cupass'];
$conn=mysqli_connect("localhost","root",'');
if(!$conn){
    die(mysqli_error($conn));
}
//echo "OK!<br>";
    $conn->set_charset('utf8');
    $result=mysqli_select_db($conn,"smartfood");
    $result=mysqli_query($conn,"select passhash from user where user_id='$user_id';");
    $check=mysqli_fetch_array($result);
    if($check){
        if($check['passhash']==$cupass){
            $result=mysqli_query($conn,"update user set passhash='$ctpass' where user_id='$user_id';");
            echo "Thành công";
            return;
        }
        else{
            echo "Sai mật khẩu";
            return;
        }
    }
?>