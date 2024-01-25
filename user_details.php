<?php
@include 'connect.php';
session_start();

if ((!isset($_SESSION["username"])) && (!isset($_SESSION["password"]))) {
    header("location:login.php");
} else {


    #fetch data form user_details matching current session user
    $username = $_SESSION["username"];
    $sql = "SELECT user_id from login where login_userName='$username'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    $result = $data["user_id"];
    $sql = "SELECT * from user_details where user_id='$result'";
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));



    if ($row["citizenshipNumber"] != NULL) {
        if ($_GET["goto"] == "license")
            header("location:liscense_form.php");
        else if ($_GET["goto"] == "vehicle")
            header("location:vehicle_form.php");
        else
            echo '';
    }

    $_SESSION["id"] = $row["user_id"];


    if (isset($_POST["submit"])) {
        $dob = $_POST["dob"];
        $age = $_POST["age"];
        $gender = $_POST["gender"];
        $occupation = $_POST["occupation"];
        $phone = $_POST["phoneNumber"];
        $bloodGroup = $_POST["bloodGroup"];
        $city = $_POST["city"];
        $street = $_POST["street"];
        $district = $_POST["district"];
        $citizenshipNum = $_POST["citizenshipNumber"];
        $id = $_SESSION["id"];

        $sql = "UPDATE user_details SET
        date_of_birth ='$dob',
        age='$age',
        gender='$gender',
        occupation='$occupation',
        phone_number='$phone',
        city='$city',
        street ='$street',
        district='$district',
        citizenshipNumber='$citizenshipNum',
        bloodGroup='$bloodGroup'
        WHERE user_id='$id'";

        mysqli_query($conn, $sql);


    }
}
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4 text-uppercase">Your Details</h1>

        <form class="card p-5" method="post">
            <!-- Personal Information -->
            <div class="mb-3">
                <h2 class="mb-3">Personal Information</h2>
                <div class="row">
                    <div class="col-md-6">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control text-uppercase" id="fullName" name="fullName"
                            placeholder="<?php echo $row["userName"]; ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="age" class="form-label">Age</label>
                        <input type="text" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="maleGender" value="M"
                                required>
                            <label class="form-check-label" for="maleGender">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="F"
                                required>
                            <label class="form-check-label" for="femaleGender">Female</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="otherGender" value="O"
                                required>
                            <label class="form-check-label" for="otherGender">Other</label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="citizenshipNumber" class="form-label">Citizenship Number</label>
                        <input type="text" class="form-control" id="citizenshipNumber" name="citizenshipNumber"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="occupation" class="form-label">Occupation</label>
                        <input type="text" class="form-control" id="occupation" name="occupation" required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="bloodGroup" class="form-label">Blood Group</label>
                        <select class="form-select" id="bloodGroup" name="bloodGroup" required>
                            <option value="" disabled selected>Select Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>

            <!-- Address Details -->
            <div class="mb-3">
                <h2 class="mb-3">Address Details</h2>
                <div class="row">
                    <div class="col-md-6">
                        <label for="district" class="form-label">District</label>
                        <input type="text" class="form-control" id="district" name="district" required>
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="street" class="form-label">Street</label>
                        <input type="text" class="form-control" id="street" name="street" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="<?php echo $row["email"] ?>" disabled>
                    </div>
                </div>
            </div>

            <div class="mb-3 mt-5">
                <button type="submit" class="btn btn-outline-light me-3" name="submit">Submit</button>

            </div>
        </form>
    </div>


    <script>
        document.getElementById('dob').addEventListener('change', function () {
            var dob = new Date(this.value);
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();

            if (today.getMonth() < dob.getMonth() || (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
                age--;
            }

            document.getElementById('age').value = age;
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>