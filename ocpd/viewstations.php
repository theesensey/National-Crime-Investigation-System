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
            <link href="../stylesheet.css" rel="stylesheet" type="text/css"> 
    <link rel="shortcut icon" href="../Arms.ico"> 
    </head>
    <body>
        <div class="wrapper">
            <div class="sidebar">
                <h2>User:
                    <?php

                echo  $_SESSION["user"]
                ?>   
                </h2>
                <ul style="list-style-type:none;"> 
                    <li><a href="index.php">Home</a></li>
                    <li><a href="crime.php">Occurrence Book</a></li>
                    <li><a href="allocatecase.php">Allocate Case</a></li>
                    <li><a href="filter.php">Reports</a></li>
                    <li><a href="search.php">Search</a></li>
                    <li><a href="update.php">Update/Delete</a></li>               
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </div>
            
            <div class="main_content">
                <div class="main_content">
                    <div class="top">
                        <H2>Report On All Stations <a href="filter.php">Back to Reports</a></H2>
                    </div>
        <br>
    
    <div class="tabsort">
    <table id="myTable">
        <tr>
            
            <th>Station ID</th>
            <th>Station Name</th>
            <th>Station Code</th>
            <th>Location</th>
            <th>County</th>
            <th>Cartegory</th>
            <th>Cells</th>
        </tr>
        <?php
        $sql="SELECT * FROM stations ORDER BY id ASC";
    
        $result=mysqli_query($con,$sql);
    
        if($result){
        while($row=mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $name = $row['name'];
            $stationCode = $row['stationCode'];
            $location = $row['location'];
            $county = $row['county'];
            $category = $row['category'];
            $cells = $row['cells'];
            //print data inside table
    echo '
    <tr>
            <td scope ="row">'.$id.' </td>
            <td>'.$name.'</td>
            <td>'.$stationCode.'</td>
            <td>'.$location.'</td>
            <td>'.$county.'</td>
            <td>'.$category.'</td>
            <td>'.$cells.'</td>
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