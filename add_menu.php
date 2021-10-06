<?php
// 	session_start();
// 	var_dump($_SESSION);
	
// 	$target_dir = "uploads/";
// 	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// 	$uploadOk = 1;
// 	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// // Check if image file is a actual image or fake image
// 	if(isset($_POST["submit"])) {
//   		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   	if($check !== false) {
//     	echo "File is an image - " . $check["mime"] . ".";
//     	$uploadOk = 1;
//   	} else {
//     	echo "File is not an image.";
//     	$uploadOk = 0;
//   	}
// 	}
$filename=$_FILES['file']['name'];

$target_dir    = "images/";
//Vị trí file lưu tạm trong server
$target_file   = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$allowUpload   = true;
//Lấy phần mở rộng của file
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$maxfilesize   = 800000; //(bytes)
////Những loại file được phép upload
$allowtypes    = array('jpg', 'png', 'jpeg', 'gif');


if(isset($_POST['eating']['name'])) {
    //Kiểm tra xem có phải là ảnh
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
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
if ($_FILES["fileToUpload"]["size"] > $maxfilesize)
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
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
    {
        $conn=mysqli_connect("localhost","root","root");

            if(!$conn){
                die(mysqli_error($conn));
            }
            $image=basename($_FILES["fileToUpload"]["name"]);
            $name=$_POST['eating']['name'];
            $description=$_POST['eating']['description'];
            $price=$_POST['eating']['price'];
            $conn->set_charset('utf8');
            $result=mysqli_select_db($conn,"smartfood");

            $result=mysqli_query($conn,"call addfood('$image','$name','$description','$price')");
            $check=mysqli_fetch_array($result);
            if(!is_null($check)){
                if($check[0]==-1){
                    echo "Món ăn đã tồn tại!";
                    unlink(($target_dir.$image));
                }
                else{
                    echo "Thành công!";
                }
            }
            else{
                echo "Lỗi gọi hàm";
                unlink(($target_dir.$image));
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
?>