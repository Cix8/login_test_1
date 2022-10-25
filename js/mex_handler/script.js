const error = document.getElementById("error") ?? "";
const success = document.getElementById("success") ?? "";

if (error) {
    let time = setTimeout(fade, 2000, error, 2);
}

if (success) {
    let time = setTimeout(fade, 2000, success, 2);
}

function fade(el, tm) {
    el.style.opacity = 0;
    el.style.transition = "opacity " + tm + "s";
    el.style.WebkitTransition = "opacity " + tm + "s";
    let timer = setTimeout(function() {
        el.style.display = "none";
    }, 2100);
}