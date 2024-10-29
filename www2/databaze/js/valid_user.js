document.getElementById('loginForm').addEventListener('submit', function (event) {

    var email = document.getElementById('email').value;
    var errorMessages = [];

    // Validace emailu
    if (!email) {
        errorMessages.push('Email je povinný.');
    } else if (!/\S+@\S+\.\S+/.test(email)) {
        errorMessages.push('Zadejte platný email.');
    }

    // Zobrazení chybových zpráv
    if (errorMessages.length > 0) {
        alert(errorMessages.join('\n'));
        return;
    }



});