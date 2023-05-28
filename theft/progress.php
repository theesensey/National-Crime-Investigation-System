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

<!-- DOCTYPE this is the document type "document type the browser to expect" -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Progress</title>
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
            <li><a href="crime.php">Record Occurrence</a></li>
            <li><a href="progress.php">Progress</a></li>
            <li><a href="search.php">Search</a></li> 
            <li><a href="filter.php">Reports</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>

        
        <div class="main_content">
            <div class="main_content">
                <div class="top">
                    <H2>Case In Progress</H2>
                </div>
                    <div class="info">
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
                            <th>Update</th>
    </tr>
    <?php
    //regular join
    $sql = " SELECT * FROM users, cases WHERE users.id = cases.officerId AND users.username= '{$_SESSION['user']}'";
    // Perform Query against the database
    $result=mysqli_query($con,$sql);

    if($result){

    while($row=mysqli_fetch_assoc($result)){ //Fetch a result row and stores it ina the variable $row
        $id= $row['id'];
        $occurrenceId= $row['occurrenceId'];
        $stationCode= $row['stationCode'];  
        $officerId= $row['officerId'];   
        $casename= $row['casename'];
        $casestatus= $row['casestatus'];
        //Convert date from the database to desired output
        $allocationDate= date('d-m-Y', strtotime($row['allocationDate']));
        $remarks= $row['remarks'];

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
<td> <button><a href="progresschanges.php? updateid='.$id.'">Update</a></button>
</td>
</tr>
';}
}
    ?>
</table>
<br>
<a href="index.php">Back to Home</a><br>
        </div>
        </div>
    </div>
        </div>
    </body>