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

    if (isset($_POST['submit'])) {

        $vm = $_POST['vehicleMake'];
        $vmod = $_POST['vehicleModel'];
        $chassis = $_POST['vehicleChassis'];
        $engine = $_POST['vehicleEngine'];
        $dop = $_POST['dateOfPurchase'];
        $file = $_POST['citizenshipDocument'];

        $sql = "INSERT INTO vehicle(model,make,chassisNumber,engineNumber,date_of_purchase,document,user_id)
        VALUES ('$vmod','$vm','$chassis','$engine','$dop','$file','$id')";

        mysqli_query($conn, $sql);

    }
}
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vehicle Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-5">Vehicle Registration Form</h1>

        <form class="card p-5" method="post">
            <!-- Vehicle Information -->
            <div class="mb-3">
                <h2 class="mb-3">Vehicle Information</h2>
                <div class="row">
                    <div class="col-md-6">
                        <label for="vehicleMake" class="form-label">Make</label>
                        <input type="text" class="form-control" id="vehicleMake" name="vehicleMake" required>
                    </div>
                    <div class="col-md-6">
                        <label for="vehicleModel" class="form-label">Model</label>
                        <input type="text" class="form-control" id="vehicleModel" name="vehicleModel" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="vehicleChassis" class="form-label">Chassis Number</label>
                        <input type="text" class="form-control" id="vehicleChassis" name="vehicleChassis" required>
                    </div>
                    <div class="col-md-6">
                        <label for="vehicleEngine" class="form-label">Engine Number</label>
                        <input type="text" class="form-control" id="vehicleEngine" name="vehicleEngine" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="dateOfPurchase" class="form-label">Date of Purchase</label>
                        <input type="date" class="form-control" id="dateOfPurchase" name="dateOfPurchase" required>
                    </div>

                </div>
            </div>
            <hr>
            <!--Owner Information -->
            <div class="mb-3">
                <h2 class="mb-3">Owner Information</h2>
                <div class="row">
                    <div class="col-md-6">
                        <label for="ownerName" class="form-label">Owner's Name</label>
                        <input type="text" class="form-control" id="ownerName" name="ownerName" disabled
                            value="<?php echo $row["userName"]; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="ownerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="ownerEmail" name="ownerEmail" disabled
                            value="<?php echo $row["email"]; ?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="ownerAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="ownerAddress" name="ownerAddress" disabled
                            value="<?php echo $row["street"] . ',' . $row["city"] . ',' . $row["district"]; ?>">
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

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="ownerDOB" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="ownerDOB" name="ownerDOB" disabled
                                value="<?php echo $row["date_of_birth"]; ?>">
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Supporting Documents -->
                <div class="mb-3">
                    <h2>Supporting Documents</h2>
                    <p>Upload the required documents:</p>

                    <div class="mb-3 col-md-4">
                        <label for="citizenshipDocument" class="form-label">Citizenship</label>
                        <input type="file" class="form-control" id="citizenshipDocument" name="citizenshipDocument"
                            required>
                    </div>
                </div>


                <div class="mb-3 mt-5">
                    <button type="submit" class="btn btn-outline-light me-3" name="submit"
                        value="submit">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>