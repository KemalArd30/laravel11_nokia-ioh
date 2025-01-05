document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('#resetButton').addEventListener('click', function() {
        const url = this.getAttribute('data-url');
        window.location.href = url;
    });
});