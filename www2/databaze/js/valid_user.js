document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function (event) {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var errorMessages = [];

            // Validace emailu
            if (!email) {
                errorMessages.push('Email je povinný.');
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                errorMessages.push('Zadejte platný email.');
            }

            // Validace hesla
            if (!password) {
                errorMessages.push('Heslo je povinné.');
            } else if (password.length <= 6) {
                errorMessages.push('Heslo musí obsahovat více než 6 znaků.');
            }

            // Zobrazení chybových zpráv
            if (errorMessages.length > 0) {
                alert(errorMessages.join('\n'));
                event.preventDefault();
            }
        });
    });
});