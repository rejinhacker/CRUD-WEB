document.addEventListener('DOMContentLoaded', function () {
    const deleteLinks = document.querySelectorAll('a.delete-link');
    
    deleteLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            const confirmDelete = confirm('Are you sure you want to delete this record?');
            if (!confirmDelete) {
                event.preventDefault();
            }
        });
    });
});
