document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    document.querySelectorAll('.btn-public-link').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            var taskId = this.getAttribute('data-task-id');
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = `/tasks/${taskId}/public-link`;

            var csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = csrfToken;
            form.appendChild(csrf);

            document.body.appendChild(form);
            form.submit();
        });
    });
});