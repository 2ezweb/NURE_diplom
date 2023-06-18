<?php
require_once('./php/functions.php');
require_once('./php/connection.php');
is_user_looged_in($_COOKIE['login_status']);
$current_user = $_COOKIE['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nure Classroom /// beta</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="./styles/normalize.css">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/adaptive.css">
</head>

<body>
    <div class="container">
        <header class="header">
            <nav class="header__menu">
                <div class="header__menu-button">
                    <div class="header__menu-row"></div>
                    <div class="header__menu-row"></div>
                    <div class="header__menu-row"></div>
                </div>
                <div class="header__year">
                    <p class="header__year-text">Навчальний рік</p>
                    <div class="header__year-value">22/23</div>
                </div>
                <a href="#" class="header__link">NURE.CLASSROOM /// BETA</a>
                <div class="header__messages">
                    <!-- <div class="header__message">
                        <img src="./content/mail.svg" alt="">
                        <div class="header__message-count">1</div>
                    </div> -->
                    <div class="header__time" id="clock">
                        <span class="header__time-hour"></span><span class="header__time-dbldot">:</span><span
                            class="header__time-minute"></span>
                    </div>
                </div>
            </nav>
            <div class="header__menu-button">
                <div class="header__menu-row"></div>
                <div class="header__menu-row"></div>
                <div class="header__menu-row"></div>
            </div>
        </header>
        <section class="main">
            <div class="user">
                <img class="user__avatar" src="./content/user/default_avatar.svg" alt="">
                <div class="user__nickname">
                    <span class="user__l-name">
                        <?php
                        $result = $conn->query("SELECT last_name FROM student WHERE mail='$current_user'");
                        echo $result->fetch_assoc()['last_name'];
                        ?>
                    </span>
                    <span class="user__f-name">
                        <?php
                        $result = $conn->query("SELECT first_name FROM student WHERE mail='$current_user'");
                        echo $result->fetch_assoc()['first_name'];
                        ?>
                    </span>
                    <span class="user__m-name">
                        <?php
                        $result = $conn->query("SELECT middle_name FROM student WHERE mail='$current_user'");
                        echo $result->fetch_assoc()['middle_name'];
                        ?>
                    </span>
                </div>
                <div class="user__group">
                    Группа: <span>
                        <?php
                        $result = $conn->query("SELECT group_name FROM groups_names 
                            JOIN groups_students ON groups_names.id_group=groups_students.id_group 
                            JOIN student ON groups_students.id_student=student.id_student WHERE mail='$current_user'");
                        echo $result->fetch_assoc()['group_name'];
                        ?>
                    </span>
                </div>
                <div class="user__ticket">
                    Квиток: <b>ХА</b> <span>
                        <?php
                        $result = $conn->query("SELECT id_student FROM student WHERE mail='$current_user'");
                        echo $result->fetch_assoc()['id_student'];
                        ?>
                    </span>
                </div>
                <div class="beta_version">[ Додаткова інформація буде доступна в релізній версії ]</div>
            </div>
            <div class="deadlines">
                <p class="deadlines__title">Найближчі дедлайни</p>

                <div class="deadlines__scroll-container">
                    <table class="deadlines__table">
                        <tr class="deadlines__row">
                            <th class="deadlines__column-title deadlines__cell">Дата</th>
                            <th class="deadlines__column-title deadlines__cell">Предмет</th>
                            <th class="deadlines__column-title deadlines__cell">Завдання</th>
                        </tr>
                        <?php
                        $result = $conn->query("SELECT tasks.task_name, DATE_FORMAT(tasks.task_deadline, '%d.%m.%Y') AS 'task_deadline', lessons.lesson_name FROM tasks
                            JOIN lessons ON lessons.id_lesson=tasks.id_lesson   
                            JOIN courses_body ON courses_body.id_lesson=lessons.id_lesson
                            JOIN groups_students ON groups_students.id_group=courses_body.id_group
                            JOIN student ON groups_students.id_student=student.id_student
                            WHERE student.mail='$current_user' AND tasks.id_student = student.id_student");
                        $rows = $result->num_rows;
                        for ($j = 0; $j < $rows; ++$j) {
                            $result->data_seek($j);
                            $task_deadline = $result->fetch_assoc()['task_deadline'];
                            $result->data_seek($j);
                            $task_name = $result->fetch_assoc()['task_name'];
                            $result->data_seek($j);
                            $lesson_name = $result->fetch_assoc()['lesson_name'];
                            echo <<<_FIRST
                                <tr class="deadlines__row">
                                    <td class="deadlines__cell deadlines__date">$task_deadline</td>
                                    <td class="deadlines__cell deadlines__lesson">$lesson_name</td>
                                    <td class="deadlines__cell deadlines__task">$task_name</td>
                                </tr>   
_FIRST;
                        }
                        ?>
                    </table>
                </div>
            </div>
        </section>
        <section class="information">
            <div class="lessons">
                <p class="lessons__title">Вимоги по предметах</p>
                <div class="lessons__body">
                    <?php
                    $result = $conn->query("SELECT lessons.lesson_name, lessons.lesson_fullname,
                    CONCAT(teacher.last_name,' ', LEFT(teacher.first_name, 1),'.', LEFT(teacher.middle_name, 1),'.') AS teacher_fullname FROM lessons
                    JOIN teacher ON teacher.id_teacher=lessons.id_teacher
                    JOIN courses_body ON courses_body.id_lesson=lessons.id_lesson 
                    JOIN groups_names ON groups_names.id_group=courses_body.id_group
                    JOIN groups_students ON groups_students.id_group=courses_body.id_group
                    JOIN student ON groups_students.id_student=student.id_student
                    WHERE student.mail='$current_user'");
                    $rows = $result->num_rows;
                    for ($j = 0; $j < $rows; ++$j) {
                        $result->data_seek($j);
                        $lesson_name = $result->fetch_assoc()['lesson_name'];
                        $result->data_seek($j);
                        $lesson_fullname = $result->fetch_assoc()['lesson_fullname'];
                        $result->data_seek($j);
                        $teacher = $result->fetch_assoc()['teacher_fullname'];
                        echo <<<_SECOND
                        <div class="lessons__lesson">
                            <div class="lessons__lesson-visible">
                                <div class="lessons__lesson-name">

<button class="lesson__button"><img src="./content/info.svg" alt="information button"></button>
                                    <span class="lessons__lesson-text">$lesson_name</span>
                                    <div class="lessons__popup">
                                        <div class="lessons__popup-title">
                                            <button class="lesson__button-close">
                                                <img src="./content/info_close.svg" alt="">
                                            </button>
                                            <span>$lesson_name</span>
                                        </div>
                                        <p class="lessons__popup-teacher">Викладач: <span>$teacher</span></p>
                                        <ul class="lessons__tasks-list">
                                            <li><span class="lessons__task-name">Лекцій: </span><span class="lessons__task-value">15</span></li>
                                            <li><span class="lessons__task-name">ЛБ: </span><span class="lessons__task-value">4</span></li>
                                            <li><span class="lessons__task-name">ПЗ: </span><span class="lessons__task-value">4</span></li>
                                            <li><span class="lessons__task-name">Контрольних: </span><span class="lessons__task-value">2</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="lessons__container">
                                    <div class="lessons__lesson-fullname">
                                        <span>$lesson_fullname</span>
                                        <button class="lesson__slider-button"><img src="./content/arrow.svg" alt="arrow"></button>
                                    </div>
                                    <ul class="lessons__lesson-list">
_SECOND;
                        $list = $conn->query("SELECT tasks.task_fullname, tasks.task_status FROM tasks
                            JOIN student ON tasks.id_student = student.id_student
                            JOIN lessons ON lessons.id_lesson = tasks.id_lesson
                            WHERE student.mail = '$current_user' AND lessons.lesson_fullname = '$lesson_fullname'");
                        $list_items = $list->num_rows;
                        for ($i = 0; $i < $list_items; ++$i) {
                            $list->data_seek($i);
                            $task_fullname = $list->fetch_assoc()['task_fullname'];
                            $list->data_seek($i);
                            $task_status = $list->fetch_assoc()['task_status'];
                            echo "<li><span>$task_fullname</span>";
                            if ($task_status) {
                                echo "<img src=\"./content/status/lessons_true.svg\" alt=\"\"></li>";
                            } else {
                                echo "<img src=\"./content/status/lessons_false.svg\" alt=\"\"></li>";
                            }
                        }
                        echo <<<_THIRD
                                    </ul>
                                </div>
                            </div>
                        </div>   
_THIRD;
                    }
                    ?>
                </div>
            </div>
            <div class="session">
                <div class="session__title">
                    <span>Сесія</span>
                    <div class="session__date">22/23</div>
                </div>
                <div class="session__body">
                    <div class="session__item">
                        <span class="session__name">МОАП</span>
                        <div class="session__status"><img src="./content/session_status/done.svg" alt=""></div>
                    </div>
                    <div class="session__item">

                        <span class="session__name">АЗКМ</span>
                        <div class="session__status"><img src="./content/session_status/failed.svg" alt=""></div>
                    </div>
                    <div class="session__item">
                        <span class="session__name">КСМ</span>
                        <div class="session__status">69/100</div>
                    </div>
                    <div class="session__item">
                        <span class="session__name">ЗіКСМ</span>
                        <div class="session__status"><img src="./content/session_status/inprogress.svg" alt=""></div>
                    </div>
                    <div class="session__item">
                        <span class="session__name">МОАП</span>
                        <div class="session__status"><img src="./content/session_status/done.svg" alt=""></div>
                    </div>
                    <div class="session__item">
                        <span class="session__name">АЗКМ</span>
                        <div class="session__status"><img src="./content/session_status/failed.svg" alt=""></div>
                    </div>
                    <div class="session__item">
                        <span class="session__name">КСМ</span>
                        <div class="session__status">69/100</div>
                    </div>
                    <div class="session__item">
                        <span class="session__name">ЗіКСМ</span>
                        <div class="session__status"><img src="./content/session_status/inprogress.svg" alt=""></div>
                    </div>
                    <div class="session__item">
                        <span class="session__name">МОАП</span>
                        <div class="session__status"><img src="./content/session_status/done.svg" alt=""></div>
                    </div>
                    <div class="session__item">
                        <span class="session__name">АЗКМ</span>
                        <div class="session__status"><img src="./content/session_status/failed.svg" alt=""></div>
                    </div>
                    <div class="session__item">
                        <span class="session__name">КСМ</span>
                        <div class="session__status">69/100</div>
                    </div>
                    <div class="session__item">
                        <span class="session__name">ЗіКСМ</span>
                        <div class="session__status"><img src="./content/session_status/inprogress.svg" alt=""></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="./js/main.js"></script>
    <script src="./js/clock.js"></script>
</body>

</html>