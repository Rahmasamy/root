const container = document.querySelector('.container');
const loginLink = document.querySelector('.login-link');
const regisrerLink = document.querySelector('.register-link');
const btn = document.querySelector('.btn');
const closex = document.querySelector('.close');

regisrerLink.addEventListener('click', () => {
    container.classList.add('active');
});
loginLink.addEventListener('click', () => {
    container.classList.remove('active');
});
btn.addEventListener('click', () => {
    container.classList.add('active-btn');
});

closex.addEventListener('click', () => {
    container.classList.remove('active-btn');
});

function validate() {
    var x = document.forms["form1"]["fname"].value;
    var max_length = 10;
    if (x == "" || x.length > max_length) {
        alert("Incorrect input");
        return false;
    }

}
function required_email() /*required validation*/ {
    var val = document.forms["form1"]["fname"].value;
    if (val == "") {
        alert("Input is required");
        return false;
    }
}
