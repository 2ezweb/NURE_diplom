<tr class="modal__table-row">
    <td class="modal__table-cell">1</td>
    <td class="modal__table-cell">Могильний А.Б.</td>
    <td class="modal__table-cell">

        <ul class="modal__tasks-list">
            <li class="modal__tasks-item">
                <span class="modal__item-text">ЛР1</span>
                <img src="./content/status/lessons_true.svg" alt="" class="modal__item-status">
            </li>
            <li class="modal__tasks-item">
                <span class="modal__item-text">ЛР2</span>
                <img src="./content/status/lessons_true.svg" alt="" class="modal__item-status">
            </li>
            <li class="modal__tasks-item">
                <span class="modal__item-text">ЛР3</span>
                <img src="./content/status/lessons_true.svg" alt="" class="modal__item-status">
            </li>
            <li class="modal__tasks-item">
                <span class="modal__item-text">ЛР4</span>
                <img src="./content/status/lessons_true.svg" alt="" class="modal__item-status">
            </li>
        </ul>
        <form class="modal__tasks-edit" id="modalTaskEdit" action="" method="post">
            <ul class="modal__tasks-list">
                <li class="modal__tasks-item">
                    <span class="modal__tasks-text">ЛР1</span>
                    <input type="checkbox" name="task1" id="task1">
                    <label for="task1"><img src="./content/status/lessons_true.svg" alt=""></label>
                </li>
                <li class="modal__tasks-item">
                    <span class="modal__tasks-text">ЛР2</span>
                    <input type="checkbox" name="task2" id="task2">
                    <label for="task2"><img src="./content/status/lessons_true.svg" alt=""></label>
                </li>
                <li class="modal__tasks-item">
                    <span class="modal__tasks-text">ЛР3</span>
                    <input type="checkbox" name="task3" id="task3">
                    <label for="task3"><img src="./content/status/lessons_true.svg" alt=""></label>
                </li>
                <li class="modal__tasks-item">
                    <span class="modal__tasks-text">ЛР4</span>
                    <input type="checkbox" name="task4" id="task4">
                    <label for="task4"><img src="./content/status/lessons_true.svg" alt=""></label>
                </li>
            </ul>
        </form>
    </td>
    <td class="modal__table-cell modal__cell-edit">
        <button class="editBtn">Скорегувати</button>
        <input class="editConfirm" form="modalTaskEdit" type="submit" value="Підтвердити зміни">
    </td>
</tr>