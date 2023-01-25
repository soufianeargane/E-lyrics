console.log("sss");

function validateForm() {
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let reg_exp = /^[^ ]+@[a-z]+\.[a-z]{2,3}$/;
    if (email.value == "" || !email.value.match(reg_exp)) {
        // console.log("Invalid email address");
        event.preventDefault();
        document.getElementById("email-error").innerHTML =
            "*Invalid email address";
        document.getElementById("email-error").style.color = "red";
        return false;
    } else {
        document.getElementById("email-error").innerHTML = "";
    }
    if (password.value == "" || password.value.length < 8) {
        // console.log("Invalid password");
        event.preventDefault();
        document.getElementById("password-error").innerHTML =
            "*Invalid password";
        document.getElementById("password-error").style.color = "red";
        return false;
    } else {
        document.getElementById("password-error").innerHTML = "";
    }
    return true;
}
