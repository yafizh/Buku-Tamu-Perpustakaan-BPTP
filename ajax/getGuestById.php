<?php
require '../database/connection.php';
require '../config/utils.php';

$q = "
    SELECT 
        g.name,
        DATE(g.visit_datetime) AS visit_date,
        DAY(g.visit_datetime) AS visit_day,
        MONTH(g.visit_datetime) AS visit_month,
        YEAR(g.visit_datetime) AS visit_year,
        DATE_FORMAT(g.visit_datetime, '%H:%i') AS visit_time,
        g.visit_reason, 
        g.profession,
        t.name topic,
        gs.university,
        ge.division   
    FROM 
        guests g 
    LEFT JOIN 
        guest_employees ge 
    ON 
        ge.guest_id=g.id
    LEFT JOIN 
        guest_students gs 
    ON 
        gs.guest_id=g.id
    INNER JOIN 
        topics t 
    ON 
        t.id=g.topic_id 
    WHERE 
        g.id='" . $conn->real_escape_string($_GET['id'] ). "' 
";

$guest = $conn->query($q)->fetch_assoc();
$guest = [
    "raw" => $guest,
    "show" => [
        "name" => $guest['name'],
        "date" => HARI_DALAM_INDONESIA[Date("w", strtotime($guest['visit_date']))] . ", " . $guest['visit_day'] . " " . MONTH_IN_INDONESIA[$guest['visit_month'] - 1] . " " . $guest['visit_year'],
        "profession" => $guest['profession'],
        "topic" => $guest['topic']
    ]
];
echo json_encode($guest);