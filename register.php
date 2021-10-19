<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
		if(isset($_POST['customer'])){
			$customer=$_POST['customer'];
			$email=$customer['email'];
			$name=$customer['name'];
			$phoneNumber=$customer['phoneNumber'];
			$password = $customer['password'];
			if (strlen($name) <2 || strlen($name)>40) {
				echo "Sai tên";
				return;
			}
			if (strlen($email) == 0) {
				echo "Sai email";
				return;
			}
			if (strlen($password) <2 || strlen($password)>30) {
				echo "Chiều dài mật khẩu không đúng";
				return;
			}
			$email_format = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
			if (!preg_match($email_format,$email)) {
				echo "Sai email";
				return;
			}
			$phone_format = '/^[0-9]{10}$/';
			if (!preg_match($phone_format,$phoneNumber)) {
	    		echo "Số điện thoại không đúng";
	    		return;
	    	}

			$gender=1;
			$role=3;	
			$conn=mysqli_connect("localhost","root",'');

			if(!$conn){
				die(mysqli_error($conn));
			}
			//echo "OK!<br>";
			$conn->set_charset('utf8');
			$result=mysqli_select_db($conn,"smartfood");
			$result=mysqli_query($conn,"call addUser('$name','$email','$password','$phoneNumber','$gender','$role');");
			$check=mysqli_fetch_array($result);
			//echo $check[0];
			if($check[0]==-1){
				echo "Email đã được dùng!";
				header("refresh: 1;url=./register.html");
			}
			else{
				echo "Thành công";
				header("refresh: 1;url=./login.html");
			}
		}
	}

?>
          