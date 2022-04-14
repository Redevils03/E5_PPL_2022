(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()

document.getElementById('LoginShow').addEventListener('shown.bs.modal', function () {
    document.getElementById('FormInput').focus()
})

document.getElementById('RegisterShow').addEventListener('shown.bs.modal', function () {
    document.getElementById('FormInput').focus()
})

$('#RegisterShow').on('hidden.bs.modal', function () {
    $('body').css('overflow', 'hidden');
})