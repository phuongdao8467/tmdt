<?php
	echo("ok");
	if($_FILES["image-description"]["name"]==""){
		echo "Khong co hinh";
		$conn=mysqli_connect("localhost","root",'');

            if(!$conn){
                die(mysqli_error($conn));
            }
            $food_id=$_POST['eating']['food_id'];
            $name=$_POST['eating']['name'];
            $description=$_POST['eating']['description'];
            $price=$_POST['eating']['price'];
            $conn->set_charset('utf8');
            $result=mysqli_select_db($conn,"smartfood");
            $result=mysqli_query($conn,"select image from food where food_id='$food_id'; ");
            $check=mysqli_fetch_array($result);
            $image=$check['image'];
             $result=mysqli_query($conn,"call modifyFood('$food_id','$name','$image','$description','$price'); ");
             $check=mysqli_fetch_array($result);
             if($check[0]==1){
             	echo "Thành Công!";
             }
            
            
        
	}
	else{
		$filename=$_FILES['file']['name'];

$target_dir    = "images/";
//Vị trí file lưu tạm trong server
$target_file   = $target_dir . basename($_FILES["image-description"]["name"]);
$allowUpload   = true;
//Lấy phần mở rộng của file
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$maxfilesize   = 800000; //(bytes)
////Những loại file được phép upload
$allowtypes    = array('jpg', 'png', 'jpeg', 'gif');


if(isset($_POST['eating']['name'])) {
    //Kiểm tra xem có phải là ảnh
    $check = getimagesize($_FILES["image-description"]["tmp_name"]);
    if($check !== false) {
        $allowUpload = true;
    } else {
        echo "Không phải file ảnh.";
        $allowUpload = false;
    }
}

// Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
if (file_exists($target_file)) {
    echo "File đã tồn tại.";
    $allowUpload = false;
}
// Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
if ($_FILES["image-description"]["size"] > $maxfilesize)
{
    echo "Không được upload ảnh lớn hơn $maxfilesize (bytes).";
    $allowUpload = false;
}


// Kiểm tra kiểu file
if (!in_array($imageFileType,$allowtypes ))
{
    echo "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF";
    $allowUpload = false;
}

// Check if $uploadOk is set to 0 by an error
if ($allowUpload) {
    if (move_uploaded_file($_FILES["image-description"]["tmp_name"], $target_file))
    {
        $conn=mysqli_connect("localhost","root",'');

            if(!$conn){
                die(mysqli_error($conn));
            }
            $image=basename($_FILES["image-description"]["name"]);
            $food_id=$_POST['eating']['food_id'];
            $name=$_POST['eating']['name'];
            $description=$_POST['eating']['description'];
            $price=$_POST['eating']['price'];
            $conn->set_charset('utf8');
            $result=mysqli_select_db($conn,"smartfood");
            $result=mysqli_query($conn,"select image from food where food_id='$food_id'; ");
            $check=mysqli_fetch_array($result);
            $oldimage=$check['image'];
            unlink(($target_dir.$oldimage));
             $result=mysqli_query($conn,"call modifyFood('$food_id','$name','$image','$description','$price'); ");
             $check=mysqli_fetch_array($result);
             if($check[0]==1){
             	echo "Thành Công!";
             }
            
    }
    else
    {
        echo "Có lỗi xảy ra khi upload file.";
    }
}
else
{
    echo "Không upload được file!";
}
	}

?>