<?php

$fname=$_POST['first_name'];
$lname=$_POST['last_name'];
$email=$_POST['email'];
$number=$_POST['number'];
$password=$_POST['password'];

$host="localhost";
$dbUsername="eosabie";
$dbPassword="password";
$dbname="signup";

//create connection
$con =  new mysqli($host, $dbUsername, $dbPassword, $dbname) or die("Connection Error!");

// Create connection and Check connection
//$conn = mysqli_connect($servername, $username, $password) or die("Unable to Connect");

$fnameErr = $lnameErr = $emailErr  = $numberErr = $passErr = " ";
    
if(isset($_POST['submit'])){
    }

    




    $SELECT = "SELECT email From signup Where email = ? Limit 1";
    $INSERT = "INSERT Into signup (first_name, last_name, number, email, password) values(?,?,?,?,?)";
if (mysqli_query($con ,$SELECT ,  $INSERT )){
    echo header("refresh:1;url=home.html");
}

else{
    echo "Invalid details";
}
    //prepare statement
    $stmt =  $conn->prepare($SELECT);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum= $stmt->num_rows;

    if ($rnum==0) {
        $stmt ->close();

        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sssss", $fname, $lname, $number, $email, $password);
        $stmt->execute();
        echo "New record submitted";
    } else {
        echo "Account already exists, kindly login";
    }
    $stmt->close();
    $conn->close();

?>