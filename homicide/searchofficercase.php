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
    <title>Search Case By Officer Name</title>
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
                <li><a href="allocate.php">Allocate Case</a></li>     
                <li><a href="filter.php">Reports</a></li>
                <li><a href="progress.php">Progress</a></li>
                <li><a href="search.php">Search</a></li>  
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="update.php">Update</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main_content">
            <div class="main_content">
                <div class="top">
                    <H2>Search Officer Case</H2>
                </div>
                
                <div class="wrap"> 
                    
                    <!-- Search officer -->

                    <form  method="post" name="searchofficercase">
                        
                            <legend>Search Officer Case By Name</legend>

                    <div class="dbl-field">
                            <div class="field">
                            <label for="firstName">Officer First Name</label> 
                            <br>
                            <input type="text" class="form-control" name="firstName" placeholder="Enter Officer First Name" maxlength="20" >
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
                <form method="POST" name="searchofficercase">
                
                <div class="tabsort">
                <table id="myTable">
                    <tr>
                        
                    <th>Case ID</th>
                            <th>Occurence ID</th>
                            <th>Station Code</th>
                            <th>Officer Allocated</th>
                            <th>Case Name</th>
                            <th>Case Status</th>
                            <th>Crime Type</th>
                            <th>Allocationdate</th>
                    </tr>
    <?php
    // ISSET Determine if a variable is declared...determine whether a variable is set or not
    // $_POST is a global variable which is used to collect form data from an HTML form with method="post" Its an Array
    //once search button has been clicked
        if(isset($_POST['search'])){ 

        $firstname=$_POST['firstName'];
                
    // Regular join
    $query= "SELECT * FROM users, cases WHERE users.id = cases.officerId AND users.firstName = '{$firstname}'";

    // Holds result of running the query on the database
    $run = mysqli_query($con, $query) or die(mysqli_connect_error());
    //Result set is a set of rows from a database/ We want to run through them to print as a report or filter
    if (mysqli_num_rows($run ) > 0)
    {
        //fetches all the result set and returns in an array variable $row //Only return one users name
        while($row = mysqli_fetch_array($run))   
        {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['occurrenceId']}</td>
                <td>{$row['stationCode']}</td>
                <td>{$row['officerId']}</td>
                <td>{$row['casename']}</td>
                <td>{$row['casestatus']}</td>
                <td>{$row['crimetype']}</td>
                <td>{$row['allocationDate']}</td>
            </tr>
            ";
    }
?>
                    </table>
                                </div>
                                </div>
                                </div>
                </div>
                        <?php
                    }    
                    }                  
                        ?>
                </body>
                </html>