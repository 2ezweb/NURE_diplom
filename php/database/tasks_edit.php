<?php
require_once('../functions.php');
require_once('../connection.php');

$studentName = get_post($conn, 'studentName');
$tasks = $_POST['tasks'];
foreach ($tasks as $taskName => $taskStatus) {
    $stmt = $conn->prepare("UPDATE tasks
                            JOIN student ON tasks.id_student = student.id_student
                            SET tasks.task_status = ?
                            WHERE tasks.task_name = ? AND CONCAT(student.last_name, ' ', LEFT(student.first_name, 1), '.', LEFT(student.middle_name, 1), '.') = ?");
    $stmt->bind_param('sss', $taskStatus, $taskName, $studentName);
    $stmt->execute();
}
$stmt->close();
$conn->close();
?>