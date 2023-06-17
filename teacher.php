<?php
require_once('./php/functions.php');
require_once('./php/connection.php');
// is_user_looged_in($_COOKIE['login_status']);
// $current_user = $_COOKIE['user'];
$current_user = 'olga.eroshenko@nure.ua';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nure Classroom /// beta</title>
    <link rel="icon" type="image/png" href="favicon.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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
                    <div class="header__message">
                        <img src="./content/mail.svg" alt="">
                        <div class="header__message-count">1</div>
                    </div>
                    <div class="header__time" id="clock">
                        <span class="header__time-hour"></span><span class="header__time-dbldot">:</span><span class="header__time-minute"></span>
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
                        $result = $conn->query("SELECT last_name FROM teacher WHERE mail='$current_user'");
                        echo $result->fetch_assoc()['last_name'];
                        ?>
                    </span>
                    <span class="user__f-name">
                        <?php
                        $result = $conn->query("SELECT first_name FROM teacher WHERE mail='$current_user'");
                        echo $result->fetch_assoc()['first_name'];
                        ?>
                    </span>
                    <span class="user__m-name">
                        <?php
                        $result = $conn->query("SELECT middle_name FROM teacher WHERE mail='$current_user'");
                        echo $result->fetch_assoc()['middle_name'];
                        ?>
                    </span>
                </div>
                <div class="user__group">
                    <?php
                    $result = $conn->query("SELECT teacher_class FROM teacher WHERE mail='$current_user'");
                    echo $student_id = $result->fetch_assoc()['teacher_class'];
                    ?>
                </div>
                <div class="beta_version">[ Додаткова інформація буде доступна в релізній версії ]</div>
            </div>
            <div class="deadlines">
                <p class="deadlines__title">Найближчі дедлайни</p>
                <div class="deadlines__scroll-container">
                    <table class="deadlines__table">
                        <tr class="deadlines__row">
                            <th class="deadlines__column-title deadlines__cell">Дата</th>
                            <th class="deadlines__column-title deadlines__cell">Група</th>
                            <th class="deadlines__column-title deadlines__cell">Предмет</th>
                            <th class="deadlines__column-title deadlines__cell">Завдання</th>
                        </tr>
                        <?php

                        $sql = $conn->query("SELECT tasks.task_name, DATE_FORMAT(tasks.task_deadline, '%d.%m.%Y') AS 'task_deadline', lessons.lesson_name, groups_names.group_name FROM tasks
                            JOIN student ON student.id_student = tasks.id_student
                            JOIN groups_students ON groups_students.id_student = student.id_student
                            JOIN groups_names ON groups_names.id_group = groups_students.id_group
                            JOIN lessons ON lessons.id_lesson = tasks.id_lesson
                            JOIN teacher ON teacher.id_teacher = lessons.id_teacher
                            WHERE teacher.mail = '$current_user'");
                        for ($c = 0; $c < $sql->num_rows; ++$c) {
                            echo "<tr class=\"deadlines__row\">";
                            $sql->data_seek($c);
                            $table_task = $sql->fetch_assoc()['task_name'];
                            $sql->data_seek($c);
                            $table_deadline = $sql->fetch_assoc()['task_deadline'];
                            $sql->data_seek($c);
                            $table_lesson = $sql->fetch_assoc()['lesson_name'];
                            $sql->data_seek($c);
                            $table_group = $sql->fetch_assoc()['group_name'];
                            echo <<< _TABLE
                                <td class="deadlines__cell deadlines__date">$table_deadline</td>
                                <td class="deadlines__cell deadlines__group">$table_group</td>
                                <td class="deadlines__cell deadlines__lesson">$table_lesson</td>
                                <td class="deadlines__cell deadlines__task">$table_task</td>
_TABLE;
                            echo "</tr>";
                        }

                        ?>

                    </table>
                </div>
            </div>
        </section>
        <section class="information">
            <div class="lessons">
                <p class="lessons__title">Групи, в яких викладаєте</p>
                <div class="lessons__body">
                    <?php
                    $request = $conn->query("SELECT lessons.lesson_fullname, groups_names.group_name FROM lessons
                            JOIN courses_body ON courses_body.id_lesson = lessons.id_lesson 
                            JOIN groups_names ON groups_names.id_group = courses_body.id_group
                            JOIN teacher ON lessons.id_teacher = teacher.id_teacher
                            WHERE teacher.mail = '$current_user'");
                    for ($t = 0; $t < $request->num_rows; ++$t) {
                        $request->data_seek($t);
                        $list_groupName = $request->fetch_assoc()['group_name'];
                        $request->data_seek($t);
                        $list_lessonName = $request->fetch_assoc()['lesson_fullname'];
                        echo    "<div class=\"lessons__lesson\">
                                        <div class=\"lessons__lesson-visible\">
                                            <div class=\"lessons__lesson-name\">
                                                <span class=\"lessons__lesson-text\">$list_groupName</span>
                                            </div>
                                            <div class=\"lessons__container\">
                                                <div class=\"lessons__lesson-fullname\">
                                                    <span>$list_lessonName</span>
                                                    <button class=\"lesson__slider-button\"><img src=\"./content/arrow.svg\" alt=\"arrow\"></button>
                                                </div>
                                                <ul class=\"lessons__lesson-list lessons-teacher__lesson-list\">
                                                    <li><span class=\"openmodal-btn__access\">Допуск до сесії</span></li>
                                                    <li><span class=\"openmodal-btn__tasks\">Залік завдань</span></li>
                                                    <li><span class=\"openmodal-btn__control\">Керування групою</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                   ";
                    }
                    ?>

                </div>
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
                <span class="session__date">24.02</span>
                <div class="session__status session__status-teacher"><img src="./content/session_status/done.svg" alt=""></div>
            </div>
            <div class="session__item">
                <span class="session__name">АЗКМ</span>
                <span class="session__date">24.02</span>
                <div class="session__status session__status-teacher"></div>
            </div>
            <div class="session__item">
                <span class="session__name">КСМ</span>
                <span class="session__date">24.02</span>
                <div class="session__status">69/100</div>
            </div>
            <div class="session__item">
                <span class="session__name">ЗіКСМ</span>
                <span class="session__date">24.02</span>
                <div class="session__status session__status-teacher"></div>
            </div>
        </div>
    </div>
    </section>
    </div>

    <div class="modals">
        <div class="modal access">
            <button class="modal__close" onclick="closeModals()">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.496 0H6.293L10.788 6.572L15.283 0H21.173L13.95 10.385L21.762 21.7H15.841L10.788 14.508L5.797 21.7H0L7.75 10.602L0.496 0Z" fill="white" />
                </svg>
            </button>
            <b class="modal__title">Допуск до сесії</b>
            <p class="modal__subtitle">Група: <span class="modal__groupName"></span></p>
            <div class="modal__scroll-container">
                <div class="deadlines__scroll-container">
                    <table class="modal__table">

                    </table>
                </div>
            </div>
        </div>
        <div class="modal tasks">
            <button class="modal__close" onclick="closeModals()">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.496 0H6.293L10.788 6.572L15.283 0H21.173L13.95 10.385L21.762 21.7H15.841L10.788 14.508L5.797 21.7H0L7.75 10.602L0.496 0Z" fill="white" />
                </svg>
            </button>
            <b class="modal__title">Успішність студентів</b>
            <input type="hidden" name="" class="modal__hidden-groupname" value="КІУКІу-20-1">
            <div class="deadlines__scroll-container">
                <div class="deadlines__scroll-container">
                    <table class="modal__table">

                    </table>
                </div>
            </div>

        </div>
        <div class="modal control">
            <button class="modal__close" onclick="closeModals()">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.496 0H6.293L10.788 6.572L15.283 0H21.173L13.95 10.385L21.762 21.7H15.841L10.788 14.508L5.797 21.7H0L7.75 10.602L0.496 0Z" fill="white" />
                </svg>
            </button>
            <b class="modal__title">Керування групою</b>
            <div class="modal__scroll-container">
                <div class="deadlines__scroll-container">
                    <table class="modal__table">
                        <tr class="modal__table-row">
                            <th class="modal__table-cell">№</th>
                            <th class="modal__table-cell">Студент</th>
                            <th class="modal__table-cell">Дії</th>
                        </tr>
                        <tr class="modal__table-row">
                            <td class="modal__table-cell">1</td>
                            <td class="modal__table-cell">Могильний А.Б.</td>
                            <td class="modal__table-cell modal__cell-edit">Надіслати лист</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="./js/main.js"></script>
    <script src="./js/clock.js"></script>
    <script src="./js/forms.js"></script>
</body>

</html>