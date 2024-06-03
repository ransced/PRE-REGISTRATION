<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $studentId = $data['studentId'];

    if (!empty($studentId)) {
        $query = "DELETE FROM stud_details WHERE student_id = '$studentId'"; // Adjust if you want to mark as archived instead of deleting
        if (mysqli_query($conn, $query)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false]);
    }
}
?>