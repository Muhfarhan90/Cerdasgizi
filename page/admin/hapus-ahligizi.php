<?php
include("../../database/database.php");

$id = $_GET['id'];
$id_user = $_GET['id_user'];
$row = mysqli_affected_rows($conn);

try {
    $query = "DELETE FROM `nutritionist` WHERE `id_nutritionist` = '$id'";
    $result = mysqli_query($conn, $query);

    if ($row > 0) {
        $ahligiziDelete = true;
    } else {
        $ahligiziDelete = false;
    }
} catch (mysqli_sql_exception) {
    echo "data ahli gizi gagal dihapus";
}

try {
    $query2 = "DELETE FROM `user` WHERE `id_user` = '$id_user'";
    $result2 = mysqli_query($conn, $query2);
    if ($row > 0) {
        $userDelete = true;
    } else {
        $userDelete = false;
    }
} catch (mysqli_sql_exception) {
    echo "data user gagal dihapus";
}

if ($ahligiziDelete && $userDelete) {
    echo "<script>
    alert('Data ahli gizi berhasil dihapus...');
    window.location.href = 'ahligizi.php';
    </script>";
} else {
    echo "<script>
    alert('Data ahli gizi gagal dihapus...');
    window.location.href = 'ahligizi.php';
    </script>";
}
