<?php
require '../database/connection.php';
echo json_encode($conn->query("SELECT * FROM topics")->fetch_all(MYSQLI_ASSOC));
