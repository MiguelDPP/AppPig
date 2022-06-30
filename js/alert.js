var alerta = document.getElementsByClassName("alert")[0];

if (alerta != null) {
    setTimeout(() => {
        // alerta.parentNode.removeChild(alerta);
        var padre = alerta.parentNode;
        padre.parentNode.removeChild(padre);
    }, 5000);
}