const pass = document.getElementById("pass");
const confirmPass = document.getElementById("confirm_pass");

const isConfirmPass = () => {
    if (confirmPass.value !== pass.value) {
        confirmPass.style.backgroundColor = "#ffcccc";
    } else {
        confirmPass.style.backgroundColor = "#ccffcc";
    }
}

confirmPass.addEventListener("input", isConfirmPass);
pass.addEventListener("input", isConfirmPass);