<?php
    include ('config.php');

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['daftar'])){

    // ambil data dari formulir
    $judul = $_POST['judul'];
    $penerbit = $_POST['penerbit'];
    $kategori = $_POST['kategori'];
    $isbn = $_POST['isbn'];
    $jumlah = $_POST['jumlah'];

    // buat query
    $sql = "INSERT INTO buku (id_publisher, kode_kategori, judul_buku, isbn, jumlah_buku) VALUE ('$penerbit', '$kategori', '$judul','$isbn','$jumlah')";
    $query = mysqli_query($conn, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: donasi_sukses.php');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: donasi_gagal.php');
    }


} else {
    die("Akses dilarang...");
}

?>