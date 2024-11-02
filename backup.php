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

// Backup file name
$backupFile = 'notes_backup_' . date('Y-m-d_H-i-s') . '.sql';

// Get all table names from the database
$tables = [];
$result = $conn->query("SHOW TABLES");

if ($result) {
    while ($row = $result->fetch_array()) {
        $tables[] = $row[0];
    }
}

// Initialize the SQL script
$sqlScript = "";

// Loop through each table and generate the backup script
foreach ($tables as $table) {
    // Get the create table SQL statement
    $result = $conn->query("SHOW CREATE TABLE $table");
    $row2 = $result->fetch_row();
    $sqlScript .= "DROP TABLE IF EXISTS $table;\n";
    $sqlScript .= $row2[1] . ";\n\n";

    // Get the data from the table
    $result = $conn->query("SELECT * FROM $table");
    while ($row = $result->fetch_assoc()) {
        $sqlScript .= "INSERT INTO $table VALUES(";
        foreach ($row as $value) {
            $value = $value !== null ? '"' . $conn->real_escape_string($value) . '"' : 'NULL';
            $sqlScript .= $value . ",";
        }
        $sqlScript = rtrim($sqlScript, ',') . ");\n";
    }
    $sqlScript .= "\n";
}

// Save the backup to the file
if (!empty($sqlScript)) {
    if (file_put_contents($backupFile, $sqlScript)) {
        echo "Backup successful! File saved as: $backupFile";
    } else {
        echo "Error writing to backup file.";
    }
} else {
    echo "No tables found in the database.";
}

// Close the connection
$conn->close();
?>
