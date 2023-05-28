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
// $_POST is a global variable which is used to collect form data from an HTML form with method="post"
if(isset($_POST[ 'submit'])) 
{ 
    
    $occurrenceId = $_POST['occurrenceId'];
    $stationCode = $_POST['stationCode'];
    $officerId = $_POST['officerId'];
    $casename = $_POST['casename'];
    $crimetype = $_POST['crimetype'];
    $casestatus = $_POST['casestatus'];

    //Changing the date into Y-m-d
    $allocationDate = date('Y-m-d', strtotime($_POST['allocationDate']));
    $sql = "INSERT INTO cases (occurrenceId,stationCode,officerId,casename,crimetype,casestatus,allocationDate)
    VALUES('$occurrenceId','$stationCode','$officerId','$casename', '$crimetype', '$casestatus', '$allocationDate')";
    
  //"mysqli_query()" Performs a query on a database // Executes query
    $result = mysqli_query($con, $sql);
  //Check condition if query run successfully

    if ($result) {
    echo "<script>
        alert('Case Allocated Successfully!');
        </script>";
    } else {
        echo "<script>
        alert('Case Not Allocated !');
        </script>";
    }
}

//Automation
$date = date('d-m-Y');
$usersdata = mysqli_query($con, "SELECT * FROM users WHERE username = '".$_SESSION['user']."' ");
$row=mysqli_fetch_assoc($usersdata);

$id= $row['id'];

//Check for Occurrence Id
if(isset($_POST[ 'load'])) 
{ 
    $occurrenceId = $_POST['occurrenceId'];
$occ = mysqli_query($con, "SELECT * FROM occurrences WHERE id='".$occurrenceId."'");

    if (!$occ)
    {
        die('Error: ' . mysqli_error($con));
    }

if(mysqli_num_rows($occ) > 0){
    echo 'Occurrence Exists!';
}else{
    echo 'Occurrence Does not exist !';
}}
?>

<!-- DOCTYPE "document type the browser to expect" 
//language of text content on the web.-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Allocate Case</title>
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
                    <H2>Allocate Case </H2>
                </div>
                
                <div class="wrap"> 
    <!--
        The form element represents a collection of form-associated elements, 
        some of which can represent editable values that can be submitted to a server for processing.
        The input element represents a typed data field, usually with a form control to allow the user to edit the data.
    post: form data are included in the body of the form and sent to the server.
    get: form data are appended to the action attribute URI with a '?' as separator, and the resulting URI is sent to the server. Use this method when the form has no side-effects and contains only ASCII characters.
    -->
                <form method="post" id="form1" >
                
                <div class="dbl-field">
                            <div class="field">
                        <label for="occurrenceId">Occurence ID</label> &nbsp; <button type="btn" name="load" value="load">Search</button>
                        <br>
                        <input type="text" class="form-control" name="occurrenceId" id="occurrenceId" placeholder="Occurence ID number" id="occurrenceId">
                        <br><br>
                        
                            </div>
                        <br>
                            <div class="field">
                        <label for="stationCode">Station Code</label>
                        <br>
                        <input type="text" class="form-control" name="stationCode" placeholder="Current Station Code" id="stationCode" value="<?php echo $_SESSION["stationcode"]?>">
                        <br><br>
                            </div></div>
                            <br>

                            <div class="dbl-field">
                            <div class="field">
                        <label for="officerId">Enter Officer ID:</label>
                        <br>
                        <input type="text" class="form-control" name="officerId" id="officerId" placeholder="Officer to be allocated ID" id="officerId">
                        <br><br>
                            </div>
                        <br>

                            <div class="field">
                        <label for="casename">Case Name  </label>
                        <br>
                        <input type="text" class="form-control" name="casename" placeholder="Case Name" id="casename">
                            </div></div>
                            <br>
                            
                            <div class="dbl-field">
                            <div class="field">
                        <label for="crimetype">Crime Type</label>
                        <select id="crimetype" name="crimetype">
                            <option value="HOMICIDE">HOMICIDE</option>
                            <option value="GENDER">GENDER</option>
                            <option value="THEFT">THEFT</option>
                        </select> 
                            </div>

                            <div class="field">
                                                <label for="casestatus">Case Status</label>
                        <select id="casestatus" name="casestatus">
                        <option value="Allocated">ALLOCATE</option>
                        </select> 

                        </div>
                            <div class="field">
                            <label for="allocationDate"> Date Case Allocated:</label>
                        <br>
                        <input type="text" class="form-control"  name="allocationDate"  id="allocationDate" value="<?php echo $date;?>">
                            </div></div>
                            <br>
                        <button class="btnsub" type="submit" name="submit" >Submit</button>
                        <button class="btnres" type="clear" onclick="myFunction()">Reset</button>
                        <a href="index.php">Back to Home</a><br>
            </form>
            </div>
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
        var occurrenceId = document.getElementById("occurrenceId").value;
        var stationCode = document.getElementById("stationCode").value;
        var officerId = document.getElementById("officerId").value;
        var casename = document.getElementById("casename").value;
        var crimetype = document.getElementById("crimetype").value;
        var casestatus = document.getElementById("casestatus").value;
        var date = document.getElementById("allocationDate").value;

    //The focus() method gives focus to an element
    //The equality operator (==)
    //The alert() method displays an alert box with a message and an OK button

        if (occurrenceId == "") {
        alert("Please Enter the Occurrence Id");
        document.getElementById("occurrenceId").focus();
    //Prevent something from happening(SUBMIT)
        return false;
        }
                
        if (stationCode == "") {
        alert("Please Enter the Station Code");
        document.getElementById("stationCode").focus();
        return false;
        }

        if (officerId == "") {
        alert("Please Enter the Officer ID");
        document.getElementById("officerId").focus();
        return false;
        }

        if (casename == "") {
        alert('Please Enter the Case name');
        document.getElementById("casename").focus();
        return false;
        }
                

        //Validating the rank

        if (document.getElementById('crimetype').value == "") {
                alert('Please select crime type');
                document.getElementById('rank').focus();
                return false;

            }
        if (document.getElementById('casestatus').value == "") {
                alert('Please select Cases tatus');
                document.getElementById('casestatus').focus();
                return false;

            }
        //Validating the Occurrence ID
         // (isNAN) Checks if Not-A-Number 
        if (isNaN(occurrenceId)) {
        alert("Occurrence Id must be a number");
        document.getElementById('occurrenceId').focus();
        return false;
        }

        if (isNaN(officerId)) {
        alert("Officer Id  must be a number");
        document.getElementById('officerId').focus();
        return false;
        }

      //Whether it is of the format dd-mm-yyyy and also if it is empty( Implied)
      //indexOf() method is used to search the specified element in the given array
      //return -1 if element is not found
    if (date.indexOf("-") == -1) {
        alert("Date must be entered and of the format (dd-mm-yyyy)");
        document.getElementById("allocationDate").focus();
        return false;
    }
      //The split() method divides a String into an ordered list of substrings, puts these substrings into an array, and returns the array
    comps = date.split("-");
      //Ensuring the date components are of correct length
      //[] get the index position of a character in a set
      //counting starts from 0
    if (comps[0].length < 1 || comps[1].length < 1 || comps[2].length < 4) {
        alert("Date must be of the format (dd-mm-yyyy)");
        document.getElementById("allocationDate").focus();
        return false;
    }
      //to check date are numbers we use global JavaScript function isNaN()

    if (isNaN(comps[0]) || isNaN(comps[1]) || isNaN(comps[2])) {
        alert("Date components must be intergers and must be of the format(dd-mm-yyyy)");
        document.getElementById("allocationDate").focus();
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