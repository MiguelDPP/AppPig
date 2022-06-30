var inputs = document.querySelectorAll('input');
var button = document.getElementById('login');
var error = document.getElementsByClassName('textError')[0];

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});

const validaciones = {
    usuario: false,
    contraseña: false
}

const expresiones = {
    usuario: /^[a-zA-Z0-9]{1,20}$/, // Letras y espacios, pueden llevar acentos.
    contraseña: /^{1,10}$/,
}

button.addEventListener('submit', () => {
    if (validaciones.usuario == false || validaciones.contraseña == false) {
        event.preventDefault();
        error.classList.remove('d-none');
    } else {
        error.classList.add('d-none');
    }
});

function validarFormulario(e) {
    switch (e.target.name) {
        case "username":
            validaciones.usuario = validarUsuario(e.target, expresiones.usuario);
            break;
        case "password":
            validaciones.contraseña = validarUsuario(e.target, expresiones.contraseña);
            break;
    }
}

function validarUsuario(e, expresion) {
    if (!expresion.test(e.value)) {
        e.style.border = "2px solid red";
        return false;
    } else {
        e.removeAttribute('style');
        return true;
    }
}