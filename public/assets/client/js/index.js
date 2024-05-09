document.addEventListener('DOMContentLoaded', function() {

    /**
     *
     * @type {HTMLButtonElement}
     */
    let closeButton = document.querySelector('.btn-close');
    let toast = document.getElementById('liveToast');

    closeButton.addEventListener('click', function() {
        toast.remove();
    });

    setTimeout(function() {
        toast.remove();
    }, 5000);
});
