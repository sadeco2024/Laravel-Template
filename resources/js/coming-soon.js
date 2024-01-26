function updateTimer() {
    let future = Date.parse("Apr 30, 2024 11:30:00");
    let now = new Date();
    let diff = future - now;

    let days = Math.floor(diff / (1000 * 60 * 60 * 24));
    let hours = Math.floor(diff / (1000 * 60 * 60));
    let mins = Math.floor(diff / (1000 * 60));
    let secs = Math.floor(diff / 1000);

    let d = days;
    let h = hours - days * 24;
    let m = mins - hours * 60;
    let s = secs - mins * 60;

    const timer = document.getElementById("timer");
    !timer ? '' : timer.innerHTML =
        '<div><div class=""><p class="mb-1 fs-12">Días</p><h4 class="mb-0 avatar d-block avatar-rounded bg-primary-transparent avatar-xxl mt-2">' + d + '</h4></div></div>' +
        '<div><div class=""><p class="mb-1 fs-12">Horas</p><h4 class="avatar d-block avatar-rounded bg-primary-transparent avatar-xxl mb-0 mt-2">' + h + '</h4></div></div>' +
        '<div><div class=""><p class="mb-1 fs-12">Minutos</p><h4 class="mb-0 avatar d-block avatar-rounded bg-primary-transparent avatar-xxl mt-2">' + m + '</h4></div></div>' +
        '<div><div class=""><p class="mb-1 fs-12">Segundos</p><h4 class="mb-0 avatar d-block avatar-rounded bg-primary-transparent avatar-xxl mt-2">' + s + '</h4></div></div>'
}
setInterval(updateTimer, 1000);