<?php
    $conn = mysqli_connect("localhost","root","","db_cerdasgizidesa");

    if (!$conn) {
        die("Database Error : ". mysqli_connect_error());
    }
?>