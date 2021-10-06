<?php
    $myemail = 'myemail@myemail.ca';
    if (isset($_POST['name'])) 
    {
        $name = strip_tags($_POST['name']);
        $email = strip_tags($_POST['email']);
        $message = strip_tags($_POST['message']);

        $msg_success = "";
        $msg_fail = "Error sending mail.";
        $msg_success .= "<span class=\"alert alert-success\" >Your message has been received. Thanks! Here is what you submitted:</span><br><br>";
        $msg_success .= "<stong>Name:</strong> ".$name."<br>";   
        $msg_success .= "<stong>Email:</strong> ".$email."<br>"; 
        $msg_success .= "<stong>Message:</strong> ".$message."<br>";

        $to = $myemail;
        $email_subject = "Contact form submission: $name";
        $email_body = "You have received a new message. ".
        " Here are the details:\n Name: $name \n ".
        "Email: $email\n Message \n $message";
        $headers = "From: $myemail\n";
        $headers .= "Reply-To: $email";
        var_dump($_POST);
        echo "<br>";
        var_dump($_FILES);
    }
    else
        var_dump($_FILES);
    echo "OK";
?>