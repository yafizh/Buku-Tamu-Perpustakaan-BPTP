<?php
require '../database/connection.php';

try {
    $conn->begin_transaction();
    $q = "
    INSERT INTO guests ( 
            topic_id,
            name,
            visit_datetime,
            visit_reason,
            profession 
            ) VALUES (
                '" . $conn->real_escape_string($_POST['topic_id']) . "',
                '" . $conn->real_escape_string($_POST['name']) . "',
                '" . $conn->real_escape_string($_POST['visit_datetime']) . "',
                '" . $conn->real_escape_string($_POST['visit_reason']) . "',
            '" . $conn->real_escape_string($_POST['profession']) . "' 
        )
        ";
    $conn->query($q);

    if (isset($_POST['university']))
        $conn->query("INSERT INTO guest_students (guest_id, university) VALUES (" . $conn->insert_id . ", '" . $conn->real_escape_string($_POST['university']) . "')");

    if (isset($_POST['division']))
        $conn->query("INSERT INTO guest_employees (guest_id, division) VALUES (" . $conn->insert_id . ", '" . $conn->real_escape_string($_POST['division']) . "')");

    $conn->commit();
    echo json_encode(['isSuccess' => true]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(array(
        'error' => array(
            'msg' => $e->getMessage(),
            'code' => $e->getCode(),
        ),
    ));
};
