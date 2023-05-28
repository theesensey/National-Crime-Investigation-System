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
    <title>Officer Reports</title>
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
            <!-- 
                The <a> tag defines a hyperlink, which is used to link from one page to another.
                The <div> tag defines a division or a section in an HTML document.
                The <li> tag defines a list item.    
            -->
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
                <form id="form1" method="post">
                    
                <label><b>County</b></label>
                <select id="county" name="county">
                            <option value="ALL" selected="selected" >ALL*</option>
                            <option value="Nairobi">NAIROBI</option>
                            <option value="Mombasa">MOMBASA</option>
                            <option value="Kisumu">KISUMU</option>
                        </select>

                        <label><b>Criteria</b></label>
                        <select id="department" name="department">
                            <option value="ALL"></option>
                            <option value="OCPD">OCPD</option>
                            <option value="GENDER">GENDER</option>
                            <option value="THEFT">THEFT</option>  
                            <option value="HGENDER">HEAD INVESTIGATOR GENDER</option>
                            <option value="HTHEFT">HEAD INVESTIGATOR THEFT</option>   
                        </select>

                        <button type="btn" class="btnsub" name="submit">Generate</button>
                        <a href="filter.php">Back to Reports</a><br><br>
                </form>

                <div class="tabsort">
<table id="myTable">
                    <tr>
                    <th>Officer ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Mobile Number</th>
                    <th>Station ID</th>
                    <th>County</th>
                    <th>Criteria</th>
                    <th>Rank</th>

                    </tr>

    <?php
    // ISSET Determine if a variable is declared...determine whether a variable is set or not
// $_POST is a global variable which is used to collect form data from an HTML form with method="post" Its an Array
        if (isset($_POST['submit'])) {

            $county = $_POST['county'];
            $department = $_POST['department'];

            //Check for input in the select boxes (!= "Not equal" Returns True)
                if ($county != ""  || $department != "" ) {
                    if($county != "ALL"){
                        $county_sql = " AND  county='$county' "; 
                    }else{
                        $county_sql = "";
                    }

                    if($department != "ALL"){
                        $department_sql = " AND  department='$department' "; 
                    }else{
                        $department_sql = "";
                    }

                    //Condition means WHERE TRUE, so it's just returning the same query result as it would without the WHERE clause.
                            $sql = "SELECT * 
                            FROM users 
                            WHERE 1 = 1
                            $county_sql
                            $department_sql
                            ";
                            
                            // Holds result of running the query on the database
                            $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                            //check if table contains records
                            //Result set is a set of rows from a database
                            if (mysqli_num_rows($result) > 0) { //Gets the number of rows in a result and stores them in variable $result

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id=$row['id'];   
                                    $firstName=$row['firstName'];
                                    $lastName=$row['lastName'];
                                    $mobile=$row['mobile'];
                                    $stationCode=$row['stationCode']; 
                                    $county=$row['county']; 
                                    $department=$row['department'];
                                    $rank=$row['rank'];
                                    //print data inside table
?>
<tr>
                                        <td><?php echo $id; ?> </td>
                                        <td><?php echo $firstName; ?></td>
                                        <td><?php echo $lastName; ?></td>
                                        <td><?php echo $mobile; ?></td>
                                        <td><?php echo $stationCode; ?></td>
                                        <td><?php echo $county; ?></td>
                                        <td><?php echo $department; ?></td>
                                        <td><?php echo $rank; ?></td>
    </tr>
<?php
    }    
    }
    else
    {
        echo "<script>alert('RECORD DOES NOT EXIST!');</script>";
    }
    }
        }
    ?>
    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validate() {
            var county = document.getElementById("county").value;
            var department = document.getElementById("department").value;
        
            if (document.getElementById('county').value == "") {
                alert('Please select County');
                document.getElementById('county');
                return false;

            }            

            if (document.getElementById('department').value == "") {
                alert('Please select department');
                document.getElementById('department');
                return false;
            }         
        }


        //Select the form from the DOM
        var form = document.getElementById("form1");

        //Validate the form before submitting it to the backend
        // Attach an event listener to the submit event
        // The submit event is called before a form is submitted
        // e -- is the event (in this case submit)
        form.addEventListener("submit", function(event) {
            //Validate our form 
            var result = validate();
            if (result == false) {
                //There is an error if result is false
                //Prevent the default action of the form(by default a form submits so we want to disable that for now)
                event.preventDefault();
            }

        });
    </script>
</body>

</html>