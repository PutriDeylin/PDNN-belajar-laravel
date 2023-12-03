const passwordField = document.getElementById("passwordField");
const eyeIcon = document.getElementById("eyeIcon");

eyeIcon.addEventListener("click", function() {
  if (passwordField.type === "password") {
    passwordField.type = "text";
    eyeIcon.classList.remove("fa-eye");
    eyeIcon.classList.add("fa-eye-slash"); // Mengganti ikon ke "mata tertutup"
  } else {
    passwordField.type = "password";
    eyeIcon.classList.remove("fa-eye-slash");
    eyeIcon.classList.add("fa-eye"); // Mengganti ikon ke "mata terbuka"
  }
});