<?php
    require_once('../connection.php');
    require_once('../functions.php');

    $group = get_post($conn, 'group');
    $group_id = get_post($conn, 'groupId');
    $group_name = get_post($conn, 'groupName');
    $students = $_POST['editGroupStudent'];

    $edit_request = $conn -> prepare("UPDATE groups_names SET id_group = ?, group_name = ? WHERE group_name = '$group'");
    $edit_request -> bind_param('is', $group_id, $group_name);
    $edit_request -> execute();
    $edit_request -> close();

    for($i = 0; $i < count($students); ++$i){
        $add_student = $conn -> prepare("INSERT INTO groups_students(id_group, id_student) VALUES(?,?)");
        $add_student -> bind_param('ii', $group_id, $students[$i]);
        $add_student -> execute();
        $add_student -> close();
    }
    
    echo '<script> document.location.href=\'../../admin.php\';</script>';

?>