<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take My Notes</title>
    <link rel="stylesheet" type="text/css" href="vint.css">
</head>
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
$pwd = $_POST["pwd"];

$sql = "SELECT * FROM users WHERE uid='$uid' AND pass='$pwd'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row != null) {
?>
<body>
<script>
     function logout(){
        window.location.href = "index.html";
}
</script>
    <header>
        <h1>TODO LIST APP</h1>
        <h2>USERID:<?php echo $uid ?></h2>
        <button onclick="logout()">Logout</button>
    </header>
    <section>
        <h2>Your Notes</h2>
        <ul id="note-list">
        <?php
$sql = "SELECT * FROM notes WHERE uid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $uid); 
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<li id='note-{$row['nid']}'>" . htmlspecialchars($row['descr']) . "</li>";
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const doneButtons = document.querySelectorAll('.done-btn');
    doneButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            const noteId = this.getAttribute('id');
            // Send an Ajax request to mark the note as done
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_note.php', true); // This file will handle the backend logic
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('note_id=' + noteId);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Remove the note from the list on success
                    const noteElement = document.getElementById('note-' + noteId);
                    const noteElementbtn = document.getElementById(noteId);
                    console.log(noteElement);
                    console.log(noteElementbtn);
                    if (noteElement) {
                        noteElement.remove(); // Remove the note visually from the page
                        noteElementbtn.remove();
                    }
                }
            };
        });
    });
});
</script>
<?php
    echo "<button class='done-btn' id='{$row['nid']}'>Done</button>";
}
?>
        </ul>
    </section>

    <section>
        <form name="f2" method="POST" action="add-note.php">
        <h2>Add a New Note</h2>
        <input type="text" name="uid" value=<?php echo $uid ?> hidden >
        <input type="text" name="pwd" value=<?php echo $pwd ?> hidden >
        <input type="text" name="ninput" placeholder="Write your note here">
        <input type="Submit" value="Add note"></input>
</form>
    </section>
</body>
<?php
} 
else {
    echo "password erronée";
    include "index.html";
}

$conn->close();
?>
</html>
