<?php
@include 'connect.php';
$error_check = '';


if (isset($_POST['submit'])) {
  $u_name = $_POST['name'];
  $u_username = $_POST['username'];
  $u_password = $_POST['password'];
  $u_email = $_POST['email'];

  $u_access = "user";

  $check = "SELECT * FROM login WHERE login_userName='$u_username' && login_password='$u_password'";
  if (mysqli_num_rows(mysqli_query($conn, $check)) > 0) {
    $error_check = "USER ALREADY EXISTS";
  } else {
    $sql = "INSERT INTO user_details(userName,email)
    VALUES ('$u_name','$u_email') ";
    mysqli_query($conn, $sql);


    $sql = "SELECT * FROM user_details where username='$u_name'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row["user_id"];


    $sql = "INSERT INTO login(login_userName,login_password,access,user_id)
          VALUES ('$u_username','$u_password','$u_access',$id)";
    mysqli_query($conn, $sql);



    header("location:login.php", true, 301);
  }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
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

    <div class="container py-4 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card" style="border-radius: 1rem;">
            <div class="card-body p-5">

              <div class="mb-md-2 mt-md-2 ">

                <h2 class=" mb-5 text-uppercase">Register</h2>


                <div class="mb-4">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control form-control-lg" name="name" required />
                </div>

                <div class="mb-4">
                  <label class="form-label">Username</label>
                  <input type="text" name="username" class="form-control form-control-lg" required />
                </div>

                <div class="mb-4">
                  <label class="form-label" for="typeEmaiX">Email</label>
                  <input type="email" name="email" class="form-control form-control-lg" required />
                </div>

                <div class="mb-4">
                  <label class="form-label" for="typePasswordX">Password</label>
                  <input type="password" name="password" class="form-control form-control-lg" required />
                </div>

                <div class="error">
                  <?php echo $error_check ?>
                </div>

                <button class="btn btn-outline-light btn-md px-3 mt-3" type="submit" value="submit"
                  name="submit">Submit</button>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>