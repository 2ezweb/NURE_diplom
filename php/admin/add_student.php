<?php 
    require_once('../functions.php');
    require_once('../connection.php');

    $addStudent_id = get_post($conn, 'student_id');
    $addStudent_lastName = get_post($conn, 'student_lastName');
    $addStudent_firstName = get_post($conn, 'student_firstName');
    $addStudent_middleName = get_post($conn, 'student_middleName');
    $addStudent_mail = get_post($conn, 'student_mail');
    $addStudent_password = get_post($conn, 'student_password');
    $addStudent_status = get_post($conn, 'student_status');
    if($addStudent_status == 'Староста'){
        $addStudent_status = 1;
    }
    else{
        $addStudent_status = 2;
    }

    $stmt = $conn -> prepare("INSERT INTO student(id_student, last_name, first_name, middle_name, mail, password, avatar, id_status) VALUES(?, ?, ?, ?, ?, ?, NULL, ?)");
    $stmt->bind_param('ssssssi', $addStudent_id, $addStudent_lastName, $addStudent_firstName, $addStudent_middleName, $addStudent_mail, $addStudent_password, $addStudent_status);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    echo '<script> document.location.href=\'../../admin.php\';</script>';

?>
