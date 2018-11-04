document.getElementById("loginForm").addEventListener("submit", loginValidation, false);
document.getElementById("signupForm").addEventListener("submit", signupValidation, false);

document.getElementById("createQuestion").addEventListener("keyup", characterCount);
document.getElemenstByClassName("createOptions").addEventListener("keyup", characterCount);