function validateLab4RegisterForm() {
    let fullname = document.getElementById("fullname").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let confirmPassword = document.getElementById("confirmPassword").value.trim();

    if (fullname.length === 0) {
        alert("Name cannot be empty or contain only spaces");
        document.getElementById("fullname").focus();
        return false;
    }

    if (email.length === 0) {
        alert("Email cannot be empty or contain only spaces");
        document.getElementById("email").focus();
        return false;
    }

    if (password.length === 0) {
        alert("Password cannot be empty or contain only spaces");
        document.getElementById("password").focus();
        return false;
    }

    if (password.includes(' ')) {
        alert("Password cannot contain spaces");
        document.getElementById("password").focus();
        return false;
    }

    if (confirmPassword.length === 0) {
        alert("Confirm password cannot be empty");
        document.getElementById("confirmPassword").focus();
        return false;
    }

    return true;
}

function validateLab4LoginForm() {
    let email = document.getElementById("login_email").value.trim();
    let password = document.getElementById("login_password").value.trim();

    if (email.length === 0) {
        alert("Email cannot be empty or contain only spaces");
        document.getElementById("login_email").focus();
        return false;
    }

    if (password.length === 0) {
        alert("Password cannot be empty or contain only spaces");
        document.getElementById("login_password").focus();
        return false;
    }

    if (password.includes(' ')) {
        alert("Password cannot contain spaces");
        document.getElementById("login_password").focus();
        return false;
    }

    return true; 
}
