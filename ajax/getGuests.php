<?php
require '../database/connection.php';
require '../config/utils.php';

$from_date = null;
$to_date = null;
$profession = null;
$topic = null;

$name = $conn->real_escape_string($_POST['name']);

if ($_POST['visit_date'] != 'Semua') {
    $trim_from_date = trim(explode('-', $_POST['visit_date'])[0], ' ');
    $trim_to_date = trim(explode('-', $_POST['visit_date'])[1], ' ');

    $from_date = explode('/', $trim_from_date)[2] . '-' . explode('/', $trim_from_date)[1] . '-' . explode('/', $trim_from_date)[0];
    $to_date = explode('/', $trim_to_date)[2] . '-' . explode('/', $trim_to_date)[1] . '-' . explode('/', $trim_to_date)[0];
}

if (!empty($_POST['profession']))
    $profession = $_POST['profession'];

if (!empty($_POST['topic']))
    $topic = $_POST['topic'];

$q = "
    SELECT 
        g.id,
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
        g.name LIKE '%$name%' 
";

if (!is_null($from_date) && !is_null($to_date))
    $q .= " AND (DATE(g.visit_datetime) >= '$from_date' AND DATE(g.visit_datetime) <= '$to_date')";

if (!is_null($profession))
    $q .= " AND g.profession = '$profession'";

if (!is_null($topic))
    $q .= " AND g.topic_id = '$topic'";

$q .= " ORDER BY g.visit_datetime DESC";

$guests = $conn->query($q)->fetch_all(MYSQLI_ASSOC);
$guests = array_map(function ($a) {
    return [
        "raw" => $a,
        "show" => [
            "name" => $a['name'],
            "date" => HARI_DALAM_INDONESIA[Date("w", strtotime($a['visit_date']))] . ", " . $a['visit_day'] . " " . MONTH_IN_INDONESIA[$a['visit_month'] - 1] . " " . $a['visit_year'],
            "profession" => $a['profession'],
            "topic" => $a['topic']
        ]
    ];
}, $guests);
echo json_encode($guests);
