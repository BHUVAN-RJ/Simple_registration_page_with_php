<?php
if(isset($_POST['Submit'])){
    if(isset($_POST['firstname']) && isset($_POST['middlename']) && isset($_POST['lastname']) && isset($_POST['course']) && isset($_POST['gender']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['pass'])){

    

$fname = $_POST['firstname'];
$mname = $_POST['middlename'];
$lname = $_POST['lastname'];
$course = $_POST['course'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['pass'];

$host = "localhost";
$dbUsername = "bhuvan";
$dbPassword = "Bhuvanrj@007";
$dbName = "dbmsmini";

$conn = new mysqli($host,$dbUsername,$dbPassword,$dbName);

if($conn->connect_error){
    die('fuck could not connect to database');
}
else{
$Select = "SELECT email FROM formin WHERE email = ? LIMIT 1";
$Insert = "INSERT INTO formin(fname, mname, lname, course, gender, phone, email, password) values(?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($Select);
$stmt->bind_param("s",$email);
$stmt->execute();
$stmt->bind_result($resultEmail);
$stmt->store_result();
$stmt->fetch();
$rnum = $stmt->num_rows;

if($rnum == 0){
    $stmt->close();
    $stmt = $conn->prepare($Insert);
    $stmt->bind_param("sssssiss",$fname, $mname, $lname, $course, $gender, $phone, $email, $password);
    if($stmt->execute()){
        echo "new record created seccussfully";
    }
    else{
        echo $stmt->error;

    }
}
else{
    echo "Someone else has registered using this mail";
}

$stmt->close();
$conn->close();

}
}
else{
    echo "All fields are required";
    die();
}}
    
else{
    echo "Submit button is not set";
}
?>