<?php
session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['programId'])) {
        // Update operation
        $programId = $_POST['programId'];
        $programName = $_POST['programName'];
        $programCode = $_POST['programCode'];
        $totalCourse = $_POST['totalCourse'];
        $totalunits = $_POST['totalunits'];

        if (!empty($programName) && !empty($programCode) && !empty($totalCourse) && !empty($totalunits)) {
            $query = "UPDATE programs SET progname='$programName', progcode='$programCode', totalcourse='$totalCourse', totalunits='$totalunits' WHERE id='$programId'";
            
            if (mysqli_query($conn, $query)) {
                echo "<script type='text/javascript'>alert('Update successful');</script>";
                echo "<script type='text/javascript'>window.location.href = 'program.php';</script>";
            } else {
                echo "<script type='text/javascript'>alert('Database update failed');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Please enter valid information');</script>";
        }
    } else {
        // Insert operation
        $programName = $_POST['programName'];
        $programCode = $_POST['programCode'];
        $totalCourse = $_POST['totalCourse'];
        $totalunits = $_POST['totalunits'];

        if (!empty($programName) && !empty($programCode) && !empty($totalCourse) && !empty($totalunits)) {
            $query = "INSERT INTO programs(progname, progcode, totalcourse, totalunits) VALUES ('$programName', '$programCode', '$totalCourse', '$totalunits')";
            
            if (mysqli_query($conn, $query)) {
                echo "<script type='text/javascript'>alert('Add successful');</script>";
                echo "<script type='text/javascript'>window.location.href = 'program.php';</script>";
            } else {
                echo "<script type='text/javascript'>alert('Database insertion failed');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Please enter valid information');</script>";
        }
    }
}

if (isset($_GET['archive_id'])) {
    $archiveId = $_GET['archive_id'];
    $query = "DELETE FROM programs WHERE id='$archiveId'";
    
    if (mysqli_query($conn, $query)) {
        echo "<script type='text/javascript'>alert('Archive successful');</script>";
        echo "<script type='text/javascript'>window.location.href = 'program.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Database archive failed');</script>";
    }
}

$programs = [];
$query = "SELECT * FROM programs";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $programs[] = $row;
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
                </form>
                <div class="btn-group">
                    <button type="button" class="btn btn-success add" data-bs-toggle="modal" data-bs-target="#addProgramModal">
                        Add Program
                    </button>
                </div>
            </div>
            
            <div class="table-container card">
                <div class="card-header">
                    <h4 class="card-title">Program Information</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="category">
                            <tr>
                                <th>Program Code</th>
                                <th>Program Title</th>
                                <th>Total No. <br>of Course</th>
                                <th>Total<br>Units</th>
                                <th>Total No.<br>of Enrolled</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="content">
                            <?php foreach ($programs as $program) : ?>
                            <tr>
                                <td><?= htmlspecialchars($program['progcode']) ?></td>
                                <td><?= htmlspecialchars($program['progname']) ?></td>
                                <td><?= htmlspecialchars($program['totalcourse']) ?></td>
                                <td><?= htmlspecialchars($program['totalunits']) ?></td>
                                <td> <!-- You need to fetch this data as well if available -->
                                    <!-- Example: <?= htmlspecialchars($program['totalenrolled']) ?> -->
                                </td>
                                <td>
                                    <button class="btn btn-info edit" data-bs-toggle="modal" data-bs-target="#editProgramModal" 
                                    data-id="<?= $program['id'] ?>" data-name="<?= $program['progname'] ?>" 
                                    data-code="<?= $program['progcode'] ?>" data-course="<?= $program['totalcourse'] ?>" 
                                    data-units="<?= $program['totalunits'] ?>">Edit</button>
                                    <a href="?archive_id=<?= $program['id'] ?>" class="btn btn-danger archive">Archive</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </section>

    <!-- Add Program Modal -->
    <div class="modal fade" id="addProgramModal" tabindex="-1" aria-labelledby="addProgramModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProgramModalLabel">Add Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProgramForm" method="POST" action="">
                        <div class="mb-3">
                            <label for="programName" class="form-label">Program Name</label>
                            <input type="text" class="form-control" id="programName" name="programName" required>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="programCode" class="form-label">Program Code</label>
                                <input type="text" class="form-control" id="programCode" name="programCode" required>
                            </div>
                            <div class="col">
                                <label for="totalCourses" class="form-label">Total Number of Courses</label>
                                <input type="number" class="form-control" id="totalCourses" name="totalCourse" required>
                            </div>
                            <div class="col">
                                <label for="totalUnits" class="form-label">Total Units</label>
                                <input type="number" class="form-control" id="totalUnits" name="totalunits" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('addProgramForm').submit();">Add Program</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Program Modal -->
    <div class="modal fade" id="editProgramModal" tabindex="-1" aria-labelledby="editProgramModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProgramModalLabel">Edit Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProgramForm" method="POST" action="">
                        <input type="hidden" id="programId" name="programId">
                        <div class="mb-3">
                            <label for="editProgramName" class="form-label" >Program Name</label>
                            <input type="text" class="form-control" id="editProgramName" name="programName" required>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="editProgramCode" class="form-label">Program Code</label>
                                <input type="text" class="form-control" id="editProgramCode" name="programCode" required>
                            </div>
                            <div class="col">
                                <label for="editTotalCourses" class="form-label">Total Number of Courses</label>
                                <input type="number" class="form-control" id="editTotalCourses" name="totalCourse" required>
                            </div>
                            <div class="col">
                                <label for="editTotalUnits" class="form-label">Total Units</label>
                                <input type="number" class="form-control" id="editTotalUnits" name="totalunits" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('editProgramForm').submit();">Update Program</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.edit').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const code = button.getAttribute('data-code');
                const course = button.getAttribute('data-course');
                const units = button.getAttribute('data-units');

                document.getElementById('programId').value = id;
                document.getElementById('editProgramName').value = name;
                document.getElementById('editProgramCode').value = code;
                document.getElementById('editTotalCourses').value = course;
                document.getElementById('editTotalUnits').value = units;
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
