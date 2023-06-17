function update() {
    let clock = document.getElementById('clock');
    let date = new Date();
    let hours = date.getHours();
    if (hours < 10) hours = '0' + hours;
    clock.children[0].innerHTML = hours;

    let minutes = date.getMinutes();
    if (minutes < 10) minutes = '0' + minutes;
    clock.children[2].innerHTML = minutes;
}
timerId = setInterval(update, 1000);
update(); // (*)