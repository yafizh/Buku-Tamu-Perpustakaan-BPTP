<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bptp_library_guest_book";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);
