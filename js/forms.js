function Student(fullName, taskName, taskStatus){
    this.fullName = fullName;
    this.taskName = taskName;
    this.taskStatus = taskStatus;
}
$('.openmodal-btn__tasks').on('click', function(){
    group_name = $(this).parents('.lessons__container').siblings('.lessons__lesson-name').children('.lessons__lesson-text').html();
    lessonName = $(this).parents('.lessons__lesson-list').siblings('.lessons__lesson-fullname').children('span').text();
    $.post('../php/database/group_results.php', {group: group_name, lessonName: lessonName}).done(function(data){
        $('.modal.tasks .modal__table').html(data);
    });
}); 
$('.openmodal-btn__access').on('click', function(){
    let lessonName = $(this).parents('.lessons__lesson-list').siblings('.lessons__lesson-fullname').children('span').text();
    let groupName = $(this).parents('.lessons__container').siblings('.lessons__lesson-name').children('.lessons__lesson-text').text();
    $.post('../php/database/access_to_session.php', {group: groupName, lessonName: lessonName, studentFullname: 'Ладоня В.С.'}).done(function(data){
        $('.modal.access .modal__table').html(data);
        //Функція для виділення Старости в модальному вікні жирним шрифтом
        const statusCheck = document.querySelectorAll('.modal__cell-status');
        for (let i = 0; i < statusCheck.length; i++) {
            if (statusCheck[i].innerHTML == 'Староста') {
                statusCheck[i].style.cssText = 'font-weight: 700;';
            }
        };
        //Функція для виділення "боржників" в модальному вікні червоним кольором, а тих хто допущений до сесії - зеленим
        const accessCheck = document.querySelectorAll('.modal__cell-access');
        for (let i = 0; i < accessCheck.length; i++) {
            if (accessCheck[i].innerHTML == 'Допуск') {
                accessCheck[i].style.cssText = 'color: green';
            }
            else {
                accessCheck[i].style.cssText = 'color: red';
            }
        };
  });
});

$('.modal.tasks').on('click', '.editConfirm', function() {
    // Получение данных из HTML-элементов
    var $row = $(this).closest('.modal__table-row');
    var studentName = $row.find('.modal__cell-studentFullname').text();
    var tasks = {};
    $row.find('.modal__tasks-itemEdit').each(function() {
      var taskName = $(this).find('.modal__tasks-text').text();
      var taskStatus = $(this).find('input[type="checkbox"]').is(':checked');
      tasks[taskName] = taskStatus ? 1 : 0;
    });
  
    // Формирование объекта данных для отправки
    var postData = {
      studentName: studentName,
      tasks: tasks
    };
    
    // Отправка POST-запроса
    $.ajax({
      url: '../php/database/tasks_edit.php',
      type: 'POST',
      data: postData,
      success: function(response) {
        $('.editBtn').parents('.modal__table-cell').siblings('.modal__table-cell').children('.modal__tasks-list').toggle();
        $('.editBtn').parents('.modal__table-cell').siblings('.modal__table-cell').children('.modal__tasks-edit').toggle();
        $('.editBtn').siblings('.editConfirm').toggle();
        if ($('.editBtn').html() == 'Відмінити') {
            $('.editBtn').html('Скорегувати');
        }
        else {
            $('.editBtn').html('Відмінити');
        }
        $.post('../php/database/group_results.php', {group: group_name, lessonName: lessonName}).done(function(data){
            $('.modal.tasks .modal__table').html(data);
        });
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });