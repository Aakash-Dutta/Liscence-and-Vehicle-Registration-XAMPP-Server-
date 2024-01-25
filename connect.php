<?php
# connection
$conn = mysqli_connect('localhost', 'root', '', 'project_db');

//check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_errno());
}


?>