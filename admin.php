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
                    <div class="header__message">
                        <img src="./content/mail.svg" alt="">
                        <div class="header__message-count">1</div>
                    </div>
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
        <div class="admin">
            <section class="admin__aside">
                <div class="user">
                    <img class="user__avatar" src="./content/user/default_avatar.svg" alt="">
                    <div class="user__nickname">
                        <span class="user__l-name">
                            Ляшенко
                        </span>
                        <span class="user__f-name">
                            Олексій
                        </span>
                        <span class="user__m-name">
                            Сергійович
                        </span>
                    </div>
                    <div class="user__ticket">
                        <span>Адміністратор сайту</span>
                    </div>
                    <div class="beta_version">[ Додаткова інформація буде доступна в релізній версії ]</div>
                </div>
                <div class="control">
                    <h2 class="control__title">Панель управління</h2>
                    <div class="control__buttons">
                        <div class="control__button-outer">
                            <span>Студент</span>
                            <div class="control__button-inner">
                                <button class="openmodal__adminStudentAdd">Додати</button>
                                <button class="openmodal__adminStudentEdit">Змінити</button>
                            </div>
                            <button class="control__button-switch">
                                +
                            </button>
                        </div>
                        <div class="control__button-outer">
                            <span>Група</span>
                            <div class="control__button-inner">
                                <button class="openmodal__adminGroupAdd">Додати</button>
                                <button class="openmodal__adminGroupEdit">Змінити</button>
                            </div>
                            <button class="control__button-switch">
                                +
                            </button>
                        </div>
                        <div class="control__button-outer">
                            <span>Викладач</span>
                            <div class="control__button-inner">
                                <button class="openmodal__adminTeacherAdd">Додати</button>
                                <button class="openmodal__adminTeacherEdit">Змінити</button>
                            </div>
                            <button class="control__button-switch">
                                +
                            </button>
                        </div>
                        <div class="control__button-outer">
                            <span>Курс</span>
                            <div class="control__button-inner">
                                <button class="openmodal__adminCourseAdd">Додати</button>
                                <button class="openmodal__adminCourseEdit">Змінити</button>
                            </div>
                            <button class="control__button-switch">
                                +
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <div class="deadlines admin__table">
                <p class="deadlines__title">Дані про університет</p>
                <div class="deadlines__scroll-container">
                    <table class="deadlines__table">
                        <tr class="deadlines__row">
                            <th class="deadlines__column-title deadlines__cell">Викладачі</th>
                            <th class="deadlines__column-title deadlines__cell">Студенти</th>
                            <th class="deadlines__column-title deadlines__cell">Групи</th>
                            <th class="deadlines__column-title deadlines__cell">Курси</th>
                        </tr>
                        <tr class="deadlines__row">
                            <td class="deadlines__cell deadlines__date">Войтенко Ю.Ю.</td>
                            <td class="deadlines__cell deadlines__lesson">Ладоня В.С.</td>
                            <td class="deadlines__cell deadlines__task">КІУКІу-20-1</td>
                            <td class="deadlines__cell deadlines__task">Комп’ютерна інженерія - 2023</td>
                        </tr>
                        <tr class="deadlines__row">
                            <td class="deadlines__cell deadlines__date">Войтенко Ю.Ю.</td>
                            <td class="deadlines__cell deadlines__lesson">Ладоня В.С.</td>
                            <td class="deadlines__cell deadlines__task">КІУКІу-20-1</td>
                            <td class="deadlines__cell deadlines__task">Комп’ютерна інженерія - 2023</td>
                        </tr>
                        <tr class="deadlines__row">
                            <td class="deadlines__cell deadlines__date">Войтенко Ю.Ю.</td>
                            <td class="deadlines__cell deadlines__lesson">Ладоня В.С.</td>
                            <td class="deadlines__cell deadlines__task">КІУКІу-20-1</td>
                            <td class="deadlines__cell deadlines__task">Комп’ютерна інженерія - 2023</td>
                        </tr>
                        <tr class="deadlines__row">
                            <td class="deadlines__cell deadlines__date">Войтенко Ю.Ю.</td>
                            <td class="deadlines__cell deadlines__lesson">Ладоня В.С.</td>
                            <td class="deadlines__cell deadlines__task">КІУКІу-20-1</td>
                            <td class="deadlines__cell deadlines__task">Комп’ютерна інженерія - 2023</td>
                        </tr>
                        <tr class="deadlines__row">
                            <td class="deadlines__cell deadlines__date">Войтенко Ю.Ю.</td>
                            <td class="deadlines__cell deadlines__lesson">Ладоня В.С.</td>
                            <td class="deadlines__cell deadlines__task">КІУКІу-20-1</td>
                            <td class="deadlines__cell deadlines__task">Комп’ютерна інженерія - 2023</td>
                        </tr>
                        <tr class="deadlines__row">
                            <td class="deadlines__cell deadlines__date">Войтенко Ю.Ю.</td>
                            <td class="deadlines__cell deadlines__lesson">Ладоня В.С.</td>
                            <td class="deadlines__cell deadlines__task">КІУКІу-20-1</td>
                            <td class="deadlines__cell deadlines__task">Комп’ютерна інженерія - 2023</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modals">
        <div class="modal adminStudentAdd">
            <button class="modal__close" onclick="closeModals()">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.496 0H6.293L10.788 6.572L15.283 0H21.173L13.95 10.385L21.762 21.7H15.841L10.788 14.508L5.797 21.7H0L7.75 10.602L0.496 0Z"
                        fill="white" />
                </svg>
            </button>
            <b class="modal__title">
                Додати студента
            </b>
            <div class="modal__scroll-container">
                <form action="./php/admin/add_student.php" class="modal__admin-form" method="post">
                    <input type="text" name="student_id" class="modal__addForm-row" placeholder="Введіть номер студентського">
                    <input type="text" name="student_lastName" class="modal__addForm-row" placeholder="Введіть прізвище студента">
                    <input type="text" name="student_firstName" class="modal__addForm-row" placeholder="Введіть ім'я студента">
                    <input type="text" name="student_middleName" class="modal__addForm-row" placeholder="Введіть по-батькові студента">
                    <input type="text" name="student_mail" class="modal__addForm-row" placeholder="Введіть почту студента">
                    <input type="text" name="student_password" class="modal__addForm-row" placeholder="Введіть пароль студента">
                    <input type="text" name="student_status" class="modal__addForm-row" placeholder="Введіть статус студента">
                    <button type="submit" class="modal__form-blueBtn">Додати</button>
                </form>
            </div>
        </div>
        <div class="modal adminGroupAdd">
            <button class="modal__close" onclick="closeModals()">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.496 0H6.293L10.788 6.572L15.283 0H21.173L13.95 10.385L21.762 21.7H15.841L10.788 14.508L5.797 21.7H0L7.75 10.602L0.496 0Z"
                        fill="white" />
                </svg>
            </button>
            <b class="modal__title">
                Додати групу
            </b>
            <div class="modal__scroll-container">
                <form action="./php/admin/add_group.php" class="modal__admin-form" method="post">
                    <input type="text" name="group_id" class="modal__addForm-row" placeholder="Введіть ідентифікатор групи">
                    <input type="text" name="group_name" class="modal__addForm-row" placeholder="Введіть назву групи">
                    <b class="modal__subtitle">Введіть ідентифікатори студентів</b>
                    <div class="modal__addForm-studentsNames">
                        <input type="text" name="group_students[]" class="modal__addForm-row" placeholder="Введіть ідентифікатор студента">
                    </div>
                    <div class="addForm__newItem" id="newGroupStudent">Додати ще одного студента</div>
                    <button type="submit" class="modal__form-blueBtn">Додати</button>
                </form>
            </div>
        </div>
        <div class="modal adminTeacherAdd">
            <button class="modal__close" onclick="closeModals()">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.496 0H6.293L10.788 6.572L15.283 0H21.173L13.95 10.385L21.762 21.7H15.841L10.788 14.508L5.797 21.7H0L7.75 10.602L0.496 0Z"
                        fill="white" />
                </svg>
            </button>
            <b class="modal__title">
                Додати викладача
            </b>
            <div class="modal__scroll-container">
                <form action="./php/admin/add_teacher.php" class="modal__admin-form" method="post">
                    <input type="text" name="teacher_lastName" class="modal__addForm-row" placeholder="Введіть прізвище викладача">
                    <input type="text" name="teacher_firstName" class="modal__addForm-row" placeholder="Введіть ім'я викладача">
                    <input type="text" name="teacher_middleName" class="modal__addForm-row" placeholder="Введіть по-батькові викладача">
                    <input type="text" name="teacher_mail" class="modal__addForm-row" placeholder="Введіть почту викладача">
                    <input type="text" name="teacher_password" class="modal__addForm-row" placeholder="Введіть пароль викладача">
                    <input type="text" name="teacher_class" class="modal__addForm-row" placeholder="Введіть клас викладача">
                    <button type="submit" class="modal__form-blueBtn">Додати</button>
                </form>
            </div>
        </div>
        <div class="modal adminCourseAdd">
            <button class="modal__close" onclick="closeModals()">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.496 0H6.293L10.788 6.572L15.283 0H21.173L13.95 10.385L21.762 21.7H15.841L10.788 14.508L5.797 21.7H0L7.75 10.602L0.496 0Z"
                        fill="white" />
                </svg>
            </button>
            <b class="modal__title">
                Додати курс
            </b>
            <div class="modal__scroll-container">
                <form action="./php/admin/add_course.php" class="modal__admin-form" method="post">
                    <b class="modal__subtitle">Інформація про курс</b>
                    <input type="text" name="idCourse" class="modal__addForm-row" placeholder="Введіть назву курса">
                    <b class="modal__subtitle">Групи</b>
                    <div class="modal__addForm-groupsNames">
                        <input type="text" name="idGroup[]" class="modal__addForm-row" placeholder="Введіть ідентифікатор групи">
                    </div>
                    <div class="addForm__newItem" id="newCourseGroup">Додати ще одну групу</div>
                    <b class="modal__subtitle">Предмети</b>
                    <div class="modal__addForm-lessons">
                        <div class="modal_addForm-groupsPairs">
                            <input type="text" name="shortLesson[]" class="modal__addForm-row" placeholder="Введіть абревіатуру предмета">
                            <input type="text" name="teacherLesson[]" class="modal__addForm-row" placeholder="Введіть викладача">
                        </div>
                        <input type="text" name="longLesson[]" class="modal__addForm-row" placeholder="Введіть повну назву предмета">
                    </div>
                    <div class="addForm__newItem" id="newCourseLesson">Додати ще один предмет</div>
                    <button type="submit" class="modal__form-blueBtn">Додати</button>
                </form>
            </div>
        </div>
        <div class="modal adminStudentEdit">
            <button class="modal__close" onclick="closeModals()">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.496 0H6.293L10.788 6.572L15.283 0H21.173L13.95 10.385L21.762 21.7H15.841L10.788 14.508L5.797 21.7H0L7.75 10.602L0.496 0Z"
                        fill="white" />
                </svg>
            </button>
            <b class="modal__title">
                Змінити інформацію про студента
            </b>
            <div class="modal__scroll-container">
                <input name="student" type="text" form="editStudentAdmin" class="modal__addForm-row" placeholder="Введіть студента для пошуку">
                <b class="modal__subtitle">Змінити</b>
                <form action="./php/admin/edit_student.php" class="modal__admin-form" method="post" id="editStudentAdmin">
                    <input type="text" name="idStudent" class="modal__addForm-row" placeholder="№ студентського">
                    <input type="text" name="studentLastname" class="modal__addForm-row" placeholder="Прізвище">
                    <input type="text" name="studentFirstname" class="modal__addForm-row" placeholder="Ім'я">
                    <input type="text" name="studentMiddlename" class="modal__addForm-row" placeholder="По-батькові">
                    <input type="text" name="studentMail" class="modal__addForm-row" placeholder="Почтова адреса">
                    <input type="text" name="studentPass" class="modal__addForm-row" placeholder="Пароль">
                    <input type="text" name="studentStatus" class="modal__addForm-row" placeholder="Статус">
                    <button type="submit" class="modal__form-blueBtn">Додати</button>
                </form>
            </div>
        </div>
        <div class="modal adminTeacherEdit">
            <button class="modal__close" onclick="closeModals()">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.496 0H6.293L10.788 6.572L15.283 0H21.173L13.95 10.385L21.762 21.7H15.841L10.788 14.508L5.797 21.7H0L7.75 10.602L0.496 0Z"
                        fill="white" />
                </svg>
            </button>
            <b class="modal__title">
                Змінити інформацію про викладача
            </b>
            <div class="modal__scroll-container">
                <input type="text" name="teacher" form="editTeacherAdmin" class="modal__addForm-row" placeholder="Введіть викладача для пошуку">
                <b class="modal__subtitle">Змінити</b>
                <form action="./php/admin/edit_teacher.php" class="modal__admin-form" method="post" id="editTeacherAdmin">
                    <input type="text" name="idTeacher" class="modal__addForm-row" placeholder="Ідентифікатор викладача">
                    <input type="text" name="teacherLastname" class="modal__addForm-row" placeholder="Прізвище">
                    <input type="text" name="teacherFirstname" class="modal__addForm-row" placeholder="Ім'я">
                    <input type="text" name="teacherMiddlename" class="modal__addForm-row" placeholder="По-батькові">
                    <input type="text" name="teacherMail" class="modal__addForm-row" placeholder="Почтова адреса">
                    <input type="text" name="teacherPass" class="modal__addForm-row" placeholder="Пароль">
                    <input type="text" name="teacherStatus" class="modal__addForm-row" placeholder="Клас">
                    <button type="submit" class="modal__form-blueBtn">Додати</button>
                </form>
            </div>
        </div>
        <div class="modal adminGroupEdit">
            <button class="modal__close" onclick="closeModals()">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.496 0H6.293L10.788 6.572L15.283 0H21.173L13.95 10.385L21.762 21.7H15.841L10.788 14.508L5.797 21.7H0L7.75 10.602L0.496 0Z"
                        fill="white" />
                </svg>
            </button>
            <b class="modal__title">
                Змінити інформацію про групу
            </b>
            <div class="modal__scroll-container">
                <input type="text" class="modal__addForm-row" placeholder="Введіть групу для пошуку">
                <b class="modal__subtitle">Змінити</b>
                <form action="" class="modal__admin-form" method="post">
                    <input type="text" class="modal__addForm-row" placeholder="Ідентифікатор групи">
                    <input type="text" class="modal__addForm-row" placeholder="Назва групи">
                    <b class="modal__subtitle">Студенти</b>
                    <div class="modal__editForm-studentsNames">
                        <div class="modal__editForm-pair">
                            <input type="text" class="modal__addForm-row" placeholder="Введіть ідентифікатор студента">
                            <span class="modal__editForm-removePair">X</span>
                        </div>
                    </div>
                    <div class="addForm__newItem" id="editGroupStudent">Додати ще одного студента</div>
                    <button type="submit" class="modal__form-blueBtn">Додати</button>
                </form>
            </div>
        </div>
        <div class="modal adminCourseEdit">
            <button class="modal__close" onclick="closeModals()">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.496 0H6.293L10.788 6.572L15.283 0H21.173L13.95 10.385L21.762 21.7H15.841L10.788 14.508L5.797 21.7H0L7.75 10.602L0.496 0Z"
                        fill="white" />
                </svg>
            </button>
            <b class="modal__title">
                Змінити інформацію про курс
            </b>
            <div class="modal__scroll-container">
                <form action="" class="modal__admin-form" method="post">
                    <b class="modal__subtitle">Інформація про курс</b>
                    <input type="text" class="modal__addForm-row" placeholder="Введіть назву курса">
                    <b class="modal__subtitle">Групи</b>
                    <div class="modal__editForm-courseGroupsNames">
                        <div class="modal__editForm-courseGroupBox">
                            <input type="text" class="modal__addForm-row" placeholder="Введіть ідентифікатор групи">
                            <div class="addForm__newItem editForm__deleteGroup">Видалити групу</div>
                        </div>
                    </div>
                    <div class="addForm__newItem" id="editCourseGroup">Додати ще одну групу</div>
                    <b class="modal__subtitle">Предмети</b>
                    <div class="modal__addForm-lessons">
                        <div class="modal__editForm-lessonsBox">
                            <div class="modal_addForm-groupsPairs">
                                <input type="text" class="modal__addForm-row"
                                    placeholder="Введіть абревіатуру предмета">
                                <input type="text" class="modal__addForm-row" placeholder="Введіть викладача">
                            </div>
                            <input type="text" class="modal__addForm-row" placeholder="Введіть повну назву предмета">
                            <div class="addForm__newItem editForm__deleteLesson">Видалити предмет</div>
                        </div>
                    </div>
                    <div class="addForm__newItem" id="editCourseLesson">Додати ще один предмет</div>
                    <button type="submit" class="modal__form-blueBtn">Додати</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="./js/main.js"></script>
    <script src="./js/clock.js"></script>
</body>

</html>