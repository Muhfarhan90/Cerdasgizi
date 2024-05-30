<?php
include("../../database/database.php");

$id = $_GET['id'];

$row = mysqli_affected_rows($conn);

try {
    $query2 = "DELETE FROM `comment` WHERE `id_article` = '$id'";
    $result2 = mysqli_query($conn, $query2);

    $query = "DELETE FROM `article` WHERE `id_article` = '$id'";
    $result = mysqli_query($conn, $query);
    if ($row > 1) {
        $hapusKomen = true;
        $hapusArtikel = true;
    } else {
        $hapusArtikel = false;
        $hapusKomen = false;
    }
    echo "<script>
    alert('Data artikel berhasil dihapus...');
    window.location.href = 'artikel-ahligizi.php';
    </script>";
} catch (mysqli_sql_exception) {
    echo "<script>
    alert('Data artikel gagal dihapus...');
    window.location.href = 'artikel-ahligizi.php';
    </script>";}

