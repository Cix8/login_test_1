const error = document.getElementById("error") ?? "";
const success = document.getElementById("success") ?? "";

if(error) {
    error.style.cursor = "pointer";
    error.addEventListener("click", function() {
        error.classList.add("d-none");
        error.innerHTML = "";
    })
}

if(success) {
    success.style.cursor = "pointer";
    success.addEventListener("click", function() {
        success.classList.add("d-none");
        success.innerHTML = "";
    })
}