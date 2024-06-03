<?php
session_start();
include("connection.php");
    if($_SERVER['REQUEST_METHOD']=="POST"){
      $firstname = $_POST['fname'];
      $middlename = $_POST['mname'];
      $lastname = $_POST['lname'];
      $program = $_POST['program'];
      $studentno = $_POST['studentno'];
      $year = $_POST['year'];
      $section = $_POST['section'];
      $cvsuE = $_POST['cvsuE'];
      $password = $_POST['password'];
      $contactno = $_POST['contactno'];
      
      if(!empty($password) && !empty($password)){
        $query = "insert into student_information(fname, mname, lname, program, studentno, year, section, cvsuE, password, contactno) values ('$firstname','$middlename','$lastname','$program ','$studentno','$year','$section','$cvsuE','$password','$contactno')";

        mysqli_query($conn, $query);
        echo "<script type = 'text/javascript'>alert('Successfully Registered' )</script>";

      }
      else{
        echo "<script type = 'text/javascript'>alert('please enter some valid information' )</script>";

      }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width. initial-scale=1"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Pacifico&display=swap" rel="stylesheet">
    <style>
        body{
            background-image: url(images/bg.jpg);
            background-size: cover; 
            background-attachment: fixed; 
            margin: 0; 
            padding: 0;
        }
    
    </style>
</head>
<body>

    <section class="vh100">
    <div class="container-fluid py-4 h-100">
        <div class="row justify-content-center align-items-center h-100 ">
          <div class="col-12 col-lg-9 col-xl-7">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
              <div class="card-body p-4 p-md-5">
                <h3 class="mb-2 pb-md-0 mb-md-5 pi" >PERSONAL INFORMATION</h3>
                <form method="POST">
    
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label class="form-label" for="firstName">First Name:</label>
                            <div data-mdb-input-init class="form-outline">
                                <input type="text" id="firstName" name="fname" onchange="upperCase('firstName')" class="form-control form-control-lg input-d" />
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="form-label" for="middleName">Middle Name:</label>
                            <div data-mdb-input-init class="form-outline">
                                <input type="text" id="middleName" name="mname" onchange="upperCase('middleName')" class="form-control form-control-lg input-d" />
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="form-label" for="lastName">Last Name:</label>
                            <div data-mdb-input-init class="form-outline">
                                <input type="text" id="lastName" name="lname" onchange="upperCase('lastName')" class="form-control form-control-lg input-d" />
                            </div>
                        </div>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label select-label">Program:</label>
                        <select data-mdb-select-init onchange="upperCase('program')" class="form-control form-control-lg input-d" id="program" name="program">
                            <option value="1" disabled>Program</option>
                            <option value="2"></option>
                            <option value="3"></option>
                            <option value="4"></option>
                          </select>
    
                  <div class="row">
                    <div class="col-md-4 mb-4 d-flex align-items-center">
                      <div data-mdb-input-init class="form-outline mt-4">
                        <label class="form-label">Student Number:</label>
                        <input type="text" class="form-control form-control-lg input-d" id="StudentNo" name="studentno" />
                      </div>
    
                    </div>
                        <div class="col-md-4 mb-4">
                        <div data-mdb-input-init class="form-outline mt-4">
                            <label class="form-label select-label">Year:</label>
                        <select data-mdb-select-init class="form-control form-control-lg input-d " id="year" name="year">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                          </select>

                    </div>
                  </div>
                  <div class="col-md-4 mb-4">
                    <div data-mdb-input-init class="form-outline mt-4">
                        <label class="form-label select-label">Section:</label>
                    <select data-mdb-select-init class="form-control form-control-lg input-d" id="section" name="section">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                      </select>

                </div>
              </div>
                  </div>
    
                  <div class="row">
                    <div class="col-md-6 mb-4 pb-2">
    
                      <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="emailAddress">CVSU Email:</label>
                        <input type="email" id="emailAddress" name="cvsuE" class="form-control form-control-lg input-d" />
                      </div>
    
                    </div>
                    <div class="col-md-6 mb-2 pb-2">
                    <div class="row">
                    <div class="col-md-6 mb-4 pb-2">
    
                      <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control form-control-lg input-d" />
                      </div>
    
                    </div>
                    <div class="col-md-6 mb-2 pb-2">
    
                      <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="phoneNumber">Contact Number:</label>
                        <input type="tel" id="phoneNumber" name="contactno" class="form-control form-control-lg input-d" />
                      </div>
    
                    </div>
                  </div>
  
                  <div class="align-items-center ">
                    <input data-mdb-button-init data-mdb-ripple-init class="btn btn-lg next" type="submit" value="NEXT" />
                  </div>
                </form>
                <p>Already Have an account?<a href="login.php">login here</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function upperCase(id) {
          const x = document.getElementById(id);
          x.value = x.value.toUpperCase();
      
        }
        </script>
</body>
</html>