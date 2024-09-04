<?php
// Connect to the database
$db = new mysqli("localhost", "root", "", "discoteca");

// Check for connection errors
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Retrieve and sanitize input
$idArtista = (int)$_POST['idArtista'];
$nome = $db->real_escape_string($_POST['Nome']);

// Prepare the SQL statement
$query = "UPDATE artista SET Nome = ? WHERE idArtista = ?";

// Create a prepared statement
$stmt = $db->prepare($query);

if ($stmt) {
    // Bind parameters
    $stmt->bind_param('si', $nome, $idArtista);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect if successful
        header('Location: artistas.php');
        exit;
    } else {
        // Handle execution error
        echo "Error executing query: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle preparation error
    echo "Error preparing query: " . $db->error;
}

// Close the database connection
$db->close();
?>
