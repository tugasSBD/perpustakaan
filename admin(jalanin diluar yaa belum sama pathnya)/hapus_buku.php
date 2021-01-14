<?php
    include "config.php";
    if( !isset($_GET['id']) ){
        header('Location: buku.php');
    }
    $id = $_GET['id'];

    // buat query hapus
    $sql = "DELETE FROM buku WHERE id_buku=$id";
    $query = mysqli_query($conn, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        header('Location: buku.php');
    } else {
        die("gagal menghapus...");
    }
?>
