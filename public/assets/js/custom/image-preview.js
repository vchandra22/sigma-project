function previewFile(input) {
    "use strict"; // Mengaktifkan mode strict untuk meningkatkan keamanan

    var preview = input.previousElementSibling; // Mengambil elemen sebelumnya dari input
    var file = input.files[0]; // Mengambil file pertama yang dipilih
    var reader = new FileReader(); // Membuat instance FileReader untuk membaca file

    // Memeriksa apakah ukuran file lebih dari 2MB
    if(input.files[0].size > 2000000){
        alert("Maximum file size is 2MB!");
    } else {
        reader.onloadend = function() {
            preview.src = reader.result;
        };

        // Memeriksa file sebagai Data URL
        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = ""; // Jika tidak ada file, mengosongkan sumber gambar
        }
    }
}
