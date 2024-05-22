<?php

include("../../database/database.php");
session_start();
// Mendapatkan nilai id_user terakhir
$query_last_id_article = "SELECT MAX(id_article) AS last_id_article FROM article";
$result_last_id_article = mysqli_query($conn, $query_last_id_article);
$row_last_id_article = mysqli_fetch_assoc($result_last_id_article);
$last_id_article = $row_last_id_article['last_id_article'];




if (isset($_POST['tambah-artikel'])) {
    $id_user = $_SESSION['id_user'];
    $sql = "SELECT * FROM nutritionist WHERE id_user = $id_user";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $id_nutritionist = $row['ID_NUTRITIONIST'];
    // Mengatur id_user dan id_nutritionist untuk data berikutnya
    $id_article = $last_id_article + 1;

    $judul = $_POST["judul"];
    $konten = $_POST["konten"];
    $kategori = $_POST['kategori'];
    $gambar = $_POST['gambar'];
    $tanggal = date('Y-m-d H:i:s');


    try {

        $query2 = "INSERT INTO article (`id_article`, `id_nutritionist`, `id_category`, `title`, `image_article`, `content_article`, `publication_date`) VALUES ('$id_article', '$id_nutritionist', '$kategori', '$judul', '$gambar', '$konten', '$tanggal')";
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_affected_rows($conn);
        if ($row2) {
            header("location: artikel-ahligizi.php");
        } else {
            header("location: artikel-ahligizi.php");
        }
    } catch (Exception $e) {

        echo "Exception" . $e;
    }
}
