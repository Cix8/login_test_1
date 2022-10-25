const error = document.getElementById("error") ?? "";
const success = document.getElementById("success") ?? "";

if (error) {
    let time = setTimeout(fade, 1000, error, 1.5);
}

if (success) {
    let time = setTimeout(fade, 1000, success, 1.5);
}

function fade(el, tm) {
    el.style.opacity = 0;
    el.style.transition = "opacity " + tm + "s";
    el.style.WebkitTransition = "opacity " + tm + "s";
    let timer = setTimeout(function() {
        el.style.display = "none";
    }, 1500);
}