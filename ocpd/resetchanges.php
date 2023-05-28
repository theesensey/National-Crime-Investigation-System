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
    $username = $row['username'];

if(isset($_POST['submit'])){

    $password = $_POST['password'];
    $password= md5($password);
    

$sql= "UPDATE users SET  password='$password'
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
    header("refresh:180;url=../ocpd/updateofficerview.php");
    echo "<script>
        alert('Password Changes Succesfully Successfully!');
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
                    <H2>Reset Password  </H2>
                </div><br>
                <div class="wrap"> 

            <form id="form1" method="post">
            <div class="dbl-field">
                            <div class="field">
                        <label for="username">User Name</label> 
                        <br>
                        <input type="text" class="form-control" placeholder="Your first name" id="username" value="<?php echo $username; ?>" readonly>
                        <br><br> 
                            </div>

                            <div class="field">
                        <label for="password">Password</label>
                        <br>
                        <input type="password" class="form-control" name="password" placeholder="Password" id="password">
                        <br><br>
                            </div>
                        <button class="btnsub" type="submit" name="submit" >Submit</button>
                        <a href="update.php">Back</a><br>
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

        var password = document.getElementById("password").value;
    //Forward Slash  Forward slash character is used to denote the boundaries of the regular expression
    //(^-Start of string or line $-End of string, or end of line)
    //([]-Match anything thats contained inside the bracket)
        var pass = /^[A-Za-z0-9@_#]$/;

    //The focus() method gives focus to an element
    //The equality operator (==)
    //The alert() method displays an alert box with a message and an OK button
        //check password field empty
        if (password == "") {
        alert("Please Enter the password");
        document.getElementById("password").focus();
        return false;
        }
        //
        if (password.length < 8 || password.match(pass)) {
        alert("Password must  atleast contain an uppercase,lowercase,number and any of the special symbols #,@,-");
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