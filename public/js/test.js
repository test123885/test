const togglePasswords = document
.querySelector('.test');
const passwords = document.querySelector('#passwords');
togglePasswords.addEventListener('click', () => {
const type = passwords
    .getAttribute('type') === 'password' ?
    'text' : 'password';
passwords.setAttribute('type', type);

});

const togglePassword = document
.querySelector('#togglePassword');
const password = document.querySelector('#password');
togglePassword.addEventListener('click', () => {

const type = password
    .getAttribute('type') === 'password' ?
    'text' : 'password';
password.setAttribute('type', type);

});