<?php
    require_once('../functions.php');
    require_once('../connection.php');
    $group_name = get_post($conn, 'group');
    $student_fullname = get_post($conn, 'studentFullname');
    $lesson_name = get_post($conn, 'lessonName');
    echo "<tr class=\"modal__table-row\">
    <th class=\"modal__table-cell\">№</th>
    <th class=\"modal__table-cell\">Статус</th>
    <th class=\"modal__table-cell\">Студент</th>
    <th class=\"modal__table-cell\">Допуск до сесії</th>
    </tr>";
    $access = $conn -> query("SELECT CONCAT(student.last_name,' ', LEFT(student.first_name, 1),'.', LEFT(student.middle_name, 1),'.') AS student_fullname, student_status.status_name FROM student
        JOIN student_status ON student.id_status = student_status.id_status
        JOIN groups_students ON groups_students.id_student = student.id_student
        JOIN groups_names ON groups_names.id_group = groups_students.id_group
        WHERE CONCAT(student.last_name,' ', LEFT(student.first_name, 1),'.', LEFT(student.middle_name, 1),'.') = '$student_fullname' AND groups_names.group_name = '$group_name'");
    $access_length = $access->num_rows;
    for($i = 0; $i < $access_length; ++$i){
        $access->data_seek($i);
        $student_fullname = $access -> fetch_assoc()['student_fullname'];
        $access->data_seek($i);
        $student_status = $access -> fetch_assoc()['status_name'];
        $tasks = $conn -> query("SELECT tasks.task_status, student_status.status_name, CONCAT(student.last_name,' ', LEFT(student.first_name, 1),'.', LEFT(student.middle_name, 1),'.') AS student_fullname FROM tasks
            JOIN lessons ON tasks.id_lesson = lessons.id_lesson 
            JOIN student ON tasks.id_student = student.id_student 
            JOIN student_status ON student.id_status = student_status.id_status
            JOIN groups_students ON student.id_student = groups_students.id_student
            JOIN groups_names ON groups_students.id_group = groups_names.id_group
            WHERE CONCAT(student.last_name,' ', LEFT(student.first_name, 1),'.', LEFT(student.middle_name, 1),'.') = '$student_fullname'
            AND lessons.lesson_fullname = '$lesson_name' AND groups_names.group_name = '$group_name'");
       
        $index = $i + 1;
        echo <<< _ACCESS
        <tr class="modal__table-row">
            <td class="modal__table-cell">$index</td>
            <td class="modal__table-cell modal__cell-status">$student_status</td>
            <td class="modal__table-cell">$student_fullname</td>
_ACCESS;
        for ($j = 0; $j < $tasks -> num_rows; ++$j){
            $tasks->data_seek($j);
            $task_status = $tasks -> fetch_assoc()['task_status'];
            if ($task_status == 0){
                $access_status = 0;
                break;
            }
            else{
                $access_status = 1;
            }
        }
        if($access_status == 1){
            echo "<td class=\"modal__table-cell modal__cell-access\">Допуск</td>";
        }
        else{
            echo "<td class=\"modal__table-cell modal__cell-access\">Немає допуску</td>";
        }
        echo "</tr>";
        }

?>






<?php
require_once('../functions.php');
require_once('../connection.php');
$group_name = get_post($conn, 'group');
$result = $conn->query("SELECT CONCAT(student.last_name,' ', LEFT(student.first_name, 1),'.', LEFT(student.middle_name, 1),'.') AS student_fullname FROM groups_students
JOIN groups_names ON groups_names.id_group=groups_students.id_group
JOIN student ON groups_students.id_student=student.id_student
WHERE groups_names.group_name = '$group_name'");
$rows = $result->num_rows;
echo "<tr class=\"modal__table-row\">
<th class=\"modal__table-cell\">№</th>
<th class=\"modal__table-cell\">Студент</th>
<th class=\"modal__table-cell\">Виконання завдань</th>
<th class=\"modal__table-cell\">Функції</th>
</tr>";
for ($j = 0; $j < $rows; ++$j) {
    $result->data_seek($j);
    $student_fullname = $result->fetch_assoc()['student_fullname'];
    $index = ++$j;
    $tasks = $conn->query("SELECT tasks.task_name, tasks.task_status FROM tasks
    JOIN lessons ON lessons.id_lesson=tasks.id_lesson
    JOIN teacher ON teacher.id_teacher=lessons.id_teacher
    JOIN courses_body ON courses_body.id_lesson=lessons.id_lesson 
    JOIN groups_names ON groups_names.id_group=courses_body.id_group
    JOIN groups_students ON groups_students.id_group=courses_body.id_group
    JOIN student ON groups_students.id_student=student.id_student
    WHERE groups_names.group_name = '$group_name' AND CONCAT(student.last_name,' ', LEFT(student.first_name, 1),'.', LEFT(student.middle_name, 1),'.') = '$student_fullname'");

    $items = $tasks->num_rows;

    echo <<< _RESULT
        <tr class="modal__table-row">
            <td class="modal__table-cell">$index</td>
            <td class="modal__table-cell modal__cell-studentFullname">$student_fullname</td>
            <td class="modal__table-cell">
                <ul class="modal__tasks-list">
_RESULT;

    for ($i = 0; $i < $items; ++$i) {
        $tasks->data_seek($i);
        $task_name = $tasks->fetch_assoc()['task_name'];
        $tasks->data_seek($i);
        $task_status = $tasks->fetch_assoc()['task_status'];

        echo "<li class=\"modal__tasks-item\"><span class=\"modal__item-text\">$task_name</span>";

        if ($task_status == 0) {
            echo "<img src=\"./content/status/lessons_false.svg\" alt=\"\" class=\"modal__item-status --false\">";
        } else {
            echo "<img src=\"./content/status/lessons_true.svg\" alt=\"\" class=\"modal__item-status --true\">";
        }

        echo "</li>";
    }

    echo <<< _LIST
                </ul>
                <form class="modal__tasks-edit" id="modalTaskEdit" action="" method="post">
                    <ul class="modal__tasks-list">
_LIST;

    for ($i = 0; $i < $items; ++$i) {
        $tasks->data_seek($i);
        $task_name = $tasks->fetch_assoc()['task_name'];
        $tasks->data_seek($i);
        $task_status = $tasks->fetch_assoc()['task_status'];

        echo "<li class=\"modal__tasks-item modal__tasks-itemEdit\"><span class=\"modal__tasks-text\">$task_name</span>";

        if ($task_status == 0) {
            echo "<input type=\"checkbox\" name=\"task$i\" id=\"task$i\"><label for=\"task$i\"><img src=\"./content/status/lessons_true.svg\" alt=\"\"></label>";
        } else {
            echo "<input type=\"checkbox\" checked name=\"task$i\" id=\"task$i\"><label for=\"task$i\"><img src=\"./content/status/lessons_true.svg\" alt=\"\"></label>";
        }

        echo "</li>";
    }

    echo <<< _END
                    </ul>
                </form>
            </td>
            <td class="modal__table-cell modal__cell-edit">
                <div class="modal__cell-group">
                <button class="editBtn">Скорегувати</button>
                <input class="editConfirm" type="submit" value="Підтвердити зміни">
                </div>
            </td>
        </tr>
_END;
}
?>