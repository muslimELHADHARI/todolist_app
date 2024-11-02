<?php
$servername = "localhost";
$username = "root";
$password = "123456789/*-";
$dbname = "notes_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$uid = $_POST["uid"];
$note = $_POST["ninput"];
$pwd = $_POST["pwd"];
$sql = "INSERT INTO notes (uid,descr) VALUES (?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $uid, $note);
$stmt->execute();
$_SESSION['uid'] = htmlspecialchars($_POST['uid']);
$_SESSION['pwd'] = htmlspecialchars($_POST['pwd']);
include 'homepage.php';
?>
