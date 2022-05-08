const passwordInput = document.getElementById("sigin-pass");
const eyeSvg = document.getElementById("olho-senha");

function mostrarSenha() {
    let inputPass = passwordInput.nodeType == "password";

    if (inputPass) {
        showPassword();
    }
    else {
        hidePassword();
    }
}

function showPassword() {
    passwordInput.setAttribute("type", "text");
}

function hidePassword() {
    passwordInput.setAttribute("type", "password");

}