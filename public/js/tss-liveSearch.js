$(document).ready(function() {
    $('#search-input').on('keyup', function() {
        let query = $(this).val();
        console.log("Searching for: ", query); // Memverifikasi bahwa pencarian dijalankan
        $.ajax({
            url: searchRoute, // Gunakan variabel JavaScript
            method: 'GET',
            data: { search: query },
            success: function(data) {
                console.log(data); // Cek data respons
                $('#tss-table-container').html(data);
            },
            error: function(xhr, status, error) {
                console.log("Error: ", xhr.responseText); // Tangkap error
            }
        });
    });
});