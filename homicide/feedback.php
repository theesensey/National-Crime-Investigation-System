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
    

// ISSET Determine if a variable is declared and is different than NULL
// $_POST variable which is used to collect form data after submitting an HTML form with method="post".

if (isset($_POST['submit'])) {

    $caseid = $_POST['caseid'];
    $feedback = $_POST['feedback'];


$sql = "INSERT INTO feedback(caseid,feedback)
VALUES('$caseid','$feedback')";

  // Mysqli_query() function performs a query against a database
    $result = mysqli_query($con, $sql);

  //check condition if query run successfully
    if ($result) {
    header("refresh:80;url=../homicide/index.php"); // Refreshes after 20 seconds
    echo "<script>
        alert('Feedback posted successfully!');
        </script>";
    } else {
    die(mysqli_error($con));}
}

?>
<!-- DOCTYPE this is the document type "document type the browser to expect" -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gender</title>
        <link href="../stylesheet.css" rel="stylesheet" type="text/css"> 
    <link rel="shortcut icon" href="../Arms.ico"> 
</head>
<style>
    /*Internal Css */
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
                    <H2>Feedback </H2>
                </div>
                
                <div class="wrap"> 
    <!--
        The form element represents a collection of form-associated elements, 
        some of which can represent editable values that can be submitted to a server for processing.
        The input element represents a typed data field, usually with a form control to allow the user to edit the data.
    -->
                <form method="post" id="form1">
                        <div class="dbl-field">
                            <div class="field">
                        <label for="caseid">Case ID</label> 
                        <br>
                        <input type="text" class="form-control" name="caseid" placeholder="Enter case id" id="caseid">
                        <br><br> 
                            </div>
                            <br>
                    
                            <div class="field">
                        <label for="feedback">Feedback</label>
                        <br>
                        <input type="text" class="form-control" name="feedback" placeholder="Enter feedback here" id="feedback">
                        <br><br>
                            </div>
                            <br>

                        <button class="btnsub" type="submit" name="submit" value="Add Feedback">Submit</button>
                        <button class="btnres" type="reset" value="reset">Reset</button>
                        <a href="index.php">Back to Home</a><br>
                        
                    </form></div>
            </div>

        </div>
    </div>
    <script>
    // The getElementById() method returns an element with a specified value 
    // Get the element with the specified id:
    function validate() {
        var caseid = document.getElementById("caseid").value;
        var feedback = document.getElementById("feedback").value;

    //The focus() method gives focus to an element
    //The equality operator (==)
    //The alert() method displays an alert box with a message and an OK button 
        if (caseid == "") {
        alert("Please Enter the Case Id");
        document.getElementById("caseid").focus();
        return false;
        }
                
        if (feedback == "") {
        alert("Please Enter the Feedback");
        document.getElementById("feedback").focus();
        return false;
        }

          //Validating the case ID
          // (isNAN) Checks if Not-A-Number 
        if (isNaN(caseid)) {
        alert("CaseId must be a number");
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