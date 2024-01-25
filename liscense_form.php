<?php
@include 'connect.php';
session_start();

if ((!isset($_SESSION["username"])) && (!isset($_SESSION["password"]))) {
    header("location:login.php");
} else {
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM user_details WHERE user_id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST["submit"])) {
    $licenseCategory = $_POST["licenseCategory"];

    $sql = "INSERT INTO license_info(applied_category,user_id)
    VALUES ('$licenseCategory','$id')";

    mysqli_query($conn, $sql);

    header("location:homepage.php");


}

?>


<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apply Liscnese</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>


    <div class="container mt-5">
        <h1 class="text-center mb-4">License Registration Form</h1>

        <form class="card p-5" method="post">
            <!-- Personal Information -->
            <div class="mb-3">
                <h2 class="mb-3">Personal Information</h2>
                <div class="row">
                    <div class="col-md-6">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control text-uppercase" id="fullName" name="fullName" disabled
                            value="<?php echo $row["userName"] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" disabled
                            value="<?php echo $row["date_of_birth"] ?>">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" disabled
                            value="<?php echo $row["age"] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="gender" name="gender" disabled value="<?php if ($row["gender"] == 'M')
                            echo 'Male';
                        elseif ($row["gender"] == 'F')
                            echo 'Female';
                        else
                            echo 'Other'; ?>">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="citizenshipNumber" class="form-label">Citizenship Number</label>
                        <input type="text" class="form-control" id="citizenshipNumber" name="citizenshipNumber" disabled
                            value="<?php echo $row["citizenshipNumber"] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="occupation" class="form-label">Occupation</label>
                        <input type="text" class="form-control" id="occupation" name="occupation" disabled
                            value="<?php echo $row["occupation"] ?>">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="bloodGroup" class="form-label">Blood Group</label>
                        <input type="text" class="form-control" id="bloodGroup" name="bloodgroup" disabled
                            value="<?php echo $row["bloodGroup"] ?>">
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
                        <input type="text" class="form-control" id="district" name="district" disabled
                            value="<?php echo $row["district"] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" disabled
                            value="<?php echo $row["city"] ?>">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="street" class="form-label">Street</label>
                        <input type="text" class="form-control" id="street" name="street" disabled
                            value="<?php echo $row["street"] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" disabled
                            value="<?php echo $row["phone_number"] ?>">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" disabled
                            value="<?php echo $row["email"] ?>">
                    </div>
                </div>
            </div>
            <hr>

            <!-- License Category -->
            <div class="mb-3">
                <h2 class="mb-3">License Category</h2>
                <div class="row">
                    <div class="col-md-3 d-flex align-items-center">
                        <label class="form-label text-start">Select Category</label>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="licenseCategory" id="categoryA" value="a"
                                required>
                            <label class="form-check-label" for="categoryA">A-Motorcycle,Scooter,Moped</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="licenseCategory" id="categoryB" value="b"
                                required>
                            <label class="form-check-label" for="categoryB">B-Car,Jeep,Delivery Van</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="licenseCategory" id="categoryC" value="c"
                                required>
                            <label class="form-check-label" for="categoryC">C-Tempo,Auto Rickshaw</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="licenseCategory" id="categoryD" value="d"
                                required>
                            <label class="form-check-label" for="categoryD">D-Power Tiller</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="licenseCategory" id="categoryD" value="e"
                                required>
                            <label class="form-check-label" for="categoryE">E-Tractor</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="licenseCategory" id="categoryF" value="f"
                                required>
                            <label class="form-check-label" for="categoryF">F-Minibus,Minitruck</label>
                        </div>
                    </div>
                </div>


                <div class="mb-3 mt-5">
                    <button type="submit" class="btn btn-outline-light me-3" name="submit">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>