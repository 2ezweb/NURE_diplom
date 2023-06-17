<?php 
    require_once('../functions.php');
    require_once('../connection.php');

    $addTeacher_lastName = get_post($conn, 'teacher_lastName');
    $addTeacher_firstName = get_post($conn, 'teacher_firstName');
    $addTeacher_middleName = get_post($conn, 'teacher_middleName');
    $addTeacher_mail = get_post($conn, 'teacher_mail');
    $addTeacher_password = get_post($conn, 'teacher_password');
    $addTeacher_class = get_post($conn, 'teacher_class');

    $stmt = $conn -> prepare("INSERT INTO teacher(last_name, first_name, middle_name, mail, password, avatar, teacher_class) VALUES( ?, ?, ?, ?, ?, NULL, ?)");
    $stmt->bind_param('ssssss', $addTeacher_lastName, $addTeacher_firstName, $addTeacher_middleName, $addTeacher_mail, $addTeacher_password, $addTeacher_class);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    echo '<script> document.location.href=\'../../admin.php\';</script>';

?>
