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
    <title>Crime Reports</title>
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

                <div class="info">

                <form  id="form1" method="get">
                    
                <label><b>Crime Reported:</b></label>
                        <!--input type="date" id="crimedate" name="crimedate"-->
                        <select id="date_of_incident" name="date_of_incident">
                            <option value="All">All*</option>
                            <option value="1">Last 24 Hrs</option>
                            <option value="2">The last 7 days</option>
                            <option value="3">Last Month</option>
                            <option value="4">Last 6 Months</option>
                            <option value="5">Last Year</option>
                            <option value="6">Last 5 Years</option>
                        </select>

                <label><b>Crime Type</b></label>
                        <select id="crimetype" name="crimetype">
                            <option value="All">All CRIMES </option>
                            <option value="GENDER">GENDER</option>
                            <option value="THEFT">THEFT</option>
                            <option value="HOMICIDE">HOMICIDE</option>

                        </select>

                        <button type="btn" class="btnsub" name="submit">Generate</button>
                        <a href="filter.php">Back to Reports</a><br>
                </form>
                <hr>

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
    
    //Set both date and type to nothing
    $filter_date_sql="";
    $crime_type_sql="";

    //Crime Date
    // ISSET Determine if a variable is declared
    // $_POST is a global variable which is used to collect form data after submitting an HTML form with method="post".
    // $_GET is a global variable which is used to collect form data after submitting an HTML form with method="get"

    if(isset($_GET['date_of_incident'])){ // if there is a crime date set it to something
        $date=$_GET['date_of_incident'];

        if ($date==1){

            $filter_date_sql=" AND date_of_incident >= (now() - INTERVAL 1 day)";//Interval is mainly used to calculate the date and time values
        }elseif ($date==2){
            $filter_date_sql=" AND date_of_incident >= now() - INTERVAL 7 day";
        }elseif ($date==3){
            $filter_date_sql=" AND date_of_incident >= now() - INTERVAL 1 MONTH";
        }elseif ($date==4){
            $filter_date_sql=" AND date_of_incident >= now() - INTERVAL 6 MONTH";
        }elseif ($date==5){
            $filter_date_sql=" AND date_of_incident >= now() - INTERVAL 1 YEAR";
        }elseif ($date==6){
            $filter_date_sql=" AND date_of_incident >= now() - INTERVAL 5 YEAR";
        }else{
            $filter_date_sql="";
        }
    }
    
    // Crime Type
    if(isset($_GET['crimetype'])){ // if there is a crime type set it to something
        $type=$_GET['crimetype'];

        if($type!='All'){
            $crime_type_sql = " AND crimetype='$type' ";
        }else{
            $crime_type_sql = "";
        }
    }

    // Build the query
    $query = "SELECT * FROM occurrences WHERE 1 = 1 $filter_date_sql $crime_type_sql";

   /* //Shows what query was run on the database
    echo '<p>Query: <strong>'.$query.'</strong></p>';*/

    // Perform Query 
        $result = mysqli_query($con, $query);

    // mysqli_fetch_array() function fetches a result row as an associative array, a numeric array, or both.
    while ($row = mysqli_fetch_array($result) ) {

        //Convert date from the database to desired output
        $date_of_incident= date('d-m-Y', strtotime($row['date_of_incident']));

        echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['fullName']}</td>
                <td>{$row['officerId']}</td>
                <td>{$row['stationCode']}</td>
                <td>{$row['id_number']}</td>
                <td>{$row['mobile']}</td>
                <td>{$row['residency']}</td>

                <td>$date_of_incident.</td>
                
                <td>{$row['crimelocation']}</td>
                <td>{$row['crimetype']}</td>
                <td>{$row['description']}</td>
                <td>{$row['comments']}</td>
            </tr>
            ";
    }
?>
    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>