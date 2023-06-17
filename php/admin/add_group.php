<?php 
    require_once('../functions.php');
    require_once('../connection.php');

    $addGroup_id = get_post($conn, 'group_id');
    $addGroup_name = get_post($conn, 'group_name');
    $addGroup_students = $_POST['group_students'];
    $data_request = $conn -> prepare("INSERT INTO groups_names(id_group, group_name) VALUES(?, ?)");
    $data_request -> bind_param('is', $addGroup_id, $addGroup_name);
    $data_request->execute();
    
    for ($i = 0; $i < count($addGroup_students); ++$i) {
        $stmt = $conn->prepare("INSERT INTO groups_students(id_group, id_student) VALUES(?, ?)");
        $temporary_student = $addGroup_students[$i];
        $stmt->bind_param('ii', $addGroup_id, $temporary_student);
        $stmt->execute();
        $stmt->close();
    }
    
    
    $conn->close();

    echo '<script> document.location.href=\'../../admin.php\';</script>';
?>