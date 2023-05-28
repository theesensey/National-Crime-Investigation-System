<?php

function ncislogs($log){ //$log is the arguments/contents we will send to the log file
    //check if the file exists or not 
    if(!file_exists('..\systemlogs\deletelogs.txt')){
        //if it doesnt exist create it in the folder
        file_put_contents('..\systemlogs\deletelogs.txt','');

    }
    //Details to capture
    date_default_timezone_set('Africa/Nairobi');//function that sets the time zone
    $time = date('d/m/y H:i A',time()); // time()- The current time as a Unix timestamp 
    //$_SERVER holds information about headers, paths, and script locations REMOTE_ADDR Returns the IP address from where the user is viewing the current page 
    $ip = $_SERVER['REMOTE_ADDR']; //Client IP (is a unique address that identifies a device on the internet or a local network.)
    
    $logcontents = file_get_contents('..\systemlogs\deletelogs.txt');//Grabbing existing contents in the log file
    //. because we are appending data
    $logcontents .="$ip \t $time \t $log \n";

    //Send back the contents to the file 
    file_put_contents('..\systemlogs\deletelogs.txt',$logcontents);
}

//Creates a session or Resumes the current one based on a session identifier 
session_start();

    //Checking if user is logged in
    if(!$_SESSION['user'])
{
    //Redirects to approriate page / method
    header('Location: ../login.php ' );
}

//Config with parameters
$server="localhost"; //"Localhost" refers to the local computer that a program is running on
$username="moturi";  // Specifies the MySQL username
$password="logmein"; // Specifies the MySQL password
$dbname="nationalcrimeinvestigation"; //Specifies the default database to be used

  // "mysqli_connect" Opens a new connection to the MySQL server
$con= mysqli_connect($server, $username, $password, $dbname);
  // ! (Logic Operator) NOT True if $con is NOT true
if (!$con) {
    echo "Connection failed!";}   
    

//use GET to return deleteid set in delete button
if(isset($_GET['deleteid'])){
//accessing  deleteid from url and storing in variable
$id=$_GET['deleteid'];


//delete query
$sql="DELETE FROM users WHERE id=$id";
$result=mysqli_query($con,$sql);

if($result){
    //Log message
  $log= " ".$_SESSION['user']." deleted officer $id ";

  ncislogs($log); 
  //  echo "delete successfull";
  header("refresh:0.5;url=../ocpd/updateofficerview.php");

  echo "<script>
        alert('Officer Deleted Successfully!');
        </script>";
}else{
    die(mysqli_error($con));
}

}

?>