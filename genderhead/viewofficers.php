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
    <title>Gender View</title>
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
                    <H2>Report On All Officers <a href="index.php">Back to Reports</a></H2>
                </div>
    <br>

<div class="tabsort">
<table id="myTable">
    <tr>
        
        <th>Officer ID</th>
        <th>Station ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Mobile Number</th>
        <th>Department</th>
        <th>Rank</th>
        <th>County</th>
    </tr>
    <?php
    $sql="SELECT * FROM users ORDER BY id ASC";

    $result=mysqli_query($con,$sql);

    if($result){
    while($row=mysqli_fetch_assoc($result)){
                        $id=$row['id'];   
                        $stationCode=$row['stationCode']; 
                        $firstName=$row['firstName'];
                        $lastName=$row['lastName'];
                        $mobile=$row['mobile'];
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
        <td>'.$department.'</td>
        <td>'.$rank.'</td>
        <td>'.$county.'</td>
</tr>
';}
    }
    ?>
</table>
<br>
    <a href="filter.php">Back to Reports</a>
</div>
</div>
</div>
        </div>
</body>

</html>