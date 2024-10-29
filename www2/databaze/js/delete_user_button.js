document.querySelectorAll('.deleteButton').forEach(button => {
    button.addEventListener('click', function () {
        var userId = this.getAttribute('data-id');
        if (confirm('Jste si jisti, že chcete tohoto uživatele odstranit?')) {
            fetch('index.php?url=user/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + encodeURIComponent(userId)
            })
                .then(response => response.text())
                .then(data => {
                    alert('Uživatel byl úspěšně odstraněn.');
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Došlo k chybě při odstraňování uživatele.');
                });
        }
    });
});
