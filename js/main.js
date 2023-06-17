//Подія для відображення слайдера з розширеною інформацією про предмет
$('.lesson__slider-button').on('click', function () {
    $(this).parents('.lessons__lesson-fullname').siblings('.lessons__lesson-list').slideToggle();
    $(this).toggleClass('--opened');
});
//Подія для відображення маленького поп-ап меню з інформацією про предмет
$('.lesson__button').on('click', function () {
    $(this).siblings('.lessons__popup').fadeToggle();
});
//Подія для закриття маленького поп-ап меню з інформацією про предмет
$('.lesson__button-close').on('click', function () {
    $(this).parents('.lessons__popup').fadeToggle();
});


//Функції для відображення потрібних модальних вікон у викладача
$('.openmodal-btn__access').on('click', function () {
    openModals('access');
    let lessonName = $(this).parents('.lessons__container').siblings('.lessons__lesson-name').children('.lessons__lesson-text').text();
    $('.modal.access').children('.modal__subtitle').children('.modal__groupName').html(lessonName);
});
$('.openmodal-btn__tasks').on('click', function () {
    openModals('tasks');
    let lessonName = $(this).parents('.lessons__container').siblings('.lessons__lesson-name').children('.lessons__lesson-text').text();
    $('.modal.tasks').children('.modal__hidden-groupname').val(lessonName);
});
$('.openmodal-btn__control').on('click', function () {
    openModals('control');
});
$('.openmodal__adminStudentAdd').on('click', function () {
    openModals('adminStudentAdd');
});
$('.openmodal__adminTeacherAdd').on('click', function () {
    openModals('adminTeacherAdd');
});
$('.openmodal__adminGroupAdd').on('click', function () {
    openModals('adminGroupAdd');
});
$('.openmodal__adminCourseAdd').on('click', function () {
    openModals('adminCourseAdd');
});
$('.openmodal__adminStudentEdit').on('click', function () {
    openModals('adminStudentEdit');
});
$('.openmodal__adminGroupEdit').on('click', function () {
    openModals('adminGroupEdit');
});
$('.openmodal__adminTeacherEdit').on('click', function () {
    openModals('adminTeacherEdit');
});
$('.openmodal__adminCourseEdit').on('click', function () {
    openModals('adminCourseEdit');
});



$('.header__menu-button').on('click', function(){
    $('.header__menu').slideToggle().css('display' , 'flex');
})

$('.control__button-switch').on('click', function(){
    $(this).siblings('.control__button-inner').slideToggle().css('display' , 'flex');
    if($(this).hasClass('--active')){
        $(this).removeClass('--active').css('transform', 'rotate(0deg)');
    }
    else{
        $(this).addClass('--active').css('transform', 'rotate(45deg)');
    }
})



//Подія для відображення форми редагування успіхів студента в здачі завдань
$('.modal__table').on('click', '.editBtn', function () {
    $(this).parents('.modal__table-cell').siblings('.modal__table-cell').children('.modal__tasks-list').toggle();
    $(this).parents('.modal__table-cell').siblings('.modal__table-cell').children('.modal__tasks-edit').toggle();
    $(this).siblings('.editConfirm').toggle();
    if ($(this).html() == 'Відмінити') {
        $(this).html('Скорегувати');
    }
    else {
        $(this).html('Відмінити');
    }
});

$('#newGroupStudent').on('click', function () {
    $(this).siblings('.modal__addForm-studentsNames').append($('<input>', {
        class: 'modal__addForm-row',
        name: 'group_students[]',
        type: 'text',
        placeholder: 'Введіть ідентифікатор студента'
    }))
});

$('#newCourseGroup').on('click', function () {
    $(this).siblings('.modal__addForm-groupsNames').append($('<input>', {
        class: 'modal__addForm-row',
        name: 'idGroup[]',
        type: 'text',
        placeholder: 'Введіть ідентифікатор групи'
    }))
});

$('#newCourseLesson').on('click', function () {
    $(this).siblings('.modal__addForm-lessons').append($('<div>', {
        class: 'modal_addForm-groupsPairs'
    })).children('.modal_addForm-groupsPairs:last-of-type').append(
        $('<input>', { type: 'text', name: 'shortLesson[]', class: 'modal__addForm-row', placeholder: 'Введіть абревіатуру предмета' }),
        $('<input>', { type: 'text', name: 'teacherLesson[]', class: 'modal__addForm-row', placeholder: 'Введіть викладача' })
    );
    $(this).siblings('.modal__addForm-lessons').append(
        $('<input>', { type: 'text', name: 'longLesson[]', class: 'modal__addForm-row', placeholder: 'Введіть повну назву предмета' })
    )
});


$('#editGroupStudent').on('click', function () {
    $(this).siblings('.modal__editForm-studentsNames').append($('<div>', { class: 'modal__editForm-pair' })).children('.modal__editForm-pair:last-of-type').append(
        $('<input>', { type: 'text', class: 'modal__addForm-row', placeholder: 'Введіть ідентифікатор студента' }),
        $('<span>', { class: 'modal__editForm-removePair', text: 'X' })
    );
});



$('.modal__editForm-studentsNames').on('click', '.modal__editForm-removePair', function () {
    $(this).parents('.modal__editForm-pair').remove();
});

$('#editCourseGroup').on('click', function () {
    $(this).siblings('.modal__editForm-courseGroupsNames').append($('<div>', { class: 'modal__editForm-courseGroupBox' }).append(
        $('<input>', { type: 'text', class: 'modal__addForm-row', placeholder: 'Введіть ідентифікатор групи' }),
        $('<div>', { class: 'addForm__newItem editForm__deleteGroup', text: 'Видалити групу' })));
});

$('#editCourseLesson').on('click', function () {
    $(this).siblings('.modal__addForm-lessons').append(
        $('<div>', { class: 'modal__editForm-lessonsBox' }).append(
            $('<div>', { class: 'modal_addForm-groupsPairs' }).append(
                $('<input>', { type: 'text', class: 'modal__addForm-row', placeholder: 'Введіть абревіатуру предмета' }),
                $('<input>', { type: 'text', class: 'modal__addForm-row', placeholder: 'Введіть викладача' })
            ),
            $('<input>', { type: 'text', class: 'modal__addForm-row', placeholder: 'Введіть повну назву предмета' }),
            $('<div>', { class: 'addForm__newItem editForm__deleteLesson', text: 'Видалити предмет' })
        )
    );
});
$('.modal__editForm-courseGroupsNames').on('click', '.editForm__deleteGroup', function () {
    $(this).parents('.modal__editForm-courseGroupBox').remove();
});

$('.modal__addForm-lessons').on('click', '.editForm__deleteLesson', function () {
    $(this).closest('.modal__editForm-lessonsBox').remove();
});



//Подія для закриття модальних вікон
$('.modal__close').on('click', function () {
    closeModals();
});

//Функія для відображення потрібного модального вікна
openModals = (name) => {
    $('.modals').addClass('--opened');
    $(`.modal.${name}`).addClass('--opened')
};
//Функція для закриття модальних вікон
closeModals = () => {
    $('.modals').removeClass('--opened');
    $('.modal').removeClass('--opened');
};
