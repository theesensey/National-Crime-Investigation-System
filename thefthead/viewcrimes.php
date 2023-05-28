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
    <title>Crime Report</title>
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
                    <H2>Crime View <a href="filter.php">Back to Reports</a></H2>
                </div>
        <br>

<div class="tabsort">
<table id="myTable">
    <tr>
        
                            <th>Occurence ID</th>
                            <th>Full Name</th>
                            <th>Officer Allocated</th>
                            <th>Station Code</th>
                            <th>ID Number</th>
                            <th>Mobile</th>
                            <th>Residency</th>
                            <th>Date Of Incident</th>
                            <th>Crime Location</th>
                            <th>Crime Type</th>
                            <th>Description</th>
                            <th>Officers Comments</th>
    </tr>
    <?php
    $sql="SELECT * FROM occurrences";
    // Holds result of running the query on the database

    $result=mysqli_query($con,$sql);

    if($result){
    while($row=mysqli_fetch_assoc($result)){
        $id= $row['id'];
        $fullName= $row['fullName'];
        $officerId= $row['officerId'];
        $stationCode= $row['stationCode'];
        $id_number= $row['id_number'];  
        $mobile= $row['mobile'];   
        $residency= $row['residency'];
        $date_of_incident= date('d-m-Y', strtotime($row['date_of_incident']));
        $crimelocation= $row['crimelocation'];
        $crimetype= $row['crimetype'];
        $description= $row['description'];  
        $comments= $row['comments'];  

echo '
<tr>
<td scope ="row">'.$id.' </td>
<td>'.$fullName.'</td>
<td>'.$officerId.'</td>
<td>'.$stationCode.'</td>
<td>'.$id_number.'</td>
<td>'.$mobile.'</td>
<td>'.$residency.'</td>
<td>'.$date_of_incident.'</td>
<td>'.$crimelocation.'</td>
<td>'.$crimetype.'</td>
<td>'.$description.'</td>
<td>'.$comments.'</td>
</tr>
';}
    }
    ?>
</table>
<br>

</div>
</div>
</div>
        </div>
</body>
</html>