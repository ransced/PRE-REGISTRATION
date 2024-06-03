<?php
session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $originalStudentId = $_POST['originalStudentId']; // Original Student ID
    $firstname = $_POST['firstName'];
    $middlename = $_POST['middleName'];
    $surname = $_POST['surname'];
    $studentId = $_POST['studentId']; // New Student ID
    $emailAddress = $_POST['emailAddress'];
    $program = $_POST['program'];
    $year = $_POST['year'];
    $section = $_POST['section'];
    $status = $_POST['status'];

    if (!empty($emailAddress) && !empty($studentId)) {
        $query = "UPDATE stud_details SET 
                    fname='$firstname', 
                    mname='$middlename', 
                    lname='$surname', 
                    student_id='$studentId', 
                    email='$emailAddress', 
                    program='$program', 
                    year='$year', 
                    section='$section', 
                    status='$status' 
                  WHERE student_id='$originalStudentId'";
        mysqli_query($conn, $query);
        echo "<script type='text/javascript'>alert('Successfully updated');</script>";
        header("Location: student.php");
        exit();
    } else {
        echo "<script type='text/javascript'>alert('Please enter some valid information');</script>";
        header("Location: student.php");
        exit();
    }
}
?>