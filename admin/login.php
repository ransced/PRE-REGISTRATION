<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width. initial-scale=1"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="styles.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Pacifico&display=swap" rel="stylesheet">
    <style>
        body{
            background-image: url(bg.jpg);
            background-size: cover; 
            background-attachment: fixed; 
            margin: 0; 
            padding: 0;
        }
    
    </style>
</head>
<body>
  <section class="log-in">
    <div class="container py-5 h-100 ">
      <div class="row h-100 d-flex justify-content-center" >
        <div class="col col-xl-10 ">
          <div class="card" style="border-radius: 1rem;" >
            <div class="row g-0" >
              <div class="col-md-6 col-lg-5 d-none d-md-block " style=" background-color: #fcffde; border-radius: 1rem;">
                <div class="d-flex justify-content-center pt-5 ">
                <img src="logo.png" alt="logo" class="cvsu" style="display: flex; width: 75%; height: 50%;">
              </div>
              <h2 class="d-flex justify-content-center name pt-5">TANZA CAMPUS</h2>
            </div>
              <div class="col-md-6 col-lg-7" style=" background-color: #132a13; border-radius: 1rem;">
                <div class="card-body p-4 p-lg-5 text-light">
  
                  <form class="login">

                    <h3 class="h1 mb-0">Welcome, Admin!</h3>
                    <h5 class="log mb-3 pb-3" style="letter-spacing: 2px;">LOG IN</h5>
  
                    <div data-mdb-input-init class="email form-outline mb-4">
                      <i class="login__icon fas fa-user fa-lg"></i>
                      <input type="email" id="email" class="input-email form-control form-control-m" placeholder="Username" />
                    </div>
  
                    <div data-mdb-input-init class="password form-outline mb-4">
                      <i class="login__icon fas fa-lock fa-lg"></i>
                      <input type="password" id="stud_num" class="input-email form-control form-control-m" placeholder="Password" />
                    </div>
  
                    <div class="d-flex justify-content-center pt-1 mb-4">
                      <button data-mdb-button-init data-mdb-ripple-init class="log-in-btn btn-lg btn-block" type="button"><a href="dashboard.html" style="text-decoration: none;">LOG IN</a></button>
                    </div>
                  </form>
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>