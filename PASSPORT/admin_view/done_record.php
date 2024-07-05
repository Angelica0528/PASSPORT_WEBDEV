<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare an update statement to mark the record as done
    $sql = "UPDATE users SET status = 'done' WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Record marked as done successfully, then redirect
        $stmt->close();
        $conn->close();
        header("Location: done_users.php"); // Redirect back to admin view
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
} else {
    echo "Invalid or missing ID parameter";
}
?>
