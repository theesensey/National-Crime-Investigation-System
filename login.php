<?php

//$log is the argument / contents we will send to the log file
function ncislogs($log){
    //check if the file exists or not 
    if(!file_exists('systemlogs\loginlogs.txt')){

        //if it doesnt exist create it in the folder //Function
        file_put_contents('systemlogs\loginlogs.txt','');

    }
    //Details to capture
    date_default_timezone_set('Africa/Nairobi'); //Function that sets the time zone
    $time = date('d/m/y H:i A',time()); // time()- The current time as a Unix timestamp 
    //$_SERVER holds information about headers, paths, and script locations 
    //REMOTE_ADDR Returns the IP address from where the user is viewing the current page 
    $ip = $_SERVER['REMOTE_ADDR']; //Client IP
    
    $logcontents = file_get_contents('systemlogs\loginlogs.txt'); //Grabbing existing contents in the log file
    //. because we are appending data
    $logcontents .="$ip \t $time \t $log \n";

    //Send back the contents to the file 
    file_put_contents('systemlogs\loginlogs.txt',$logcontents);
}

//Creates a session or Resumes the current one based on a session identifier 
session_start();

//Config with parameters
$server="localhost"; //"Localhost" refers to the local computer that a program is running on
$username="moturi";  // Specifies the MySQL username
$password="logmein"; // Specifies the MySQL password
$dbname="nationalcrimeinvestigation"; //Specifies the default database to be used


  // "mysqli_connect" Opens a new connection to the MySQL server
$con= mysqli_connect($server, $username, $password, $dbname);
  // ! (Logic)if $con is NOT true
if (!$con) {
    echo "Connection failed, Check Configuration!";}  

//isset is a function that takes any variable and see if it has already been assigned a value. Check if Login is set
if (isset($_POST['login'])) 
{
    //to ignore input that is not string //SQL INJECTION
    $username=mysqli_real_escape_string($con, $_POST['username']);
    $password=mysqli_real_escape_string($con, $_POST['password']);
    $password=md5($password);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
     //To run the query
    $run = mysqli_query($con, $query) or die(mysqli_connect_error());
    //mysqli_fetch_array() function is used to fetch rows from the database and store them as an array
    $row = mysqli_fetch_array($run);
    // Assosiative array / => access mechanism for arrays 
    $locations = [
        "OCPD" => "ocpd\index.php",
        "HGENDER" => "genderhead\index.php",
        "GENDER" => "gender\index.php",
        "HTHEFT" => "thefthead\index.php",
        "THEFT" => "theft\index.php",
        "HOMICIDE" => "homicide\index.php",];

    $stationcode= $_POST['stationcode'];
    //It returns true if both operands are true.
    //checking that the result has a column called department and then if it does it checks to see if the locations array has a key for that department
if( isset($row["department"]) && isset($locations[$row["department"]]) )
    {
        $_SESSION["user"] = $username;
        $_SESSION['stationcode'] = $stationcode;

        //Redirect to the page of the user
        header("location:".$locations[$row["department"]]);

        //Log message
        $log= " User: $username :Logged In Succesfully. Station Code:$stationcode" ;
        ncislogs($log);
    }else{
        echo "<script>
        alert('INVALID USERNAME OR PASSWORD!');
        </script>";
    }
    
}
?>
<!-- DOCTYPE "document type the browser to expect" 
//language of text content on the web.-->
<!DOCTYPE html>
<html lang="en">
<head>
    <!--System title displayed on the tab-->
    <title>Log In</title>
    <!--The link element allows authors to link their document to other resources.-->
    <link href="stylesheet.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="image/Arms.ico">
</head>

<style>
    /*Body section */
body {
    
    background-image: url('image/police1.jfif');
    background-repeat: no-repeat;  /* background-repeat Image shouldnt repeat after its been sized and positioned.*/
    background-attachment: fixed;  /*Whether the background images are fixed or can scroll */
    background-size: cover;
}
</style> <!-- Closing tag-->
<body >
    <div class="container">
        <div class="jumbotron">
        <h1>NATIONAL CRIME INVESTIGATION SYSTEM</h1>
            <hr>
            <form method="post"  id="form1">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" class="form-control" placeholder="username" id="username">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label><br>
                    <input type="password" name="password" class="form-control" placeholder="password" id="password" >
                </div>
                <div class="field">
                    <label for="stationcode">Station Code</label>
                    <select name="stationcode" id="stationcode">
                        <option value=""></option>
                        <option value="NBI01">Central Police Station</option>
                        <option value="NBI02">Donholm Police Station</option>
                        <option value="NBI03">Ruaraka Police Station</option>
                        <option value="NBI04">Pangani Police Station</option>
                        <option value="NBI05">Gigiri Police Station</option>
                        <option value="NBI06">Starehe Police Division Station</option>
                        <option value="MSA01">Nyali Police Station</option>
                        <option value="MSA02">Changamwe Police Station</option>
                        <option value="MSA03">Mshomoroni Police Station</option>
                        <option value="MSA04">Bamburi Police Station</option>
                </select>
                </div>
                <br>

                <button type="submit" name="login" value="login" class="btn btn-lg btn-primary btn-block" >Log In</button>
                <br>
                <a href="index.php">Back to home</a><br>
                <a href="forgot.php">Forgot password</a>
                
            </form>
        </div>
    </div>

    <script>
        
    function validate() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

      //checks empty field 
    if (username == "") {
        alert('Enter username');
        document.getElementById('username').focus();
        return false;
}
    if (password == "") {
        alert('Enter password');
        document.getElementById('password').focus();
        return false;
    }

    if (document.getElementById('stationcode').value == "") {
                alert('Please select a police station');
                document.getElementById('stationcode');
                return false;
            }

}
    //Select the form 
    var form = document.getElementById("form1");

    //Validate the form before submitting it to the backend
    // Attach an event listener to the submit event
    // The submit event is called before a form is submitted
    // the event (in this case submit)
    form.addEventListener("submit", function(event) {
        console.log("Form is being submitted", event);
        //Validate our form 
        var result = validate();
        if (result == false) {
          //There is an error if result is false

          //Prevent the default action of the form(by default a form submits so we want to disable that for now)
        event.preventDefault();
        }
})
</script>
</body>
</html>
