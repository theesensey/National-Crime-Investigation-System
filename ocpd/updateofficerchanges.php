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
$sql= "SELECT * FROM users WHERE id=$id";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
//get from table and display in fields

$row=mysqli_fetch_assoc($result);

    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $username = $row['username'];
    $stationCode = $row['stationCode'];
    $mobile = $row['mobile'];
    $county = $row['county'];
    $department = $row['department'];
    $rank = $row['rank'];

if(isset($_POST['submit'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $stationCode = $_POST['stationCode'];
    $mobile = $_POST['mobile'];
    $county = $_POST['county'];
    $department = $_POST['department'];
    $rank = $_POST['rank'];

$sql="UPDATE users SET   firstName='$firstName',lastName='$lastName',
                        username='$username',stationCode='$stationCode',
                        mobile='$mobile',county='$county',department='$department',rank='$rank'
WHERE id=$id";

//to execute query
$result=mysqli_query($con,$sql);
//check condition if query run successfully
if($result){
    //Log message
    $log= " ".$_SESSION['user']." made changes to officer $id ";

    ncislogs($log); 

   // echo "Updated successfully";
   //after update redirects to table view
    header("refresh:0.5;url=../ocpd/updateofficerview.php");
    echo "<script>
        alert('Officer Details Updated Successfully!');
        </script>";
}else{
        die(mysqli_error($con));
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
<style>/*Internal css */
.form-control {
    width: 70%;
}

.form .dbl-field {
    /*
    The justify-content property aligns the flexible container's items when the items do not use all available space on the main-axis (horizontally).
    Align-items: center; (The align-items property specifies the default alignment for items inside the flexible container.)
    */
    display: flex;
    margin-bottom: 13px;
    align-items: center;
    justify-content: space-between;
}

.dbl-field .field {
    /*
    The position property specifies the type of positioning method used for an element 
    (static, relative, absolute, fixed, or sticky).
    */
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
                    <H2>Update Officer </H2>
                </div><br>
                <div class="wrap"> 

            <form id="form1" method="post">
            <div class="dbl-field">
                            <div class="field">
                        <label for="firstName">First Name</label> 
                        <br>
                        <input type="text" class="form-control" name="firstName" placeholder="Your first name" id="firstName" value="<?php echo $firstName; ?>">
                        <br><br> 
                            </div>
                            <div class="field">
                        <label for="lastName">Last Name</label>
                        <br>
                        <input type="text" class="form-control" name="lastName" placeholder="Your last name" id="lastName"  value="<?php echo $lastName; ?>">
                        <br><br>
                            </div>
                        </div>
                        <br>
                        
                        <div class="dbl-field">
                            <div class="field">
                        <label for="username">Username</label>
                        <br>
                        <input type="text" class="form-control" name="username" placeholder="Your preffered username" id="username" value="<?php echo $username; ?>">
                        <br><br>
                            </div>
                        </div>
                        <br>

                        <div class="dbl-field">
                            <div class="field">
                        <label for="stationCode">Enter your Station Code:</label>
                        <br>
                        <input type="text" class="form-control" name="stationCode" placeholder="Your station code" id="stationCode" value="<?php echo $stationCode; ?>">
                        <br><br>
                            </div>
                            <br>
                            <div class="field">
                        <label for="mobile">Enter Phone Number</label>
                        <br>
                        <input type="text" class="form-control" name="mobile" placeholder="Your mobile number"  id="mobile" value="<?php echo $mobile; ?>">
                        <br><br>
                            </div>
                        </div>
                        <br>

                        <div class="dbl-field">
                            <br>
                            <div class="field">
                        <label for="rank">Rank:</label>
                        <select id="rank" name="rank">
                        <option value="<?php echo $rank; ?>"><?php echo $rank; ?></option>
                        <option value="Chief Inspector">Chief Inspector</option>
                        <option value="Inspector">Inspector </option>
                        <option value="Senior Sergeant">Senior Sergeant</option>
                        <option value="Corporal">Corporal</option>
                        <option value="Sergeant ">Sergeant </option>
                        </select> 
                        <br>
                        </div>
                        </div>
                        

                        <div class="dbl-field">
                            <div class="field">
                        <label for="department">Department:</label>
                        <select id="department" name="department">
                        <option value="<?php echo $department; ?>"><?php echo $department; ?></option>
                        <option value="OCPD">OCPD</option>
                        <option value="GENDER">GENDER</option>
                        <option value="GENDER">HGENDER</option>
                        <option value="THEFT">THEFT</option>
                        <option value="HTHEFT">HTHEFT</option>
                        <option value="HOMOCIDE">HOMOCIDE</option>
                        </select> 
                        <br>
                            </div>
                            <div class="field">
                        <label for="county">County:</label>
                        <select id="county" name="county">
                        <option value="<?php echo $county; ?>"><?php echo $county; ?> </option>
                        <option value="Nairobi">Nairobi</option>
                        <option value="Mombasa">Mombasa</option>
                        <option value="Kisumu">Kisumu</option>
                        </select> 
                        <br><br>
                        </div></div>

                        <button class="btnsub" type="submit" name="submit" >Submit</button>
                        <button class="btnres" type="reset" value="reset">Reset</button>
                        <a href="updateofficerview.php">Back to Officer View</a><br>
                        </div>

    </div>
</form>
</div>
    </div>
</div>
<script>
      // The document object is the root node of the HTML document.
    function myFunction() {
    // Reset() method is used for resetting all the values of the form elements
        document.getElementById("form1").reset();
    }
    // The getElementById() method returns an element with a specified value /Get the element with the specified id:
    function validate() {
        //.value Captures the value 
        var firstname = document.getElementById("firstname").value;
        var lastname = document.getElementById("lastname").value;
        var mobile = document.getElementById("mobile").value;
        var username = document.getElementById("username").value;
        var stationcode = document.getElementById("stationcode").value;
        var officerid= document.getElementById("officerid").value;
        var rank = document.getElementById("rank").value;
        var department = document.getElementById("department").value;
        var password = document.getElementById("password").value;

    //Forward Slash  Forward slash character is used to denote the boundaries of the regular expression
    //(^-Start of string or line $-End of string, or end of line)
    //([]-Match anything thats contained inside the bracket)
        var pass = /^[A-Za-z0-9@_#]$/;

    //The focus() method gives focus to an element
    //The equality operator (==)
    //The alert() method displays an alert box with a message and an OK button

        if (firstName == "") {
        alert("Please Enter the First name");
    //Highlight that input box
        document.getElementById("firstName").focus();
    //Prevent something from happening(SUBMIT)
        return false;
        }
        if (lastName == "") {
        alert('Please Enter the last name');
        document.getElementById("lastName").focus();
        return false;
        }
        
        if (username == "") {
        alert("Please Enter the Username");
        document.getElementById("username").focus();
        return false;
        }

        if (stationCode == "") {
        alert("Please Enter the Station Code");
        document.getElementById("stationCode").focus();
        return false;
        }
        //Validating the ranl

        if (document.getElementById('rank').value == "") {
                alert('Please select rank');
                document.getElementById('rank').focus();
                return false;

            }
        if (document.getElementById('department').value == "") {
                alert('Please select department');
                document.getElementById('department').focus();
                return false;

            }

        if (isNaN(mobile)) {
        alert("You must enter a valid mobile number");
        return false;
        }
        if (mobile.length > 10 || mobile.length < 10){
        alert("You must enter a valid mobile number");
        return false;
        }


    }
      //Select the form from the DOM(Document Object Model)
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