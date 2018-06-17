<?php
if(isset($_POST['email'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname']; 
    $email = $_POST['email']; 
    $enquiretype = $_POST['enquiretype'];
    $enquiredetails = $_POST['enquiredetails']; 

    //Validate fields open
    $error_message = "";
    $email_exp = '/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/';
    $string_exp = "/^[A-Za-z .'-]+$/";
  
    if(!preg_match($email_exp,$email)) {
      $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }
   
    if(!preg_match($string_exp,$fname)) {
      $error_message .= 'The First Name you entered does not appear to be valid.<br />';
    }
   
    if(!preg_match($string_exp,$lname)) {
      $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
    }
   
    if(strlen($enquiredetails) < 2) {
      $error_message .= 'The Enquire Details you entered do not appear to be valid.<br />';
    }
   
    if(strlen($error_message) > 0) {
      died($error_message);
    }
    //Validate fields close

    //DB Storage open
    $servername = "localhost";
    $username = "id6218749_vikram";
    $password = "vikramxyz";
    $dbname = "id6218749_enquireform";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //Prevent for SQL injection
    $fname = mysqli_real_escape_string($con,$fname);
    $lname = mysqli_real_escape_string($con,$lname);
    $email = mysqli_real_escape_string($con,$email);
    $enquiretype = mysqli_real_escape_string($con,$enquiretype);
    $enquiredetails = mysqli_real_escape_string($con,$enquiredetails);

    $sql = "INSERT INTO EnquireForm (fname, lname, email, enquiretype, enquiredetails)
    VALUES ('$fname', '$lname', '$email', '$enquiretype', '$enquiredetails')";

    if($conn->query($sql) === TRUE) {
        echo "Thank you for Enquire. We will be in touch with you very soon.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    //DB Storage close
}    
?>