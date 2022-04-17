document.getElementById('LoginShow').addEventListener('shown.bs.modal', function () {
    document.getElementById('FormInput').focus()
})

document.getElementById('RegisterShow').addEventListener('shown.bs.modal', function () {
    document.getElementById('FormInput').focus()
})

$('#RegisterShow').on('hidden.bs.modal', function () {
    $('body').css('overflow', 'hidden');
})