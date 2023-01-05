<?php
require '../database/connection.php';
require '../config/utils.php';

$q = "
    SELECT 
        DATE(backup_datetime) backup_date,
        DAY(backup_datetime) backup_day,
        MONTH(backup_datetime) backup_month,
        YEAR(backup_datetime) backup_year,
        TIME(backup_datetime) backup_time 
    FROM 
        backup_guests 
    ORDER BY 
        id 
    DESC 
    LIMIT 1";

$data = $conn->query($q)->fetch_assoc();
$data = [
    "date" => HARI_DALAM_INDONESIA[Date("w", strtotime($data['backup_date']))] . ", " . $data['backup_day'] . " " . MONTH_IN_INDONESIA[$data['backup_month'] - 1] . " " . $data['backup_year'],
    "time" => explode(":", $data['backup_time'])[0] . '.' . explode(":", $data['backup_time'])[1]
];
echo json_encode($data);
