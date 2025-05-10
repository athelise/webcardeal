function validatePassword() {
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;

    if (password !== confirm_password) {
        alert("Пароли не совпадают");
        return false;
    }
    return true;
}

function goBack() {
    window.location.href = "../index.php";
}