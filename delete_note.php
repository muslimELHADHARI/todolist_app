<?php
$servername = "localhost";
$username = "root";
$password = "123456789/*-";
$dbname = "notes_db";
$conn = new mysqli($servername, $username, $password, $dbname);
    $note_id = intval($_POST['note_id']);
    // Prepare your delete query
    $sql = "DELETE FROM notes WHERE nid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $note_id);
    
    if ($stmt->execute()) {
        echo "Success"; // You can return a success message or JSON
    } else {
        echo "Error"; // Handle error if necessary
    }

?>
