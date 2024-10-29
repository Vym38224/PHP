// Zkontrolujte, zda URL obsahuje parametr success
if (window.location.search.includes('success=true')) {
    console.log('success');
    var successAlert = document.getElementById('successAlert');
    successAlert.classList.remove('d-none');
    setTimeout(() => {
        successAlert.classList.add('d-none');
    }, 3000); // Notifikace zmizí po 3 sekundách
}