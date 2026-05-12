function changeName() {
    hideAll();
    const form = document.getElementById("username");
    if (form.style.display === "none" || form.style.display === "") { form.style.display = "block"}
}

function changePW() {
    hideAll();
    const form = document.getElementById("password");
    if (form.style.display === "none" || form.style.display === "") { form.style.display = "block"}
}

function changeEmail() {
    hideAll();
    const form = document.getElementById("email");
    if (form.style.display === "none" || form.style.display === "") { form.style.display = "block"}
}

function deleteUser() {
    hideAll();
    const form = document.getElementById("delete");
    if (form.style.display === "none" || form.style.display === "") { form.style.display = "block"}
}

function hideAll() {
    document.getElementById("username").style.display = "none";
    document.getElementById("password").style.display = "none";
    document.getElementById("email").style.display = "none";
    document.getElementById("delete").style.display = "none";
}