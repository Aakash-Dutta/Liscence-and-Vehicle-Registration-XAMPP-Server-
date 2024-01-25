<?php
@include 'connect.php';
session_start();

if (!isset($_SESSION['access']) == 'admin') {
    header('location:login.php');
} else {
    $sql = 'SELECT * FROM license_info JOIN user_details
    ON license_info.user_id=user_details.user_id';
    $result = mysqli_query($conn, $sql);
    $data_license = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row_license = mysqli_fetch_assoc($result)) {
            array_unshift($data_license, $row_license);
        }
    }

    $sql = 'SELECT * FROM vehicle JOIN user_details
    ON vehicle.user_id=user_details.user_id';
    $result = mysqli_query($conn, $sql);
    $data_vehicle = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row_vehicle = mysqli_fetch_assoc($result)) {
            array_unshift($data_vehicle, $row_vehicle);
        }
    }


}

?>


<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />


    <style>
        .link_container a:link {
            text-decoration: none;
        }

        .link_container a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">
                LVR
            </a>
            <button class="navbar-toggler" type="button" data_license-bs-toggle="collapse"
                data_license-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-uppercase" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            ADMIN
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="link_container">
                <ul class="list-group list-group-horizontal list-group-flush">
                    <li class="list-group-item border-0"><a href="#" onclick="showTable('1')" class="link-light">License
                            Record</a>
                    </li>
                    <div class="vr"></div>
                    <li class="list-group-item border-0"><a href="#" onclick="showTable('2')" class="link-light">Vehicle
                            Record</a></li>
                </ul>

            </div>
        </div>
    </div>

    <div id="table1" class="container mt-5">
        <div class="tableWrapper">
            <table id="lic_record" class="table table-bordered nowrap display mt-3">
                <caption style="caption-side:top; font-weight:600;">License Record</caption>
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>User Name</th>
                        <th>Applicant ID</th>
                        <th>Applied Category</th>
                        <th>Date of Submission</th>
                        <th>Date of Birth</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Occupation</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>City</th>
                        <th>District</th>
                        <th>Street</th>
                        <th>Blood Group</th>
                        <th>Citizenship Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($data_license as $row_license) {
                        echo '<tr>';
                        echo '<td>' . $i++ . '</td>';
                        echo '<td>' . $row_license["userName"] . '</td>';
                        echo '<td>' . $row_license["applicant_id"] . '</td>';
                        echo '<td>' . $row_license["applied_category"] . '</td>';
                        echo '<td>' . $row_license["date_of_submission"] . '</td>';
                        echo '<td>' . $row_license["date_of_birth"] . '</td>';
                        echo '<td>' . $row_license["age"] . '</td>';
                        echo '<td>' . $row_license["gender"] . '</td>';
                        echo '<td>' . $row_license["occupation"] . '</td>';
                        echo '<td>' . $row_license["email"] . '</td>';
                        echo '<td>' . $row_license["phone_number"] . '</td>';
                        echo '<td>' . $row_license["city"] . '</td>';
                        echo '<td>' . $row_license["district"] . '</td>';
                        echo '<td>' . $row_license["street"] . '</td>';
                        echo '<td>' . $row_license["bloodGroup"] . '</td>';
                        echo '<td>' . $row_license["citizenshipNumber"] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>


            </table>
        </div>
    </div>

    <div id="table2" class="container mt-5">
        <div class="tableWrapper">
            <table id="vehicle_record" class="table table-bordered nowrap display mt-3">
                <caption style="caption-side:top; font-weight:600;">Vehicle Record</caption>
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>User Name</th>
                        <th>Registration ID</th>
                        <th>Date of Registration</th>
                        <th>Date of Purchase</th>
                        <th>Model</th>
                        <th>Make</th>
                        <th>Chassis Number</th>
                        <th>Engine Number</th>
                        <th>Date of Birth</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Occupation</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>City</th>
                        <th>District</th>
                        <th>Street</th>
                        <th>Blood Group</th>
                        <th>Citizenship Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($data_vehicle as $row_vehicle) {
                        echo '<tr>';
                        echo '<td>' . $i++ . '</td>';
                        echo '<td>' . $row_vehicle["userName"] . '</td>';
                        echo '<td>' . $row_vehicle["registration_id"] . '</td>';
                        echo '<td>' . $row_vehicle["date_of_registration"] . '</td>';
                        echo '<td>' . $row_vehicle["date_of_purchase"] . '</td>';
                        echo '<td>' . $row_vehicle["model"] . '</td>';
                        echo '<td>' . $row_vehicle["make"] . '</td>';
                        echo '<td>' . $row_vehicle["chassisNumber"] . '</td>';
                        echo '<td>' . $row_vehicle["engineNumber"] . '</td>';
                        echo '<td>' . $row_vehicle["date_of_birth"] . '</td>';
                        echo '<td>' . $row_vehicle["age"] . '</td>';
                        echo '<td>' . $row_vehicle["gender"] . '</td>';
                        echo '<td>' . $row_vehicle["occupation"] . '</td>';
                        echo '<td>' . $row_vehicle["email"] . '</td>';
                        echo '<td>' . $row_vehicle["phone_number"] . '</td>';
                        echo '<td>' . $row_vehicle["city"] . '</td>';
                        echo '<td>' . $row_vehicle["district"] . '</td>';
                        echo '<td>' . $row_vehicle["street"] . '</td>';
                        echo '<td>' . $row_vehicle["bloodGroup"] . '</td>';
                        echo '<td>' . $row_vehicle["citizenshipNumber"] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>


            </table>
        </div>
    </div>



    <script src="./jquery-3.7.1.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        function showTable(value) {
            if (value == '1') {
                $('#table2').hide();
                $('#table1').show();
            }
            if (value == '2') {
                $('#table1').hide();
                $('#table2').show();
            }
        }
        $(document).ready(function () {
            $('#table1').hide();
            $('#table2').hide();

            $('#lic_record').DataTable({

                // Enable sorting on all columns
                "order": [],
                "paging": true,
                "lengthChange": true,
                "pageLength": 5,
                // Length menu options
                "lengthMenu": [5, 10, 15],
                "searching": true,
                "info": true,
                "autoWidth": true,
                "scrollY": "300px",
                "scrollX": true,

            });

            $('#vehicle_record').DataTable({
                // Enable sorting on all columns
                "order": [],
                "paging": true,
                "lengthChange": true,
                "pageLength": 5,
                // Length menu options
                "lengthMenu": [5, 10, 15],
                "searching": true,
                "info": true,
                "autoWidth": true,
                "scrollY": "300px",
                "scrollX": true

            });
        });
    </script>

</body>

</html>