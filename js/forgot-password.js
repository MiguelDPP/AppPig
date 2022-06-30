var inputs = document.querySelectorAll('input');
var button = document.getElementById('form');
var error = document.getElementsByClassName('textError')[0];


button.addEventListener('submit', (event) => {
    inputs.forEach(element => {
        if (element.value == "") {
            error.classList.remove('d-none');
            event.preventDefault();
        } else {
            error.classList.add('d-none');
        }
    });

});