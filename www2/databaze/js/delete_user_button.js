document.querySelectorAll('.deleteButton').forEach(button => {
    button.addEventListener('click', function () {
        if (confirm('Jste si jisti, že chcete tohoto uživatele odstranit?')) {
            fetch('index.php?url=user/index')
                .then(response => response.json())
                .then(data => {
                    alert('Uživatel byl úspěšně odstraněn.');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Došlo k chybě při odstraňování uživatele.');
                });
        }
    });
});
