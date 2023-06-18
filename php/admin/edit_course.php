<?php
    require_once('../connection.php');
    require_once('../functions.php');
    class Lesson{
        public $shortName, $longName, $teacherId;
    }
    $lesson = new Lesson;

    $addCourse_idCourse = get_post($conn, 'idCourse');
    $addCourse_idGroup = $_POST['idGroup'];
    $addCourse_shortLesson = $_POST['shortLesson'];
    $addCourse_longLesson = $_POST['longLesson'];
    $addCourse_teacherLesson = $_POST['teacherLesson'];
    
    


    $course = $conn->prepare("INSERT INTO courses_names(id_course, course_name) VALUES(NULL, ?)");
    $course->bind_param('s', $addCourse_idCourse);
    $course->execute();
    $course->close();

    $course_request = $conn -> query("SELECT id_course FROM courses_names WHERE course_name = '$addCourse_idCourse'");
    $course_request -> data_seek(0);
    $course_id = $course_request -> fetch_assoc()['id_course'];

    for ($i = 0; $i < count($addCourse_shortLesson); ++$i) {
        $teacher_request = $conn->query("SELECT id_teacher FROM teacher WHERE CONCAT(last_name, ' ', LEFT(first_name, 1), '.', LEFT(middle_name, 1), '.') = '$addCourse_teacherLesson[$i]'");
        $teacher_request->data_seek($i);
        $teacher_id = $teacher_request->fetch_assoc()['id_teacher'];
        $lesson_body = $conn->prepare("INSERT INTO lessons(id_lesson, lesson_name, id_teacher, lesson_fullname) VALUES(NULL, ?, ?, ?)");
        $lesson_body->bind_param('sis', $addCourse_shortLesson[$i], $teacher_id, $addCourse_longLesson[$i]);
        $lesson_body->execute();
        $lesson_body->close();
        $lesson_request = $conn->query("SELECT id_lesson FROM lessons WHERE lesson_name = '$addCourse_shortLesson[$i]'");
        $lesson_request->data_seek(0);
        $lesson_id = $lesson_request->fetch_assoc()['id_lesson'];
        
        foreach ($addCourse_idGroup as $group) {
            $group_request = $conn->prepare("INSERT INTO courses_body(id_course, id_lesson, id_group) VALUES(?, ?, ?)");
            $group_request->bind_param('iii', $course_id, $lesson_id, $group);
            $group_request->execute();
            $group_request->close();
        }
    }
    echo '<script> document.location.href=\'../../admin.php\';</script>';

