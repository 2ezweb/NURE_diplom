<?php 
    require_once('../connection.php');
    require_once('../functions.php');

    $student = get_post($conn, 'student');
    $id_student = get_post($conn, 'idStudent');
    $student_lastname = get_post($conn, 'studentLastname');
    $student_firstname = get_post($conn, 'studentFirstname');
    $student_middlename = get_post($conn, 'studentMiddlename');
    $student_mail = get_post($conn, 'studentMail');
    $student_password = get_post($conn, 'studentPass');
    $student_status = get_post($conn, 'studentStatus');

    $edit_request = $conn -> prepare("UPDATE student SET id_student = ?, last_name = ?, first_name = ?, middle_name = ?, mail = ?, password = ?, id_status = ? WHERE CONCAT(last_name, ' ', LEFT(first_name, 1), '.', LEFT(middle_name, 1), '.') = '$student'");
    $edit_request -> bind_param('isssssi', $id_student, $student_lastname, $student_firstname, $student_middlename, $student_mail, $student_password, $student_status);
    $edit_request -> execute();


    echo '<script> document.location.href=\'../../admin.php\';</script>';

?>