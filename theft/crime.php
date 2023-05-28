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
if (isset($_POST['submit'])) {

$officerId = $_POST['officerId'];
$stationCode = $_POST['stationCode'];
$id_number = $_POST['id_number'];
$fullName = $_POST['fullName'];
$mobile = $_POST['mobile'];
$residency = $_POST['residency'];
//Changing the date into Y-m-d
$date_of_incident = date('Y-m-d', strtotime($_POST['date_of_incident']));
$crimelocation = $_POST['crimelocation'];
$crimetype = $_POST['crimetype'];
$description = $_POST['description'];
$comments = $_POST['comments'];



$sql = "INSERT INTO occurrences(officerId,stationCode,id_number,fullName,mobile,residency,date_of_incident,crimelocation,crimetype,description,comments)
        VALUES('$officerId','$stationCode','$id_number','$fullName','$mobile','$residency','$date_of_incident','$crimelocation','$crimetype','$description','$comments')";

     // Holds result of running the query on the database
$result = mysqli_query($con, $sql);
    //Check condition if query run successfully

if ($result) { 
    header("refresh:80;url=../theft/viewcrimes.php"); // Refreshes after 20 seconds and Redirects
    echo "<script>
    alert('Occurence Updated Succesfully!');
    </script>";
} else {
    //ends execution
    die(mysqli_error($con));
}
}


$usersdata = mysqli_query($con, "SELECT * FROM users WHERE username = '".$_SESSION['user']."' ");
$row=mysqli_fetch_assoc($usersdata);

$id= $row['id'];

?>
<!-- DOCTYPE "document type the browser to expect" 
//language of text content on the web.-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Crime</title>
    <!--Links the external css file to the document-->
        <link href="../stylesheet.css" rel="stylesheet" type="text/css"> 
    <link rel="shortcut icon" href="../Arms.ico"> 
</head>

<style>/*Internal css */
.form-control {
    width: 70%;
}

.form .dbl-field {
    /*
    The justify-content property aligns the flexible container's items when
    the items do not use all available space on the main-axis (horizontally).
    Align-items: center; (The align-items property specifies the default alignment 
    for items inside the flexible container.)
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
    Trust and communication are the most important values in a relationship for me. 
    Lying is a failure of both, and with this pattern established it's unlikely that either will be rebuilt.
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
                // Display / Show the session variable that was stored on login
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
            <li><a href="crime.php">Record Occurrence</a></li>
            <li><a href="progress.php">Progress</a></li>
            <li><a href="search.php">Search</a></li> 
            <li><a href="filter.php">Reports</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main_content">
            <div class="main_content">
                <div class="top">
                    <H2>Add New Occurrence </H2>
                </div>
                
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
                        <input type="text" class="form-control" name="fullName" placeholder="Your Full names" id="fullName">
                        <br><br>
                            </div>
                        </div>
                        
                        <div class="dbl-field">
                            <div class="field">
                        <label for="officerId">Enter Officer ID:</label>
                        <br>
                        <input type="text" class="form-control" name="officerId" placeholder="Enter Officer Id" id="officerId" value="<?php echo $id;?>"
                        <br><br>
                            </div>
                            <br>
                            <div class="field">
                        <label for="stationCode">Enter your Station Code:</label>
                        <br>
                        <input type="text" class="form-control" name="stationCode" placeholder="Your station code" id="stationCode" value="<?php echo $_SESSION["stationcode"];?>"
                        <br><br>
                            </div>
                        </div>
                        <br>

                        <div class="dbl-field">
                            <div class="field">
                            <label for="mobile">Enter Phone Number</label>
                        <br>
                        <input type="text" class="form-control" name="mobile" placeholder="Your mobile number" id="mobile">
                        <br><br>
                            </div>
                            <br>
                            <div class="field">
                        <label for="id_number">Enter ID Number</label>
                        <br>
                        <input type="text" class="form-control" name="id_number" placeholder="Enter Identification number" id="id_number">
                        <br><br>
                            </div>
                        </div>
                        <br>
                        <div class="dbl-field">
                            <div class="field">
                        <label for="residency">Residency</label>
                        <br>
                        <input type="text" class="form-control" name="residency" placeholder="Enter your residency" id="residency">
                        <br><br>
                            </div>
                            <br>
                            <div class="field">
                            <label for="date_of_incident"> Date of incident:</label>
                        <br>
                        <input type="text" class="form-control" placeholder="dd-mm-yyyy"  name="date_of_incident" id="date_incident">
                        <br><br>
                            </div>
                            </div>
                            <br>

                            <div class="dbl-field">
                            <div class="field">
                        <label for="crimelocation">Enter Crime Location</label>
                        <br>
                        <input type="text" class="form-control" name="crimelocation" placeholder="Enter Crime Location" id="location">
                        <br><br>
                            </div>

                            <div class="field">
                        <label for="crimetype">Crime Type</label>
                        <select id="crimetype" name="crimetype">
                        <option value=""></option>
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
                        <input type="text" class="form-control" name="description" placeholder="Description of the incident" id="description">
                        <br>
                            </div>
                            <div class="field">
                        <label for="comments">Officer comments</label>
                        <br>
                        <input type="text" class="form-control" name="comments" placeholder="Comments" id="comments">
                        <br>
                            </div></div>
                        <br><br>
                        <br>                        
                        <button class="btnsub" type="submit" name="submit" value="Add Feedback">Submit</button>
                        <button class="btnres" type="reset" value="reset">Reset</button>
                        <a href="index.php">Back to Home</a><br>
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
        var crimetype = document.getElementById("crimetype").value;
        var location = document.getElementById("location").value;
        var description = document.getElementById("description").value;
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
        if (location == "") {
        alert("Please Enter the Crime Location");
        document.getElementById("location").focus();
        return false;
        } 
        if (description == "") {
        alert("Please Enter the Crime Description In Detail");
        document.getElementById("description").focus();
        return false;
        }
        
        //Validating the crimetype
        if (document.getElementById('crimetype').value == "") {
                alert('Please select crime type');
                document.getElementById('rank');
                return false;
            }

        if (isNaN(id_number)) {
        alert("ID number  must be a number");
        return false;
        }

        if (isNaN(officerId)) {
        alert("Officer Id  must be a number");
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
      //to check date are numbers we use global JavaScript function isNaN()

    if (isNaN(comps[0]) || isNaN(comps[1]) || isNaN(comps[2])) {
        alert("Date components must be intergers and must be of the format(dd-mm-yyyy)");
        document.getElementById("date_incident").focus();
        return false;
    }
    //Date cannot be later than today
    //new Date() creates a new date object with the current date and time:
    var currentdate=new Date(); //Todays Date
    //Creating a date using the entered data
    var specifieddate=new Date();
    specifieddate.setFullYear(comps[2],comps[1]-1,comps[0]);//The function setFullYear Set the year(optionally also month and day yyyy,mm,dd)
    //Comparing the dates
    if(specifieddate>currentdate){
        alert("The date cannot be later than todays date.");
        return false; // return false is used to prevent the submission of the form if the entry of the form is unfilled i.e the date is unfiled.
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