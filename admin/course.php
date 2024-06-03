<?php
session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $courseTitle = $_POST['courseTitle'];
    $courseCode = $_POST['courseCode'];
    $totalUnits = $_POST['totalunits'];
    $totalEnrolled = $_POST['totalEnrolled'];
    $description = $_POST['description'];

    if (!empty($courseTitle) && !empty($courseCode) && !empty($totalUnits) && !empty($totalEnrolled) && !empty($description)) {
        if (isset($_POST['course_id']) && !empty($_POST['course_id'])) {
            $course_id = $_POST['course_id'];
            $query = "UPDATE courses SET course_title='$courseTitle', course_code='$courseCode', course_units='$totalUnits', course_enrolled='$totalEnrolled', course_description='$description' WHERE id=$course_id";
        } else {
            $query = "INSERT INTO courses (course_title, course_code, course_units, course_enrolled, course_description) VALUES ('$courseTitle', '$courseCode', '$totalUnits', '$totalEnrolled', '$description')";
        }

        if ($conn->query($query) === TRUE) {
            echo "<script type='text/javascript'>alert('Operation successful');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Database operation failed: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Please enter valid information');</script>";
    }
}

$courses = [];
$query = "SELECT * FROM courses WHERE archived = 0";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}
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
    <title>Programs</title>
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
                <form action="#">
                    <div class="form-group-search">
                        <input type="text" placeholder="Search from this table...">
                        <i class='bx bx-search-alt search-icon'></i>
                    </div>
                    <div class="form-group mt-3">
                        <select class="form-select" aria-label="Select Program">
                            <option selected>Select Program</option>
                            <option value="BSIT">Bachelor of Science in Information Technology</option>
                            <option value="BSCS">Bachelor of Science in Computer Science</option>
                        </select>
                    </div>
                </form>
                <div class="btn-group mt-3">
                    <button type="button" class="btn btn-success add" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                        Add Course
                    </button>
                </div>
            </div>
            
            <div class="table-container card ">
                <div class="card-header">
                    <h4 class="card-title">Program Information</h4>
                </div>
                <!-- Add a message to display when the table is empty -->
<div class="card-body">
    <table class="table">
        <thead class="category">
            <tr>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Total<br>Units</th>
                <th>Total No.<br>of Enrolled</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="content" id="courseTableBody">
            <!-- Display the courses -->
            <?php foreach($courses as $course): ?>
                <tr data-id="<?= $course['id'] ?>">
                    <td><?= htmlspecialchars($course['course_code']) ?></td>
                    <td><?= htmlspecialchars($course['course_title']) ?></td>
                    <td><?= htmlspecialchars($course['course_units']) ?></td>
                    <td><?= htmlspecialchars($course['course_enrolled']) ?></td>
                    <td><?= htmlspecialchars($course['course_description']) ?></td>
                    <td>
                        <button class="btn btn-info edit" data-bs-toggle="modal" data-bs-target="#addCourseModal" data-id="<?= $course['id'] ?>" data-title="<?= $course['course_title'] ?>" data-code="<?= $course['course_code'] ?>" data-units="<?= $course['course_units'] ?>" data-enrolled="<?= $course['course_enrolled'] ?>" data-description="<?= $course['course_description'] ?>">Edit</button>
                        <button class="btn btn-danger archive" data-id="<?= $course['id'] ?>">Archive</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Display a message when the table is empty -->
    <?php if(count($courses) == 0): ?>
        <p class="text-left">No records found.</p>
    <?php endif; ?>
</div>
            </div>
        </main>
    </section>

    <!-- Add/Edit Course Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">Add Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCourseForm" action="course.php" method="post">
                        <input type="hidden" id="courseId" name="course_id">
                        <div class="mb-3">
                            <label for="courseTitle" class="form-label">Course Title</label>
                            <input type="text" class="form-control" id="courseTitle" name="courseTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="courseCode" class="form-label">Course Code</label>
                            <input type="text" class="form-control" id="courseCode" name="courseCode" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="totalUnits" class="form-label">Total Units</label>
                                <input type="number" class="form-control" id="totalUnits" name="totalunits" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="totalEnrolled" class="form-label">Total Number of Enrolled</label>
                                <input type="number" class="form-control" id="totalEnrolled" name="totalEnrolled" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <select class="form-select" id="description" name="description" required>
                                <option selected disabled>Select Description</option>
                                <option value="Major">Major</option>
                                <option value="General Education">General Education</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveCourseBtn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let editMode = false;
        let editRow = null;

        document.getElementById('saveCourseBtn').addEventListener('click', function() {
            document.getElementById('addCourseForm').submit();
        });

        document.getElementById('courseTableBody').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('edit')) {
                const row = e.target.closest('tr');
                editMode = true;
                editRow = row;
                document.getElementById('courseTitle').value = row.cells[1].innerText;
                document.getElementById('courseCode').value = row.cells[0].innerText;
                document.getElementById('totalUnits').value = row.cells[2].innerText;
                document.getElementById('totalEnrolled').value = row.cells[3].innerText;
                document.getElementById('description').value = row.cells[4].innerText;
                document.getElementById('courseId').value = row.dataset.id;
            }
            if (e.target && e.target.classList.contains('archive')) {
                const row = e.target.closest('tr');
                const courseId = row.dataset.id;

                if (confirm('Are you sure you want to archive this course?')) {
                    fetch(`archive_course.php?id=${courseId}`, {
                        method: 'GET'
                    }).then(response => response.text())
                    .then(data => {
                        if (data === 'success') {
                            row.remove();
                        } else {
                            alert('Failed to archive course');
                        }
                    });
                }
            }
        });

        const addCourseModal = document.getElementById('addCourseModal');
        addCourseModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            if (button.classList.contains('edit')) {
                const courseTitle = button.getAttribute('data-title');
                const courseCode = button.getAttribute('data-code');
                const totalUnits = button.getAttribute('data-units');
                const totalEnrolled = button.getAttribute('data-enrolled');
                const description = button.getAttribute('data-description');
                const courseId = button.getAttribute('data-id');

                document.getElementById('courseTitle').value = courseTitle;
                document.getElementById('courseCode').value = courseCode;
                document.getElementById('totalUnits').value = totalUnits;
                document.getElementById('totalEnrolled').value = totalEnrolled;
                document.getElementById('description').value = description;
                document.getElementById('courseId').value = courseId;
                document.getElementById('addCourseModalLabel').innerText = 'Edit Course';
            } else {
                document.getElementById('addCourseForm').reset();
                document.getElementById('addCourseModalLabel').innerText = 'Add Course';
            }
        });
    </script>
</body>
</html>
