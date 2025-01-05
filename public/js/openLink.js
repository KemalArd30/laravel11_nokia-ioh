function openUrl(inputId) {
    const url = document.getElementById(inputId).value;
    if (!url) {
        alert('URL Tidak Tersedia, silahkan isi URL terlebih dahulu.');
        return;
    }
    window.open(url, '_blank');
}

function copyToClipboard(inputId) {
    const inputElement = document.getElementById(inputId);
    const tempInput = document.createElement("input");
    tempInput.value = inputElement.value;
    document.body.appendChild(tempInput);
    tempInput.select();
    tempInput.setSelectionRange(0, 99999); // Untuk mendukung mobile
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    // Menampilkan notifikasi kecil
    alert("URL berhasil disalin: " + inputElement.value);
}