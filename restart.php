<?php 
	//ob_start();
    $url = "ITstaff.php";
    $restart_now= $_POST['restart-now'];
    if($restart_now==='true'){
        $date_restart =date('d/m/Y');
        $time_restart = date('H:i:s');
    }
    else{
        if(!$_POST['date-restart']||!$_POST['time-restart']){
            echo("Nhập thời gian");
            header( "Location: $url" );
            return;
        }
	    $date_restart = $_POST['date-restart'];
        $time_restart = $_POST['time-restart'];
        $time_restart=$time_restart.':00';
    }
    
    $myfile = fopen("restart-log.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $date_restart);
    fwrite($myfile, "\n");
    fwrite($myfile, $time_restart);
    fwrite($myfile, "\n");
    fclose($myfile);

    header( "Location: $url" );
?>