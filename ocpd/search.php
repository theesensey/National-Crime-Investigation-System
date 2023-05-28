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
    <title>Search</title>
        <link href="../stylesheet.css" rel="stylesheet" type="text/css"> 
    <link rel="shortcut icon" href="../Arms.ico"> 
</head>
<style>
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
                    <H2>Search</H2>
                </div>

                <div class="info">
                <a href="../ocpd/searchcase.php">
                        <button class="submitbtn">Search Case</button>
                    </a>
                    </a>
                    <a href="../ocpd/searchcrime.php">
                        <button class="submitbtn">Search Crime</button>
                    </a>
                    <a href="../ocpd/searchofficer.php">
                        <button class="submitbtn">Search Officer</button>
                    </a>
                    <a href="../ocpd/searchofficercase.php">
                        <button class="submitbtn">Search Case By Officer Name</button>
                    </a>
                    <br><br>
                    <a href="index.php">Back to Home</a><br>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
</body>

</html>

