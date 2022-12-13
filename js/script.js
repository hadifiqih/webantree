// ambil elemen yang dibutuhkan
var keyword = document.getElementById('keyword');
var tombolCari = document.getElementById('tombol-cari');
var tabel = document.getElementById('tabel-utama');

keyword.addEventListener('keyup', function() {
    // buat object ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan AJAX
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            tabel.innerHTML = xhr.responseText;
        }
    }

    // eksekusi AJAX
    xhr.open('GET', 'ajax/ajax_cari.php?keyword=' + keyword.value, true);
    xhr.send();
});