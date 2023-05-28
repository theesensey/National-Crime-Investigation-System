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
    <title>Case</title>
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
                    <H2>All Cases <a href="index.php">Back to Reports</a></H2>
                </div>

    <br>

<div class="tabsort">
<table id="myTable">
    <tr>
                            <th>Case ID</th>
                            <th>Occurence ID</th>
                            <th>Station Code</th>
                            <th>Officer Allocated</th>
                            <th>Case Name</th>
                            <th>Case Status</th>
                            <th>Allocationdate</th>
                            <th>REMARKS</th>
    </tr>
    <?php
    $sql="SELECT * FROM cases WHERE crimetype='GENDER'";
    $result=mysqli_query($con,$sql);

    if($result){
    
        while($row=mysqli_fetch_assoc($result)){
            $id= $row['id'];
            $occurrenceId= $row['occurrenceId'];
            $stationCode= $row['stationCode'];  
            $officerId= $row['officerId'];   
            $casename= $row['casename'];
            $casestatus= $row['casestatus'];
            //Convert date from the database to desired output
            $allocationDate= date('d-m-Y', strtotime($row['allocationDate']));
            $remarks= $row['remarks'];
            //print data inside table
    
    echo '
    <tr>
            <td scope ="row">'.$id.' </td>
            <td>'.$occurrenceId.'</td>
            <td>'.$stationCode.'</td>
            <td>'.$officerId.'</td>
            <td>'.$casename.'</td>
            <td>'.$casestatus.'</td>
            <td>'.$allocationDate.'</td>
            <td>'.$remarks.'</td>
    </tr>
    ';}
        }
        ?>
    </table>

    </div>
    <br>
    <a href="filter.php">Back to Reports</a>
    </div>
    </div>    
    </div>
    </body>
    </html>