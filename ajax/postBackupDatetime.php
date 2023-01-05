<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
require '../database/connection.php';

try {
    $conn->begin_transaction();
    $datetime = Date("Y-m-d") . " " . Date("H:i:s");
    $q = "INSERT INTO backup_guests (backup_datetime) VALUES ('$datetime')";
    $conn->query($q);

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
