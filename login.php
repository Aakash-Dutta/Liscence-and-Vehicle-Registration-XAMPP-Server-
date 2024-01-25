<?php
@include 'connect.php';

$error_check = '';
session_start();
if (isset($_POST['submit'])) {

  $u_username = $_POST['username'];
  $u_password = $_POST['password'];

  if ($u_username == 'admin' && $u_password == 'admin') {
    $_SESSION['access'] = 'admin';
    header('location:admin.php');
  }

  $check = "SELECT * FROM login where login_userName='$u_username' && login_password='$u_password'";
  $result = mysqli_query($conn, $check);
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    $_SESSION["username"] = $u_username;
    $_SESSION["password"] = $u_password;
    $_SESSION["access"] = $data["access"];
    header("location:homepage.php");
  } else {
    $error_check = "User doesn't exist";
  }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <style>
    div.error {
      color: red;
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
  <form method="post" action="">
    <section class="vh-100 gradient-custom">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card " style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">

                <div class="mb-md-5 mt-md-4 pb-5">

                  <h2 class="fw-bold mb-5 text-uppercase">Login</h2>

                  <div class="form-outline form-white mb-4">
                    <label class="form-label float-start" for="typeEmailX">Username</label>
                    <input type="text" id="username" class="form-control form-control-lg" name="username" required />
                  </div>

                  <div class="form-outline form-white mb-4">
                    <label class="form-label float-start" for="typePasswordX">Password</label>
                    <input type="password" id="password" class="form-control form-control-lg" name="password"
                      required />
                  </div>

                  <button class="btn btn-outline-light btn-lg px-5 mt-3 text-uppercase" type="submit" value="submit"
                    name="submit">Login</button>

                </div>


                <div class="error float-start">
                  <?php echo $error_check ?>
                </div>
                <div>
                  <p class="mb-0 <?php if (isset($_POST['submit']) && $error_check != '')
                    echo 'float-end' ?>">First
                      Time? <a href="register.php" class=" fw-bold">Sign Up</a>
                    </p>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>
  </body>

  </html>