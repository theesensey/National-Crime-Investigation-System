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


// ISSET Determine if a variable is declared...determine whether a variable is set or not
// $_POST is a global variable which is used to collect form data from an HTML form with method="post" Its an Array

if(isset($_POST[ 'submit'])) 
{ 
    $name = $_POST['name'];
    $stationCode = $_POST['stationCode'];
    $location = $_POST['location'];
    $county = $_POST['county'];
    $mobile = $_POST['mobile'];
    $category = $_POST['category'];
    $cells = $_POST['cells'];


    $sql = "INSERT INTO stations (name,stationCode,location,county,mobile,category,cells)
    VALUES('$name', '$stationCode','$location','$county','$mobile','$category','$cells')";

    
    // Holds result of running the query on the database
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    //check condition if query run successfully
    if ($result) {

    header("refresh:60;url=../ocpd/index.php");
    echo "<script>
    alert('New Station Added!');
    </script>";

    }
}
?>
<!-- DOCTYPE "document type the browser to expect" 
//language of text content on the web.-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>NCIS</title>
        <!--Links the external css file to the document-->
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
                <div class="top">
                    <H2>Add New Station </H2>
                </div>
                <div class="wrap"> 
                <form method="post" name="newstation" id="form1" >
                        <div class="dbl-field">
                            <div class="field">
                        <label for="name">Station name</label> 
                        <br>
                        <input type="text" class="form-control" name="name" placeholder="Police Station Name" id="name">
                        <br><br> 
                            </div>
                            <br>
                            <div class="field">
                        <label for="stationCode">Station code</label>
                        <br>
                        <input type="text" class="form-control" name="stationCode" placeholder="Police station code" id="stationCode" >
                        <br><br>
                            </div>
                        </div>
                        <br>
                        
                        <div class="dbl-field">
                            <div class="field">
                        <label for="location">Location</label>
                        <br>
                        <input type="text" class="form-control" name="location" placeholder="Location" id="location">
                        <br><br>
                            </div>
                            <br>
                        <div class="field">
                        <label for="county">County</label>
                        <br>
                        <input type="text" class="form-control" name="county" placeholder="County located" id="county">
                        </div>
                        <br>
                        <div class="field">
                        <label for="mobile">Mobile</label>
                        <br>
                        <input type="text" class="form-control" name="mobile" placeholder="Mobile" id="mobile">
                        </div>
                        <br>

                        <div class="dbl-field">
                            <div class="field">
                        <label for="category">Category</label>
                        <br>
                        <input type="text" class="form-control" name="category" placeholder="Category" id="category">
                        <br><br>
                            </div>
                            <br>
                        <div class="field">
                        <label for="cells">Cells</label>
                        <br>
                        <input type="text" class="form-control" name="cells" placeholder="Number of Cells" id="cells">
                        </div>
                        <br>

                        <button class="btnsub" type="submit" name="submit">Submit</button>
                        <button class="btnres" type="reset" value="reset">Reset</button>
                        <a href="update.php">Back to Update</a><br> 
                    </form></div>

            </div>

        </div>
    </div>
    <script>
              // The document object is the root node of the HTML document.
    function myFunction() {
    // Reset() method is used for resetting all the values of the form elements
        document.getElementById("form1").reset();
    }
    function validate() {
    // The getElementById() method returns an element with a specified value /Get the element with the specified id:
        var name = document.getElementById("name").value;
        var stationCode = document.getElementById("stationCode").value;
        var location = document.getElementById("location").value;
        var county = document.getElementById("county").value;
        var category = document.getElementById("category").value;
        var cells = document.getElementById("cells").value;

    //The focus() method gives focus to an element
    //The equality operator (==)
    //The alert() method displays an alert box with a message and an OK button

        if (name == "") {
        alert("Please Enter the Station name");
        document.getElementById("name").focus();
        return false;
        }
                
        if (stationCode == "") {
        alert("Please Enter the Station Code");
        document.getElementById("stationCode").focus();
        return false;
        }

        if (location == "") {
        alert('Please Enter the location');
        document.getElementById("location").focus();
        return false;
        }
        
        if (county == "") {
        alert("Please Enter the County");
        document.getElementById("county").focus();
        return false;
        }

        if (category == "") {
        alert("Please Enter the Station Category");
        document.getElementById("category").focus();
        return false;
        }

        if (isNaN(cells)) {
        alert("You must enter a Cell Number'");
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