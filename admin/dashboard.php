<?php
session_start();
include("connection.php");

// Fetch student data from the database
$query = "SELECT fname, mname, lname, student_id, email, program, year, section, status FROM stud_details";
$query1 = "SELECT course_title, course_code, course_units, course_enrolled, course_description FROM courses";
$query2 = "SELECT progname, progcode, totalcourse, totalunits FROM programs";

$results = mysqli_query($conn, $query);

// Fetch the total number of students
$count_query = "SELECT COUNT(*) as total_students FROM stud_details";
$count_result = mysqli_query($conn, $count_query);
$count_data = mysqli_fetch_assoc($count_result);
$total_students = $count_data['total_students'];


// Fetch the total number of courses
$count_query = "SELECT COUNT(*) as total_courses FROM courses WHERE archived = 0";
$count_result = mysqli_query($conn, $count_query);
$count_data = mysqli_fetch_assoc($count_result);
$total_courses = $count_data['total_courses'];

// Fetch the total number of programs
$count_query = "SELECT COUNT(*) as total_programs FROM programs";
$count_result = mysqli_query($conn, $count_query);
$count_data = mysqli_fetch_assoc($count_result);
$total_programs = $count_data['total_programs'];
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
    <title>Dashboard</title>
</head>
<body>

 <!-- Navbar -->
    <section id="content">
        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search-alt search'></i>
                </div>
            </form>
            <a href="#" class="nav-link">
                <i class='bx bxs-bell'></i>
                <span class="badge">5</span>
            </a>
            <a href="#" class="nav-link">
                <i class='bx bxs-message-dots'></i>
                <span class="badge">6</span>
            </a>
            <span class="divider"></span>
            <div class="profile">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                <ul class="profile-link">
                    <li><a href="#"><i class='bx bxs-cog'></i>Profile</a></li>
                    <li><a href="#"><i class='bx bxs-user-circle'></i>Settings</a></li>
                    <li><a href="#"><i class='bx bxs-log-out'></i>Sign Out</a></li>
                </ul>
            </div>
        </nav>

    <!-- Sidebar -->
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

   

        <main>
            <h1 class="title">Hi, !</h1>
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <a href="student.php" class="card-link">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-right">
                                            <h3 class="text"><?php echo $total_students; ?></h3>
                                            <span class="ok">Enrolled Students</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="bx bxs-user-circle font-large-2 float-right" style="color: darkgreen;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <a href="course.php" class="card-link">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-right">
                                            <h3 class="text"><?php echo $total_courses; ?></h3>
                                            <span class="ok">Total Courses</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="bx bxs-book-open font-large-2 float-right" style="color: darkkhaki;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <a href="program.php" class="card-link">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-right">
                                            <h3 class="text"><?php echo $total_programs; ?></h3>
                                            <span class="ok">Total Programs</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="bx bxs-folder-open font-large-2 float-right" style="color: darkolivegreen;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <a href="#" class="card-link">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-right">
                                            <h3 class="text">423</h3>
                                            <span class="ok">Total Queue</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="bx bx-list-ol font-large-2 float-right" style="color: darkgoldenrod;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="table my-4">
                <div class="row">
                    <div class="col-12">
                        <div class="table-container card">
                            <div class="card-header">
                                <h4 class="card-title">Students</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Student ID</th>
                                            <th>Email</th>
                                            <th>Program</th>
                                            <th>Year</th>
                                            <th>Section</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(mysqli_num_rows($results) > 0) {
                                            $counter = 1;
                                            while($data = mysqli_fetch_assoc($results)) {
                                                echo "
                                                <tr>
                                                    <td>{$counter}</td>
                                                    <td>{$data['fname']} {$data['mname']} {$data['lname']}</td>
                                                    <td>{$data['student_id']}</td>
                                                    <td>{$data['email']}</td>
                                                    <td>{$data['program']}</td>
                                                    <td>{$data['year']}</td>
                                                    <td>{$data['section']}</td>
                                                    <td>{$data['status']}</td>
                                                </tr>
                                                ";
                                                $counter++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>No students found.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
