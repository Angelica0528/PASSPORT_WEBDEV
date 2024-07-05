<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];

    $appointmentsFile = 'appointments.json';
    if (!file_exists($appointmentsFile)) {
        file_put_contents($appointmentsFile, json_encode([]));
    }

    $appointments = json_decode(file_get_contents($appointmentsFile), true);

    if (!isset($appointments[$date])) {
        $appointments[$date] = [];
    }

    $appointments[$date][] = [$startTime, $endTime];

    file_put_contents($appointmentsFile, json_encode($appointments));
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
