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
<!-- DOCTYPE "document type the browser to expect" 
//language of text content on the web.-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>NCIS</title>
        <!--Links the external css file to the document-->
        <link href="../stylesheet.css" rel="stylesheet" type="text/css"> 
    <link rel="shortcut icon" href="../Arms.ico"> 
</head>
<style>/*Style Background Image */
body  {
    background-image: url('../image/Kenya.jpg');
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
                <li><a href="crime.php">Occurrence Book</a></li>
                <li><a href="allocatecase.php">Allocate Case</a></li>
                <li><a href="progress.php">Progress</a></li>
                <li><a href="filter.php">Reports</a></li>
                <li><a href="search.php">Search</a></li>
                <li><a href="update.php">Update/Delete</a></li>               
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main_content">
            <div class="main_content">
                <div class="top">
                    <H2>NATIONAL CRIME INVESTIGATION SYSTEM </H2>
                </div>
                <div class="info">
                    <a href="crime.php">
                        <button class="submitbtn">Record an Occurrence</button>
                    </a>
                    
                    <a href="searchofficercase.php">
                        <button class="submitbtn">Search Officer Cases</button>
                    </a>
                    <a href="filterstatus.php">
                        <button class="submitbtn">Report Based On Case Status</button>
                    </a>
                    <a href="filterotype.php">
                        <button class="submitbtn">Reports On Occurrence Type</button>
                    </a>
                    <a href="viewcrime.php">
                        <button class="submitbtn">View all Crimes</button>
                    </a>
                    <a href="viewcase.php">
                        <button class="submitbtn">View All Cases</button>
                    </a>
                    <a href="viewofficers.php">
                        <button class="submitbtn">View All Officer</button>
                    </a>
                    <a href="filterofficer.php">
                        <button class="submitbtn">Reports On Officer</button>
                    </a>
                    <a href="searchofficer.php">
                        <button class="submitbtn">Search Officer</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>