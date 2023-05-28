<?php

//$log is the arguments/contents we will send to the log file
function ncislogs($log){
    //check if the file exists or not 
    if(!file_exists('systemlogs\loginlogs.txt')){
        //if it doesnt exist create it in the folder
        file_put_contents('systemlogs\loginlogs.txt','');

    }
    //Details to capture
    date_default_timezone_set('Africa/Nairobi');//function that sets the time zone
    $time = date('d/m/y H:i A',time()); // time()- The current time as a Unix timestamp 
    //$_SERVER holds information about headers, paths, and script locations REMOTE_ADDR Returns the IP address from where the user is viewing the current page 
    $ip = $_SERVER['REMOTE_ADDR']; //Client IP (is a unique address that identifies a device on the internet or a local network.)
    
    $logcontents = file_get_contents('systemlogs\loginlogs.txt');//Grabbing existing contents in the log file
    //. because we are appending data
    $logcontents .="$ip \t $time \t $log \n";

    //Send back the contents to the file 
    file_put_contents('systemlogs\loginlogs.txt',$logcontents);
}

session_start();
 //Log message
$log= " User: ".$_SESSION['user']." : Logged Out ";

ncislogs($log);
// to close the session and remove user logged in
session_destroy();
unset($_SESSION['user']);

// to redirect to index page
header("location:login.php");

?>