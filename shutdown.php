<?php 
	//ob_start();
    $url = "ITstaff.php";
    $shutdown_now= $_POST['shutdown-now'];
    if($shutdown_now==='true'){
        $date_shutdown =date('d/m/Y');
        $time_shutdown = date('H:i:s');
    }
    else{
        if(!$_POST['date-shutdown']||!$_POST['time-shutdown']){
            echo("Nhập thời gian");
            header( "Location: $url" );
            return;
        }
	    $date_shutdown = $_POST['date-shutdown'];
        $time_shutdown = $_POST['time-shutdown'];
        $time_shutdown=$time_shutdown.':00';
    }

    $myfile = fopen("shutdown-log.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $date_shutdown);
    fwrite($myfile, "\n");
    fwrite($myfile, $time_shutdown);
    fwrite($myfile, "\n");
    fclose($myfile);

    header( "Location: $url" );
?>