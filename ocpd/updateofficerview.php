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
    <title>Officer</title>
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
                    <H2>Officer Update/Delete <a href="update.php">Back to Update</a></H2>
                </div>
                    <div class="info">
                    <div class="tabsort">
<table id="myTable">
    <tr>

        <th>Officer ID</th>
        <th>Station ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Mobile Number</th>
        <th>County</th>
        <th>Department</th>
        <th>Rank</th>
        <th>County</th>
    </tr>

    <?php
    $sql='SELECT * FROM users';

    $result=mysqli_query($con,$sql);
    if($result){

    while($row=mysqli_fetch_assoc($result)){

        $id=$row['id'];   
        $stationCode=$row['stationCode']; 
        $firstName=$row['firstName'];
        $lastName=$row['lastName'];
        $mobile=$row['mobile'];
        $county=$row['county'];
        $department=$row['department'];
        $rank=$row['rank'];
        $county=$row['county'];
    
//print data inside table
echo '
<tr>
<td scope ="row">'.$id.' </td>
<td>'.$stationCode.'</td>
<td>'.$firstName.'</td>
<td>'.$lastName.'</td>
<td>'.$mobile.'</td>
<td>'.$county.'</td>
<td>'.$department.'</td>
<td>'.$rank.'</td>
<td>'.$county.'</td>
    <td>
    <button><a href="../ocpd/updateofficerchanges.php? updateid='.$id.'">Update</a></button>
    <button><a href="../ocpd/deleteofficer.php? deleteid='.$id.'">Delete</a></button> 
</td>
</tr>
';}
}
    ?>
</table>
        </div>
        </div>
    </div>
        </div>
    </body>
</html>