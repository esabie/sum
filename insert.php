<?php
if(isset($_POST['submit'])){
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$number=$_POST['number'];
$password=$_POST['password'];
}

$host="localhost";
$dbUsername="esabie";
$dbPassword="password";
$dbname="signup";

//create connection
$con =  new mysqli($host, $dbUsername, $dbPassword, $dbname);

if (mysqli_connection_error()) {
    die('Connect Error('. mysqli_connection_errno().')'. mysqli_connection_error());
}else {
    $SELECT = "SELECT email From Register Where email = ? Limit 1";
    $INSERT = "INSERT Into Register (fname, lname, number, email, password) values(?,?,?,?,?)";

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
}
?>