<?php

function ncislogs($log){ //$log is the arguments/contents we will send to the log file
    //check if the file exists or not 
    if(!file_exists('..\systemlogs\updatelogs.txt')){
        //if it doesnt exist create it in the folder
        file_put_contents('..\systemlogs\updatelogs.txt','');

    }
    //Details to capture
    date_default_timezone_set('Africa/Nairobi');//function that sets the time zone
    $time = date('d/m/y H:i A',time()); // time()- The current time as a Unix timestamp 
    //$_SERVER holds information about headers, paths, and script locations REMOTE_ADDR Returns the IP address from where the user is viewing the current page 
    $ip = $_SERVER['REMOTE_ADDR']; //Client IP (is a unique address that identifies a device on the internet or a local network.)
    
    $logcontents = file_get_contents('..\systemlogs\updatelogs.txt');//Grabbing existing contents in the log file
    //. because we are appending data
    $logcontents .="$ip \t $time \t $log \n";

    //Send back the contents to the file 
    file_put_contents('..\systemlogs\updatelogs.txt',$logcontents);
}

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

    
//GET is a super global variable which is used to collect form data after submitting an HTML form 
//use GET to return updateid set in update button and store in $caseid variable
$id=$_GET['updateid'];

//display data in fields for update
$sql="SELECT * FROM occurrences WHERE id=$id";
// Holds result of running the query on the database
$result=mysqli_query($con,$sql);
//get from table and display in fields

$row=mysqli_fetch_assoc($result);


$fullName= $row['fullName'];
$officerId= $row['officerId'];
$stationCode= $row['stationCode'];
$id_number= $row['id_number'];  
$mobile= $row['mobile'];   
$residency= $row['residency'];
//Convert date from the database to desired output
$date_of_incident= date('d-m-Y', strtotime($row['date_of_incident']));
$crimelocation= $row['crimelocation'];
$crimetype= $row['crimetype'];
$description= $row['description'];  
$comments= $row['comments'];  


if(isset($_POST['submit'])){

        $fullName= $_POST['fullName'];
        $officerId= $_POST['officerId'];
        $stationCode= $_POST['stationCode'];
        $id_number= $_POST['id_number'];  
        $mobile= $_POST['mobile'];   
        $residency= $_POST['residency'];
        $date_of_incident = date('Y-m-d', strtotime($_POST['date_of_incident']));
        $crimelocation= $_POST['crimelocation'];
        $crimetype= $_POST['crimetype'];
        $description= $_POST['description'];  
        $comments= $_POST['comments'];  

$sql="UPDATE occurrences SET   fullName='$fullName',officerId='$officerId',
                        stationCode='$stationCode',id_number='$id_number',mobile='$mobile',
                        residency='$residency',date_of_incident='$date_of_incident',crimelocation='$crimelocation',crimetype='$crimetype',description='$description'
                        ,comments='$comments'
WHERE id=$id";

//to execute query
$result=mysqli_query($con,$sql) or die(mysqli_error($con));

    //Shows what query was run on the database
    echo '<p>Query: <strong>'.$result.'</strong></p>';
//check condition if query run successfully
if($result){
        //Log message
        $log= " ".$_SESSION['user']." made changes to Occurrence $id ";

        ncislogs($log); 
    
   // echo "Updated successfully";
   //after update redirects to table view
    header("refresh:80;url=../ocpd/updatecrimeview.php");
    echo "<script>
        alert('Crime Details Updated Successfully!');
        </script>";
}else{
    echo "<script>
    alert('Crime Update Error!');
    </script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Filter Crime</title>
        <link href="../stylesheet.css" rel="stylesheet" type="text/css"> 
    <link rel="shortcut icon" href="../Arms.ico"> 
</head>
<style>
.form-control {
    width: 70%;
}

.form .dbl-field {
    display: flex;
    margin-bottom: 13px;
    align-items: center;
    justify-content: space-between;
}

.dbl-field .field {
    height: 60px;
    position: relative;
    width: calc(100% / 2 - 40px);
    margin-bottom:13px;
    float: left;
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
                    <H2>Update Crime </H2>
                </div><br>
                <div class="wrap"> 
    <!--
        The form element represents a collection of form-associated elements, 
        some of which can represent editable values that can be submitted to a server for processing.
        The input element represents a typed data field, usually with a form control to allow the user to edit the data.
    post: Corresponds to the HTTP POST method ; form data are included in the body of the form and sent to the server.
     
    -->
    <form method="post" name="occurrence" id="form1">
                        <div class="dbl-field">

                            <div class="field">
                        <label for="fullName">Full Names</label>
                        <br>
                        <input type="text" class="form-control" name="fullName" placeholder="Your Full names" id="fullName" value="<?php echo $fullName; ?>">
                        <br><br>
                            </div>
                        </div>
                        
                        <div class="dbl-field">
                            <div class="field">
                        <label for="officerId">Enter Officer ID:</label>
                        <br>
                        <input type="text" class="form-control" name="officerId" placeholder="Enter Officer Id" id="officerId" value="<?php echo $officerId; ?>">
                        <br><br>
                            </div>
                            <br>
                            <div class="field">
                        <label for="stationCode">Enter your Station Code:</label>
                        <br>
                        <input type="text" class="form-control" name="stationCode" placeholder="Your station code" id="stationCode" value="<?php echo $stationCode; ?>">
                        <br><br>
                            </div>
                        </div>
                        <br>

                        <div class="dbl-field">
                            <div class="field">
                            <label for="mobile">Enter Phone Number</label>
                        <br>
                        <input type="text" class="form-control" name="mobile" placeholder="Your mobile number" id="mobile"value="<?php echo $mobile; ?>">
                        <br><br>
                            </div>
                            <br>
                            <div class="field">
                        <label for="id_number">Enter ID Number</label>
                        <br>
                        <input type="text" class="form-control" name="id_number" placeholder="Enter Identification number" id="id_number" value="<?php echo $id_number; ?>">
                        <br><br>
                            </div>
                        </div>
                        <br>
                        <div class="dbl-field">
                            <div class="field">
                        <label for="residency">Residency</label>
                        <br>
                        <input type="text" class="form-control" name="residency" placeholder="Enter your residency" id="residency"value="<?php echo $residency; ?>">
                        <br><br>
                            </div>
                            <br>
                            <div class="field">
                            <label for="date_of_incident"> Date of incident:</label>
                        <br>
                        <input type="text" class="form-control" placeholder="dd-mm-yyyy"  name="date_of_incident" id="date_incident"value="<?php echo $date_of_incident; ?>">
                        <br><br>
                            </div>
                            </div>
                            <br>

                            <div class="dbl-field">
                            <div class="field">
                        <label for="crimelocation">Enter Crime Location</label>
                        <br>
                        <input type="text" class="form-control" name="crimelocation" placeholder="Enter Crime Location" id="location" value="<?php echo $crimelocation; ?>">
                        <br><br>
                            </div>

                            <div class="field">
                        <label for="crimetype">Crime Type</label>
                        <select id="crimetype" name="crimetype">
                        <option value="<?php echo $crimetype; ?>"> <?php echo $crimetype; ?> </option>
                            <option value="GENDER">GENDER</option>
                            <option value="THEFT">THEFT</option>
                            <option value="HOMICIDE">HOMICIDE</option>
                        </select> 
                            </div>
                            </div>

                            <div class="dbl-field">
                            <div class="field">
                        <label for="description">Description</label>
                        <br>
                        <input type="text" class="form-control" name="description" placeholder="Description of the incident" id="description" value="<?php echo $description; ?>">
                        <br>
                            </div>
                            <div class="field">
                        <label for="comments">Officer comments</label>
                        <br>
                        <input type="text" class="form-control" name="comments" placeholder="Comments" id="comments" value=" <?php echo $comments; ?>">
                        <br>
                            </div></div>
                        <br><br>
                        <br>                        
                        <button class="btnsub" type="submit" name="submit" value="Add Feedback">Submit</button>
                        <button class="btnres" type="reset" value="reset">Reset</button>
                        <a href="updatecrimeview.php">Back to update</a><br>
                    </form>
            </div>
        </div>
    </div>  
</div>

<script>
    function myFunction() {
    // The document object is the root node of the HTML document.
    // Reset() method is used for resetting all the values of the form elements
    // The getElementById() method returns an element with a specified value /Get the element with the specified id:
    document.getElementById("form1").reset();
    }
    function validate() {
        //.value Captures the value 
        
        var fullName = document.getElementById("fullName").value;
        var officerId = document.getElementById("officerId").value;
        var stationCode = document.getElementById("stationCode").value;
        var mobile = document.getElementById("mobile").value;
        var id_number = document.getElementById("id_number").value;
        var residency = document.getElementById("residency").value;
        var location = document.getElementById("location").value;
        var comments = document.getElementById("comments").value;
        var date_incident = document.getElementById("date_incident").value;

    //The focus() method gives focus to an element
    //The equality operator (==)
    //The alert() method displays an alert box with a message and an OK button

        if (fullName == "") {
        alert("Please Enter the Full Names");
        document.getElementById("fullName").focus();
        return false;
        }     
        if (officerId == "") {
        alert("Please Enter the Officer ID");
        document.getElementById("officerId").focus();
        return false;
        }
        if (stationCode == "") {
        alert("Please Enter the Station Code");
        document.getElementById("stationCode").focus();
        return false;
        }
        if (id_number == "") {
        alert("Please Enter the ID Number");
        document.getElementById("id_number").focus();
        return false;
        }
        if (residency == "") {
        alert('Please Enter Your Residency');
        document.getElementById("residency").focus();
        return false;
        }
    //Validating the OBID 
    // (isNAN) Checks if Not-A-Number 
        if (isNaN(id_number)) {
        alert("ID number  must be a number");
        document.getElementById('id_number').focus();
        return false;
        }

        if (isNaN(officerId)) {
        alert("Officer Id  must be a number");
        document.getElementById('officerId').focus();
        return false;
        }

        if (isNaN(mobile)) {
        alert("You must enter a valid mobile number");
        document.getElementById('mobile').focus();
        return false;
        }
        if (mobile.length > 10 || mobile.length < 10){
        alert("You must enter a valid mobile number");
        document.getElementById('mobile').focus();
        return false;
        }

      //Whether it is of the format dd-mm-yyyy and also if it is empty( Implied)
      //indexOf() method is used to search the specified element in the given array
      //return -1 if element is not found
    if (date_incident.indexOf("-") == -1) {
        alert("Date must be entered and of the format (dd-mm-yyyy)");
        document.getElementById("date_incident").focus();
        return false;
    }
      //The split() method divides a String into an ordered list of substrings, puts these substrings into an array, and returns the array
    comps = date_incident.split("-");

      //Ensuring the date components are of correct length
      //[] get the index position of a character in a set
      //counting starts from 0
    if (comps[0].length < 1 || comps[1].length < 1 || comps[2].length < 4) {
        alert("Date must be of the format (dd-mm-yyyy)");
        document.getElementById("date_incident").focus();
        return false;
    }
      //To check date are numbers we use global JavaScript function isNaN()

    if (isNaN(comps[0]) || isNaN(comps[1]) || isNaN(comps[2])) {
        alert("Date components must be intergers and must be of the format(dd-mm-yyyy)");
        document.getElementById("date_incident").focus();
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
        console.log("Form is being submitted", event);
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