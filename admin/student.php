<?php
session_start();
include("connection.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $firstname = $_POST['firstName'];
    $middlename = $_POST['middleName'];
    $surname = $_POST['surname'];
    $studentId = $_POST['studentId'];
    $emailAddress = $_POST['emailAddress'];
    $program = $_POST['program'];
    $year = $_POST['year'];
    $section = $_POST['section'];
    $status = $_POST['status'];

    if(!empty($emailAddress) && !empty($studentId)){
        $query = "INSERT INTO stud_details (fname, mname, lname, student_id, email, program, year, section, status) VALUES ('$firstname', '$middlename', '$surname', '$studentId', '$emailAddress', '$program', '$year', '$section', '$status')";
        mysqli_query($conn, $query);
        echo "<script type='text/javascript'>alert('Successfully inserted');</script>";
    } else {
        echo "<script type='text/javascript'>alert('Please enter some valid information');</script>";
    }
}

$query = "SELECT fname, mname, lname, student_id, email, program, year, section, status FROM stud_details";
$results = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="styles.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
    <section id="sidebar">
        <div class="header px-2 pt-3 d-flex justify-content-center align-items-center">
            <img src="logo.png" alt="logo" style="width:30%; height: 30%;" class="center">
        </div>
        <ul class="side-menu">
            <li><a href="dashboard.php" class="active" style="font-weight: bolder; font-size: 20px;"><i class='bx bxs-home icon'></i>Home</a></li>
            <li class="divider"><hr></li>
            <li><a href="student.php"><i class='bx bxs-user-circle icon'></i>Student</a></li>
            <li><a href="program.php"><i class='bx bxs-folder-open icon'></i>Programs</a></li>
            <li><a href="course.php"><i class='bx bxs-book-open icon'></i>Courses</a></li>
            <li><a href="#"><i class='bx bxs-face icon'></i>Instructor<i class='bx bx-chevron-right icon-right'></i></a>
            <ul class="side-dropdown">
                <li><a href="#">All</a></li>
                <li><a href="#">Plot Schedule</a></li>
            </ul>
            </li>
            <li><a href="#"><i class='bx bxs-calendar icon'></i>Curriculum</a></li>
            <li>
                <a href="#"><i class='bx bx-list-ol icon'></i>Queue<i class='bx bx-chevron-right icon-right'></i></a>
                <ul class="side-dropdown">
                    <li><a href="#">All</a></li>
                    <li><a href="#">Registrar</a></li>
                    <li><a href="#">OSAS</a></li>
                    <li><a href="#">Cashier</a></li>
                </ul>
            </li>
            <li class="divider"></li>
        </ul>
    </section>

    <section id="content">
        <main class="student">
            <div class="search-filter">
                <form>
                    <div class="form-group-search">
                        <input type="text" placeholder="Search from this table...">
                        <i class='bx bx-search-alt search-icon'></i>
                    </div>
                </form>
                <div class="btn-group">
                    <button type="submit" class="btn btn-success add" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>
                    <button type="button" class="btn btn export">Export CSV</button>
                </div>
            </div>
            
            <div class="table-container card">
                <div class="card-header">
                    <h4 class="card-title">Student Information</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="category">
                            <tr>
                                <th>Name</th>
                                <th>Student ID</th>
                                <th>Email</th>
                                <th>Program</th>
                                <th>Year</th>
                                <th>Section</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="content">
                            <?php
                            if(mysqli_num_rows($results) > 0){
                                while($data = mysqli_fetch_assoc($results)){
                                    echo "
                                    <tr class='student-row' data-first-name='{$data['fname']}' data-middle-name='{$data['mname']}' data-surname='{$data['lname']}' data-student-id='{$data['student_id']}' data-email='{$data['email']}' data-program='{$data['program']}' data-year='{$data['year']}' data-section='{$data['section']}' data-status='{$data['status']}'>
                                        <td>{$data['fname']} {$data['mname']} {$data['lname']}</td>
                                        <td>{$data['student_id']}</td>
                                        <td>{$data['email']}</td>
                                        <td>{$data['program']}</td>
                                        <td>{$data['year']}</td>
                                        <td>{$data['section']}</td>
                                        <td>{$data['status']}</td>
                                        <td>
                                         <button class='btn btn-info edit'>Edit</button>
                                        <button class='btn btn-danger archive'>Archive</button>
                                          </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>No records found</td></tr>";
                            }
                            ?>
                        </tbody> 
                    </table>                    
                </div>
            </div>
        </main>
    </section>

    <!-- Add Student Modal -->
    <div class="modal fade custom-modal-width" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addStudentForm" method="POST">
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                            </div>
                            <div class="col">
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middleName" name="middleName" required>
                            </div>
                            <div class="col">
                                <label for="surname" class="form-label">Surname</label>
                                <input type="text" class="form-control" id="surname" name="surname" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="studentId" class="form-label">Student ID</label>
                                <input type="text" class="form-control" id="studentId" name="studentId" required>
                            </div>
                            <div class="col">
                                <label for="emailAddress" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="emailAddress" name="emailAddress" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="program" class="form-label">Program</label>
                            <input type="text" class="form-control" id="program" name="program" required>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="year" class="form-label">Year</label>
                                <input type="number" class="form-control" id="year" name="year" required>
                            </div>
                            <div class="col">
                                <label for="section" class="form-label">Section</label>
                                <input type="text" class="form-control" id="section" name="section" required>
                            </div>
                            <div class="col">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" id="status" name="status" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="addStudentForm">Add Student</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Details Modal -->
    <div class="modal fade custom-modal-width" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStudentForm" method="POST" action="edit_student.php">
    <input type="hidden" id="originalStudentId" name="originalStudentId">
    <div class="mb-3 row">
        <div class="col">
            <label for="editFirstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="editFirstName" name="firstName" required>
        </div>
        <div class="col">
            <label for="editMiddleName" class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="editMiddleName" name="middleName" required>
        </div>
        <div class="col">
            <label for="editSurname" class="form-label">Surname</label>
            <input type="text" class="form-control" id="editSurname" name="surname" required>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col">
            <label for="editStudentId" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="editStudentId" name="studentId" required>
        </div>
        <div class="col">
            <label for="editEmailAddress" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="editEmailAddress" name="emailAddress" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="editProgram" class="form-label">Program</label>
        <input type="text" class="form-control" id="editProgram" name="program" required>
    </div>
    <div class="mb-3 row">
        <div class="col">
            <label for="editYear" class="form-label">Year</label>
            <input type="number" class="form-control" id="editYear" name="year" required>
        </div>
        <div class="col">
            <label for="editSection" class="form-label">Section</label>
            <input type="text" class="form-control" id="editSection" name="section" required>
        </div>
        <div class="col">
            <label for="editStatus" class="form-label">Status</label>
            <input type="text" class="form-control" id="editStatus" name="status" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const studentRows = document.querySelectorAll('.student-row');
    const editStudentModal = new bootstrap.Modal(document.getElementById('editStudentModal'));
    const editStudentForm = document.getElementById('editStudentForm');

    studentRows.forEach(row => {
        row.querySelector('.edit').addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent triggering the row click event

            // Populate the edit form with data from the row
            editStudentForm.querySelector('#editFirstName').value = row.dataset.firstName;
            editStudentForm.querySelector('#editMiddleName').value = row.dataset.middleName;
            editStudentForm.querySelector('#editSurname').value = row.dataset.surname;
            editStudentForm.querySelector('#originalStudentId').value = row.dataset.studentId; // Original Student ID
            editStudentForm.querySelector('#editStudentId').value = row.dataset.studentId; // New Student ID
            editStudentForm.querySelector('#editEmailAddress').value = row.dataset.email;
            editStudentForm.querySelector('#editProgram').value = row.dataset.program;
            editStudentForm.querySelector('#editYear').value = row.dataset.year;
            editStudentForm.querySelector('#editSection').value = row.dataset.section;
            editStudentForm.querySelector('#editStatus').value = row.dataset.status;

            editStudentModal.show();
        });

        row.querySelector('.archive').addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent triggering the row click event
            if (confirm('Are you sure you want to archive this student?')) {
                const studentId = row.dataset.studentId;
                // Send a request to the server to archive the student
                fetch('archive_student.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ studentId })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Student archived successfully');
                        row.remove(); // Remove the row from the table
                    } else {
                        alert('Failed to archive student');
                    }
                });
            }
        });
    });
});


    </script>
</body>
</html>
