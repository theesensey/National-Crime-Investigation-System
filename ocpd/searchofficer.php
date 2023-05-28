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
    <title>Search Officer</title>
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
        </div>

        <div class="main_content">
            <div class="main_content">
                <div class="top">
                    <H2>Search Officer</H2>
                </div>
                
                <div class="wrap"> 
                    
                    <!-- Search officer -->

                    <form action="searchofficer.php" method="post" name="search officer">
                        
                            <legend>Search By Officer Id</legend>

                    <div class="dbl-field">
                            <div class="field">
                            <label for="id">Officer Id</label> 
                            <br>
                            <input type="text" class="form-control" name="id" placeholder="Enter Officer Id" maxlength="5" >
                            <br><br>
                        </div>
                    </div>
                    <br>
                            <button type="btn" class="btnsub" name="search" value="Search">Search</button>
                            <button class="btnres" type="reset" value="reset">Reset</button>
                            <a href="search.php">Back to Search</a><br>
                        
                    </form>
                    <br>
                        <!--Results Form -->
                <form  method="POST">
                
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

                // ISSET Determine if a variable is declared...determine whether a variable is set or not
                // $_POST is a global variable which is used to collect form data from an HTML form with method="post" Its an Array
                //once search button has been clicked
                if(isset($_POST['search'])) 
                
                    { 
                    $id=$_POST['id'];
                
                    $query="SELECT * FROM users WHERE id ='$id'";
                    // Holds result of running the query on the database
                    $run = mysqli_query($con, $query) or die(mysqli_connect_error());

                    //Result set is a set of rows from a database/ We want to run through them to print as a report or filter
                    if (mysqli_num_rows($run ) > 0)
                    {
                    //fetches all the result set and returns in an array variable $row
                    while($row = mysqli_fetch_array($run))   
                {
                        $id=$row['id'];   
                        $stationCode=$row['stationCode']; 
                        $firstName=$row['firstName'];
                        $lastName=$row['lastName'];
                        $mobile=$row['mobile'];
                        $department=$row['department'];
                        $rank=$row['rank'];
                        $county=$row['county'];
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
                                    ';
                    ?>
                    </table>
                                </div>
                                </div>
                                </div>
                </div>
                        <?php
                    }    
                    }
                    else
                    {
                        echo "<script>alert('OFFICER DOES NOT EXIST!');</script>";
                    }
                    }
                        ?>
                </body>
                </html>