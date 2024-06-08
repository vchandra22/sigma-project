function autoHideToast() {
    var toast = document.getElementById('toast-success');
    if (toast) {
        setTimeout(function() {
            toast.style.transition = 'opacity 0.5s ease';
            toast.style.opacity = '0';
            setTimeout(function() {
                toast.style.display = 'none';
            }, 1200); // additional 1200 to complete the fade-out transition
        }, 2400); // 1200 delay before starting the fade-out
    }
}

document.addEventListener('DOMContentLoaded', function() {
    autoHideToast();
});
