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
    <title>Stations Reports</title>
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
                <div class="info">
                <form  id="form1" method="get">

                <label><b>County</b></label>
                        <!--input type="date"id="crimedate"name="crimedate"-->
                        <select id="county" name="county">
                            <option value="All">All*</option>
                            <option value="Nairobi">Nairobi</option>
                            <option value="Mombasa">Mombasa</option>
                            <option value="Kisumu">Kisumu</option>
                        </select>

                <label><b>Category</b></label>
                        <select id="category" name="category">
                            <option value="All">All*</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>

                        <button type="btn" class="btnsub" name="submit">Generate</button>
                        <a href="filter.php">Back to Reports</a><br>
                </form>
                <hr>

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

    //Set both to nothing
    $filter_county_sql="";
    $station_category_sql=""; 

    //Crime Date
    // ISSET Determine if a variable is declared and is different than NULL
    // $_POST global variable which is used to collect form data after submitting an HTML form with method="post".
    // $_GET is a PHP super global variable which is used to collect form data after submitting an HTML form with method="get"

// Status Type
if(isset($_GET['county'])){ // if there is a status type set it to something
    $county =$_GET['county'];
    if($county!='All'){
        $filter_county_sql = " AND county='$county' ";
    }else{
        $filter_county_sql = "";
    }
}
    
    // Status Type
    if(isset($_GET['category'])){ // if there is a status type set it to something

        $category =$_GET['category'];
        if($category!='All'){
            $station_category_sql = " AND category='$category' ";

        }else{

            $station_category_sql = "";
        }
    }

    // Build the query
    $query = "SELECT * 
            FROM stations 
            WHERE 1 = 1 
            $filter_county_sql
            $station_category_sql";

   /* //Shows what query was run on the database
    echo '<p>Query: <strong>'.$query.'</strong></p>';*/

    // Perform Query
        $result = mysqli_query($con, $query);

    // mysqli_fetch_array() function fetches a result row as an associative array, a numeric array, or both.
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
                </div>
            </div>
        </div>
    </div>

</body>
</html>