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
    <title>Search Case</title>
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
                    <H2>Search Case</H2>
                </div>
                <div class="wrap">         
                    <!-- Search Case -->
                    <form method="post" name="search case">                
                            <legend>Search By Case Id</legend>
                    <div class="dbl-field">
                            <div class="field">
                            <label for="id">Case Id</label> 
                            <br>
                            <input type="text" class="form-control" name="id" placeholder="Enter Case Id" minlength="1" maxlength="5" required>
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
                    <form method="POST" name="searchcase">
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

// ISSET Determine if a variable is declared...determine whether a variable is set or not
// $_POST is a global variable which is used to collect form data from an HTML form with method="post" Its an Array
if(isset($_POST['search'])) 
    { 
    $id=$_POST['id'];

    
    $query="SELECT * FROM cases WHERE id ='$id'";
    
     // Holds result of running the query on the database
    $run = mysqli_query($con, $query);
    //Result set is a set of rows from a database/ We want to run through them to print as a report or filter
    if (mysqli_num_rows($run ) > 0) //Gets the number of rows in a result and stores them in variable $run 
    {   
        //fetches all the result set and returns in an array variable $row
    while($row = mysqli_fetch_array($run))   
{

    $id= $row['id'];
    $occurrenceId= $row['occurrenceId'];
    $stationCode= $row['stationCode'];  
    $officerId= $row['officerId'];   
    $casename= $row['casename'];
    $casestatus= $row['casestatus'];
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
        echo "<script>alert('CASE DOES NOT EXIST!');</script>";
    }
    }
        ?>

</body>
</html>