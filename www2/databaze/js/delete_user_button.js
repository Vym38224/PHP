document.querySelectorAll('.deleteButton').forEach(button => {
    button.addEventListener('click', function () {
        var userId = this.getAttribute('data-id');
        if (confirm('Jste si jisti, že chcete tohoto uživatele odstranit?')) {
            fetch('index.php?url=user/delete', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + encodeURIComponent(userId)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Uživatel byl úspěšně odstraněn.');
                        this.closest('tr').remove();
                    } else {
                        alert('Došlo k chybě při odstraňování uživatele: ' + data.message);
                        console.error('Error:', data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Došlo k chybě při odstraňování uživatele.');
                });
        }
    });
});