<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = "123456789/*-"; // Your MySQL password
$dbname = "notes_db"; // Your database name

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a file was uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['backup-file'])) {
    $file = $_FILES['backup-file']['tmp_name'];

    // Check if the file exists
    if (file_exists($file)) {
        // Read the SQL file
        $sql = file_get_contents($file);

        // Disable foreign key checks
        $conn->query("SET FOREIGN_KEY_CHECKS = 0;");

        // Execute the SQL queries
        if ($conn->multi_query($sql)) {
            do {
                // Store the first result set
                if ($result = $conn->store_result()) {
                    // Free the result set
                    $result->free();
                }
            } while ($conn->next_result());
            echo "Database restored successfully!";
        } else {
            echo "Error restoring database: " . $conn->error;
        }

        // Re-enable foreign key checks
        $conn->query("SET FOREIGN_KEY_CHECKS = 1;");
    } else {
        echo "The file does not exist.";
    }
} else {
    echo "No file uploaded.";
}

// Close the connection
$conn->close();
?>
