<?php

function ncislogs($log){ //$log is the arguments/contents we will send to the log file
    //check if the file exists or not 
    if(!file_exists('..\systemlogs\progresslogs.txt')){
        //if it doesnt exist create it in the folder
        file_put_contents('..\systemlogs\progresslogs.txt','');

    }
    //Details to capture
    date_default_timezone_set('Africa/Nairobi');//function that sets the time zone
    $time = date('d/m/y H:i A',time()); // time()- The current time as a Unix timestamp 
    //$_SERVER holds information about headers, paths, and script locations REMOTE_ADDR Returns the IP address from where the user is viewing the current page 
    $ip = $_SERVER['REMOTE_ADDR']; //Client IP (is a unique address that identifies a device on the internet or a local network.)
    
    $logcontents = file_get_contents('..\systemlogs\progresslogs.txt');//Grabbing existing contents in the log file
    //. because we are appending data
    $logcontents .="$ip \t $time \t $log \n";

    //Send back the contents to the file 
    file_put_contents('..\systemlogs\progresslogs.txt',$logcontents);
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


    
//GET is a super global variable which is used to collect form data after submitting an HTML form 
//use GET to return updateid set in update button and store in $caseid variable
$id=$_GET['updateid'];

//display data in fields for update
$sql="SELECT * FROM cases WHERE id=$id";

// Holds result of running the query on the database
$result=mysqli_query($con,$sql);
//get from table and display in fields

$row=mysqli_fetch_assoc($result);

$id= $row['id'];
$occurrenceId= $row['occurrenceId'];
$stationCode= $row['stationCode'];  
$officerId= $row['officerId'];   
$casename= $row['casename'];
$casestatus= $row['casestatus'];
$allocationDate= date('d-m-Y', strtotime($row['allocationDate']));
$remarks= $row['remarks'];

if(isset($_POST['submit'])){

$casename = $_POST['casename'];
$casestatus = $_POST['casestatus'];
$remarks = $_POST['remarks'];

$sql="UPDATE cases SET  casename='$casename',
                        casestatus='$casestatus',remarks='$remarks'
WHERE id=$id";

//to execute query
$result=mysqli_query($con,$sql);
//check condition if query run successfully
if($result){
    //Log message
    $log= " ".$_SESSION['user']." made changes to the Case ID: $id ";

    ncislogs($log); 
   // echo "Updated successfully";
   //after update redirects to table view
    header("refresh:2;url=../thefthead/progress.php");
    echo "<script>
        alert('Updated Successfully!');
        </script>";
}else{
        die(mysqli_error($con));
    }
}


?>
<!-- DOCTYPE "document type the browser to expect" 
//language of text content on the web.-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Case Progress</title>
        <link href="../stylesheet.css" rel="stylesheet" type="text/css"> 
    <link rel="shortcut icon" href="../Arms.ico"> 
</head>

<body>
    <div class="wrapper">

        <div class="sidebar">
            <h2>User:
                <?php
                // Show the session variable that was stored on login
                echo  $_SESSION["user"]
                ?>
            </h2>
            <ul style="list-style-type:none;"> 
                <li><a href="index.php">Home</a></li>
                <li><a href="allocate.php">Allocate Case</a></li>
                <li><a href="progress.php">Progress</a></li> 
                <li><a href="filter.php">Reports</a></li>
                <li><a href="search.php">Search</a></li>   
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="update.php">Update</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>

        
        <div class="main_content">
            <div class="main_content">
                <div class="top">
                    <H2>Update Case </H2>
                </div><br>
                <div class="wrap"> 

            <form id="form1" method="post" onsubmit="return validate()" >
                            <div class="dbl-field">
                            <div class="field">
                        <label for="occurrenceId">Occurence ID</label>
                        <br>
                        <input type="number" class="form-control" name="occurrenceId" placeholder="Occurence ID number" value="<?php echo $occurrenceId; ?>" readonly>
                        <br><br>
                            </div>
                        </div>
                        <br>
                        
                        <div class="dbl-field">
                            <div class="field">
                        <label for="stationCode">Station Code</label>
                        <br>
                        <input id="stationcode" type="text" class="form-control" name="stationCode" placeholder="Current Station Code" value="<?php echo $stationCode; ?>" readonly>
                        <br><br>
                            </div>
                            <br>
                            <div class="field">
                        <label for="officerId">Enter Officer ID:</label>
                        <br>
                        <input type="number" class="form-control" name="officerId" placeholder="Officer to be allocated" value="<?php echo $officerId;?>" readonly>
                        <br><br>
                            </div>
                        </div>
                        <br>

                        <div class="dbl-field">
                            <div class="field">
                        <label for="casename">Case Name</label>
                        <br>
                        <input type="text" class="form-control" name="casename" placeholder="Case Name" value="<?php echo $casename;?>">
                        <br><br>
                            </div></div>
                            <br>

                            <div class="dbl-field">
                            <div class="field">
                        <label for="casestatus">Case Status</label>
                        <select name="casestatus" >
                        <option value="<?php echo $casestatus; ?>"><?php echo $casestatus; ?></option>
                        <option value="Allocated">Allocated</option>
                        <option value="Completed">Completed</option>
                        <option value="Closed">Closed</option>
                        </select> 
                        </div>
                        </div>

                            <div class="dbl-field">
                            <div class="field">
                            <label for="allocationDate"> Date Case Allocated:</label>
                        <br>
                        <input type="text" class="form-control" placeholder="DD-MM-YYYY"  name="allocationDate" value="<?php echo $allocationDate; ?>" readonly>
                        <br><br>
                            </div>
                            <br>

                            
                            <div class="dbl-field">
                            <div class="field">
                            <label for="remarks"> REMARKS:</label>
                        <br>
                        
                        <input type="text" class="form-control" placeholder="Remarks"  name="remarks" value="<?php echo $remarks; ?>">
                        <br><br>
                            </div>
                            <br>

                        <button class="btnsub" type="submit" name="submit" >Update</button>
                        <button class="btnres" type="clear" onclick="myFunction()">Reset</button>
                        <a href="progress.php">Back to Progress</a><br>
                        
                        </div>

            </div>
        </form>
        </div>
    </div>
</div>
</body>
</html>