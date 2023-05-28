<?php
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
    
?>

<!-- DOCTYPE document type the browser to expect -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reports</title>
        <link href="../stylesheet.css" rel="stylesheet" type="text/css"> 
    <link rel="shortcut icon" href="../Arms.ico"> 
</head>
<style>
body  {
    background-image: url('image/Kenya.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;  
    background-position: center;
    background-size: auto;
}
</style>
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
                    <H2>REPORTS</H2>
                </div>
                <div class="info">
                    <a href="filterofficers.php">
                        <button class="submitbtn">Reports On Officers</button>
                    </a>
                    <a href="filtertype.php">
                        <button class="submitbtn">Reports Based On Case Type</button>
                    </a>
                    <a href="filterstatus.php">
                        <button class="submitbtn">Reports Based On Case Status</button>
                    </a>
                    <a href="filterotype.php">
                        <button class="submitbtn">Reports Based On Crime Type</button>
                    </a>
                    <a href="viewcrimes.php">
                        <button class="submitbtn">All Crimes Reported </button>
                    </a>
                    <a href="viewtheftcases.php">
                        <button class="submitbtn">All Theft Cases Report</button>
                    </a><br><br><br>
                    <a href="index.php">Back to Home</a><br>
                </div>
            </div>
        </div>
    </div>
</body>
</html>