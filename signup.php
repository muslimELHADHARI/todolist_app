<?php
$servername = "localhost";
$username = "root";         
$password = "123456789/*-";          
$dbname = "notes_db";  
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$uid = $_POST["uid"];
$pwd = $_POST["pwd"];
$sql = "INSERT INTO users (uid, pass) VALUES (?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $uid, $pwd); 
try{
if ($stmt->execute()) {
    echo "Account well created,SIGN IN <3";
    include 'index.html';
}}
catch (mysqli_sql_exception $e) {

    echo "Try another id ;)";
    include 'inscription.html';
}

$stmt->close();
$conn->close();
?>
