let flag = 0;

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

function check1(data){
    if(data.length > 0){
        if(whiteSpace.test(data)==1){
            error[0].innerText = 'White Space not allowed';
            flag = 0;
        }
        else if(email.test(data)==0){
            error[0].innerText = 'Enter valid Email';
            flag = 0;
        }
        else{
            error[0].innerText = '';
            flag = 1;
        }
    }
    else{
        error[0].innerText = '';
        flag = 0;
    }
}

function check2(data){
    if(data.length > 0){
        if(whiteSpace.test(data)==1){
            error[1].innerText = 'White Space not allowed';
            flag = 0;
        }
        else if(uppercase.test(data)==0){
            error[1].innerText = 'Enter atleast 1 upper character';
            flag = 0;
        }
        else if(lowercase.test(data)==0){
            error[1].innerText = 'Enter atleast 1 lower character';
            flag = 0;
        }
        else if(digit.test(data)==0){
            error[1].innerText = 'Enter atleast 1 digit';
            flag = 0;
        }
        else if(specialChar.test(data)==0){
            error[1].innerText = 'Enter atleast 1 special character';
            flag = 0;
        }
        else if(eightChar.test(data)==0){
            error[1].innerText = 'Enter atleast 8 character';
            flag = 0;
        }
        else{
            error[1].innerText = '';
            flag = 1;
        }
    }
    else{
        error[1].innerText = '';
        flag = 0;
    }
}

function check3(data){
    let pass = document.getElementById('password').value;
    if(data.length > 0){
        if(data !== pass){
            error[2].innerText = "Enter confirm password";
            flag = 0;
        }
        else{
            error[2].innerText = '';
            flag = 1;
        }
    }
    else{
        error[2].innerText = '';
        flag = 0;
    }
}

function validate(){
    if(flag == 1){
        return true;
    }
    else{
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