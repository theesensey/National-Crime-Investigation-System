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
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $stationCode = $_POST['stationCode'];
    $mobile = $_POST['mobile'];
    $county = $_POST['county'];
    $department = $_POST['department'];
    $rank = $_POST['rank'];
    $password = $_POST['password'];
    $password= md5($password);

    $username=htmlspecialchars($username);

    $sql = "INSERT INTO users (firstName,lastName,username,stationCode,mobile,county,department,rank,password)
    VALUES('$firstName', '$lastName', '$username', '$stationCode', '$mobile','$county', '$department', '$rank', '$password')";

    
  // Holds result of running the query on the database
    $result = mysqli_query($con, $sql); 
  //Result set is a set of rows from a database/ We want to run through them to print as a report or filter
    if ($result) {
        header("refresh:80; url=../ocpd/viewofficers.php");  //Redirect after showing message
        echo "<script>
        alert('New Officer Added!');
        </script>";
        
    } 
}
?>
<!-- Browser expects html 5-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Officer</title>
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
                    <H2>Add New Officer </H2>
                </div>
                
                <div class="wrap"> 
                <form method="post" id="form1">
                        <div class="dbl-field">
                            <div class="field">
                        <label for="firstName">First Name</label> 
                        <br>
                        <input type="text" class="form-control" name="firstName" placeholder="Your first name" id="firstName">
                        <br><br> 
                            </div>
                            <div class="field">
                        <label for="lastName">Last Name</label>
                        <br>
                        <input type="text" class="form-control" name="lastName" placeholder="Your last name" id="lastName" >
                        <br><br>
                            </div>
                        </div>
                        <br>
                        
                        <div class="dbl-field">
                            <div class="field">
                        <label for="username">Username</label>
                        <br>
                        <input type="text" class="form-control" name="username" placeholder="Your preffered username" id="username">
                        <br><br>
                            </div>
                        </div>
                        <br>
                        <div class="dbl-field">
                            <div class="field">
                        <label for="stationCode">Enter your Station Code:</label>
                        <br>
                        <input type="text" class="form-control" name="stationCode" placeholder="Your station code" id="stationCode">
                        <br><br>
                            </div>
                            <br>
                            <div class="field">
                        <label for="mobile">Enter Phone Number</label>
                        <br>
                        <input type="text" class="form-control" name="mobile" placeholder="Your mobile number"  id="mobile">
                        <br><br>
                            </div>
                        </div>
                        <br>

                        <div class="dbl-field">
                            <div class="field">
                        <label for="password">Password</label>
                        <br>
                        <input type="password" class="form-control" name="password" placeholder="Password" id="password">
                        <br><br>
                            </div>
                            <br>

                            
                            <div class="field">
                        <label for="rank">Rank:</label>
                        <select id="rank" name="rank">
                        <option value=""></option>
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
                        <label for="department">Criteria:</label>
                        <select id="department" name="department">
                        <option value=""></option>
                        <option value="OCPD">OCPD</option>
                        <option value="GENDER">GENDER</option>
                        <option value="HGENDER">HGENDER</option>
                        <option value="RECORDS">THEFT</option>
                        <option value="HTHEFT">HTHEFT</option>
                        <option value="HOMOCIDE">HOMOCIDE</option>
                        </select> 
                        <br>
                            </div>
                            <div class="field">
                        <label for="county">County:</label>
                        <select id="county" name="county">
                        <option value=""></option>
                        <option value="Nairobi">Nairobi</option>
                        <option value="Mombasa">Mombasa</option>
                        <option value="Kisumu">Kisumu</option>
                        </select> 
                        <br><br>
                        </div></div>

                        <button class="btnsub" type="submit" name="submit" >Submit</button>
                        <button class="btnres" type="reset" value="reset">Reset</button>
                        <a href="update.php">Back to Update</a><br>
                        
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
    // The getElementById() method returns an element with a specified value /Get the element with the specified id:
    function validate() {
        //.value Captures the value 
        var firstName = document.getElementById("firstName").value;
        var lastName = document.getElementById("lastName").value;
        var mobile = document.getElementById("mobile").value;
        var username = document.getElementById("username").value;
        var stationCode = document.getElementById("stationCode").value;
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
                //Validating the userID

                if (isNaN(mobile)) {
        alert("You must enter a valid mobile number");
        return false;
        }
        if (mobile.length > 10 || mobile.length < 10){
        alert("You must enter a valid mobile number");
        return false;
        }

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

        //Validating the rank

        if (document.getElementById('rank').value == "") {
                alert('Please select rank');
                document.getElementById('rank');
                return false;

            }
        if (document.getElementById('department').value == "") {
                alert('Please select department');
                document.getElementById('department').focus();
                return false;

            }
        if (document.getElementById('county').value == "") {
                alert('Please select county');
                document.getElementById('county').focus();
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