<?php
session_start();
include("connection.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $course_id = $_GET['id'];
    
    // Update the course status to archived
    $query = "UPDATE courses SET archived = 1 WHERE id = $course_id";
    
    if ($conn->query($query) === TRUE) {
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
} else {
    echo "error: invalid id";
}
?>
