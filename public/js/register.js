let emailValid = false;
let passwordValid = false;
let confirmPasswordValid = false;

let error = document.getElementsByClassName('alert');

const upperlowercase = new RegExp("^[A-Z][a-z]+$");
const onlylowercase = new RegExp("^[a-z]+$");
const uppercase = new RegExp("(?=.*?[A-Z])");
const lowercase = new RegExp("(?=.*?[a-z])");
const digit = new RegExp("(?=.*?[0-9])");
const specialChar = new RegExp("(?=.*?[#?!@$%^&*-])");
const eightChar = new RegExp(".{8,}");
const email = new RegExp("^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$");
const whiteSpace = new RegExp("\\s");

function check1(data) {
    if (data.length > 0) {
        if (whiteSpace.test(data)) {
            error[0].innerText = 'White Space not allowed';
            emailValid = false;
        } else if (!email.test(data)) {
            error[0].innerText = 'Enter valid Email';
            emailValid = false;
        } else {
            error[0].innerText = '';
            emailValid = true;
        }
    } else {
        error[0].innerText = '';
        emailValid = false;
    }
}

function check2(data) {
    if (data.length > 0) {
        if (whiteSpace.test(data)) {
            error[1].innerText = 'White Space not allowed';
            passwordValid = false;
        } else if (!uppercase.test(data)) {
            error[1].innerText = 'Enter at least 1 upper character';
            passwordValid = false;
        } else if (!lowercase.test(data)) {
            error[1].innerText = 'Enter at least 1 lower character';
            passwordValid = false;
        } else if (!digit.test(data)) {
            error[1].innerText = 'Enter at least 1 digit';
            passwordValid = false;
        } else if (!specialChar.test(data)) {
            error[1].innerText = 'Enter at least 1 special character';
            passwordValid = false;
        } else if (!eightChar.test(data)) {
            error[1].innerText = 'Enter at least 8 characters';
            passwordValid = false;
        } else {
            error[1].innerText = '';
            passwordValid = true;
        }
    } else {
        error[1].innerText = '';
        passwordValid = false;
    }
}

function check3(data) {
    let pass = document.getElementById('password').value;
    if (data.length > 0) {
        if (data !== pass) {
            error[2].innerText = "Passwords do not match";
            confirmPasswordValid = false;
        } else {
            error[2].innerText = '';
            confirmPasswordValid = true;
        }
    } else {
        error[2].innerText = '';
        confirmPasswordValid = false;
    }
}

function validate() {
    if (emailValid && passwordValid && confirmPasswordValid) {
        return true;
    } else {
        return false;
    }
}

let pass = document.getElementById('password');
let display = document.getElementById('show');

display.addEventListener('click',(e)=>{
    if(pass.type == 'password'){
        pass.type = 'text';
        display.classList.remove('fa-eye-slash');
        display.classList.add('fa-eye');
    }
    else{
        pass.type = 'password';
        display.classList.remove('fa-eye');
        display.classList.add('fa-eye-slash');
    }
});

function remove(e){
    let parent = e.parentElement;
    parent.remove();
}