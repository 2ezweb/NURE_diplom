SELECT tasks.task_name, tasks.task_status FROM tasks
JOIN lessons ON lessons.id_lesson=tasks.id_lesson
JOIN teacher ON teacher.id_teacher=lessons.id_teacher
JOIN courses_body ON courses_body.id_lesson=lessons.id_lesson 
JOIN groups_names ON groups_names.id_group=courses_body.id_group
JOIN groups_students ON groups_students.id_group=courses_body.id_group
JOIN student ON groups_students.id_student=student.id_student
WHERE student.last_name = 'Ладоня' AND student.first_name LIKE 'В%' AND student.middle_name LIKE 'С%' AND groups_names.group_name = 'КІУКІу-20-1'



SELECT tasks.task_name, tasks.task_status FROM tasks
NATURAL JOIN student
NATURAL JOIN groups_students
NATURAL JOIN groups_names
NATURAL JOIN lessons
NATURAL JOIN courses_body
NATURAL JOIN teacher
WHERE student.last_name = 'Ладоня'



// $result = $conn->query("SELECT CONCAT(student.last_name,' ', LEFT(student.first_name, 1),'.', LEFT(student.middle_name, 1),'.') AS student_fullname FROM groups_students
//     JOIN lessons ON lessons.id_lesson=tasks.id_lesson
//     JOIN teacher ON teacher.id_teacher=lessons.id_teacher
//     JOIN courses_body ON courses_body.id_lesson=lessons.id_lesson 
//     JOIN groups_names ON groups_names.id_group=courses_body.id_group
//     JOIN groups_students ON groups_students.id_group=courses_body.id_group
//     JOIN student ON groups_students.id_student=student.id_student
//     WHERE groups_names.group_name = '$group_name'");