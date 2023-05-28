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
<!-- Document type the browser to expect" -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Case Reports</title>
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
                <li><a href="crime.php">Occurrence Book</a></li>
                <li><a href="allocatecase.php">Allocate Case</a></li>
                <li><a href="progress.php">Progress</a></li>
                <li><a href="filter.php">Reports</a></li>
                <li><a href="search.php">Search</a></li>
                <li><a href="update.php">Update/Delete</a></li>               
                <li><a href="../logout.php">Logout</a></li>
            </ul>
            </ul> 
        </div>
        
        <div class="main_content">
            <div class="main_content">
                <div class="info">
                <form  id="form" method="get">
                        <label><b>Months</b></label>
                        <select id="month" name="month">
                            <option value="ALL">ALL*</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>

                        </select>

                        <label><b>Year</b></label>
                        <select id="year" name="year">
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>

                        </select>
                        <button type="btn" class="btnsub" name="submit">Generate</button>

                        <a href="filter.php">Back to Reports</a><br>
                </form>
                <hr>

                <div class="tabsort">
<table id="myTable">
                    <tr>
                        <th>Case ID</th>
                        <th>Occurrence ID</th>
                        <th>Station Code</th>
                        <th>Officer ID</th>
                        <th>Case Name</th>
                        <th>Case Status</th>
                        <th style="background-color: #FFFF00">Crime Type</th>
                        <th>Allocation date</th>
                    </tr>
                    <?php

function getStartDate($month,$year){

    $date = new DateTime();
    $date->setDate($year, $month, 1);
    
    return $date->format('Y-m-d 00:00:00');
}
    
function getEndDate($month,$year){
    
    $date = new DateTime();
    $date->setDate($year, $month, 1);
    
    return $date->format('Y-m-t 23:59:59');
}

if (isset($_GET['submit'])) { 

    if($_GET['month'] == 'ALL'){
        
        $year   = $_GET['year'];
        $startDate = getStartDate(1,$year);
        $endDate = getEndDate(12,$year);

    }else{
        $month  = $_GET['month'];
        $year   = $_GET['year'];
    
        $startDate = getStartDate($month,$year);
        $endDate = getEndDate($month,$year);
    }

    $query = "SELECT * 
            FROM cases 
            WHERE 1 = 1
            AND  allocationDate >= '{$startDate}' 
            AND  allocationDate <= '{$endDate}'";

    $result = mysqli_query($con, $query);

    // mysqli_fetch_array() function fetches a result row as an associative array, a numeric array, or both.
    while ($row = mysqli_fetch_array($result) ) {

        $allocationdate= date('d-m-Y', strtotime($row['allocationDate']));
        
        echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['occurrenceId']}</td>
                <td>{$row['stationCode']}</td>
                <td>{$row['officerId']}</td>
                <td>{$row['casename']}</td>
                <td>{$row['casestatus']}</td>
                <td>{$row['crimetype']}</td>
                <td>$allocationdate.</td>
            </tr>
            ";
    }}
?>
    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>