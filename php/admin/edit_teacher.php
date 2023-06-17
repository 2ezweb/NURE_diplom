<?php 
    require_once('../connection.php');
    require_once('../functions.php');

    $teacher = get_post($conn, 'teacher');
    $id_teacher = get_post($conn, 'idTeacher');
    $teacher_lastname = get_post($conn, 'teacherLastname');
    $teacher_firstname = get_post($conn, 'teacherFirstname');
    $teacher_middlename = get_post($conn, 'teacherMiddlename');
    $teacher_mail = get_post($conn, 'teacherMail');
    $teacher_password = get_post($conn, 'teacherPass');
    $teacher_status = get_post($conn, 'teacherStatus');

    $edit_request = $conn -> prepare("UPDATE teacher SET id_teacher = ?, last_name = ?, first_name = ?, middle_name = ?, mail = ?, password = ?, teacher_class = ? WHERE CONCAT(last_name, ' ', LEFT(first_name, 1), '.', LEFT(middle_name, 1), '.') = '$teacher'");
    $edit_request -> bind_param('issssss', $id_teacher, $teacher_lastname, $teacher_firstname, $teacher_middlename, $teacher_mail, $teacher_password, $teacher_status);
    $edit_request -> execute();


    echo '<script> document.location.href=\'../../admin.php\';</script>';

?>