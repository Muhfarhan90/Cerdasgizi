<?php
include("../../logout.php");
include('../../database/database.php');

// Mendapatkan data pasien
$id_user = $_SESSION['id_user'];
$query_pasien = "SELECT * FROM patient WHERE id_user = $id_user";
$result_pasien = mysqli_query($conn, $query_pasien);
// $row_pasien = mysqli_fetch_assoc($result_pasien);

// Mendapatkan ID konsultasi dari parameter URL
$id_konsultasi = $_GET['id_consultation'];

$query_konsul = "SELECT * FROM `consultation` WHERE `id_consultation` = '$id_konsultasi'";
$result_konsul = mysqli_query($conn, $query_konsul);
$row_konsul = mysqli_fetch_assoc($result_konsul);
$id_ahligizi = $row_konsul['ID_NUTRITIONIST'];
$id_pasien = $row_konsul['ID_PATIENT'];

// Jika formulir dikirim
if (isset($_POST['kirim'])) {
    $message = $_POST['isichat'];
    $tanggal = date('Y-m-d H:i:s');
    $query_insert = "INSERT INTO chat (id_consultation,id_user, message, date_time_chat) VALUES ($id_konsultasi, $id_user, '$message', '$tanggal')";
    $result = mysqli_query($conn, $query_insert);

    // Memberikan umpan balik kepada pengguna
    if (mysqli_affected_rows($conn)) {
        echo "<script>alert('Pesan berhasil dikirim');</script>";
    } else {
        echo "<script>alert('Pesan gagal dikirim');</script>";
    }
}

// Mendapatkan data chat beserta informasi pasien dan ahli gizi
$query_chat = "SELECT chat.*, patient.fullname_patient AS patient_name, nutritionist.fullname_nutritionist AS nutritionist_name, patient.id_patient, nutritionist.id_nutritionist, user.id_role
               FROM chat 
               INNER JOIN consultation ON chat.id_consultation = consultation.id_consultation 
               INNER JOIN patient ON consultation.id_patient = patient.id_patient
               INNER JOIN nutritionist ON consultation.id_nutritionist = nutritionist.id_nutritionist 
               INNER JOIN user ON chat.id_user = user.id_user
               WHERE chat.id_consultation = $id_konsultasi 
               ORDER BY chat.date_time_chat ASC";
$result_chat = mysqli_query($conn, $query_chat);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadata dan CSS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Konsultasi</title>
    <link rel="stylesheet" href="../../vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- Navbar dan sidebar -->
        <?php include('navbar-pasien.php'); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include('sidebar-pasien.php'); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-xl-6 grid-margin stretch-card flex-column">
                            <h1 class="mb-2 text-titlecase mb-4">Chat Konsultasi</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-7 col-xl-12" style="margin-bottom: 4rem;">
                            <ul class="d-flex flex-column list-unstyled chat-container">
                                <?php if (mysqli_num_rows($result_chat) > 0) : ?>
                                    <?php while ($row_chat = mysqli_fetch_assoc($result_chat)) : ?>
                                        <?php if ($row_chat['id_role'] == 3) : ?>
                                            <!-- Pesan dari pasien -->
                                            <li class="d-flex justify-content-end mb-4">
                                                <div class="card w-100 message-right">
                                                    <div class="card-header d-flex justify-content-between p-3">
                                                        <div class="d-flex align-items-center">
                                                            <img src="../../images/icons8-user-32.png" alt="avatar" class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                                                            <p class="fw-bold mb-0"><?= $row_chat['patient_name'] ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="text-muted small mb-0"><i class="far fa-clock"></i> <?= $row_chat['DATE_TIME_CHAT'] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="mb-0"><?= $row_chat['MESSAGE'] ?></p>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php elseif ($row_chat['id_role'] == 2) : ?>
                                            <!-- Pesan dari ahli gizi -->
                                            <li class="d-flex justify-content-start mb-4">
                                                <div class="card message-left">
                                                    <div class="card-header d-flex justify-content-between p-3">
                                                        <div class="d-flex align-items-center">
                                                            <img src="../../images/icons8-doctor-32.png" alt="avatar" class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                                                            <p class="fw-bold mb-0"><?= $row_chat['nutritionist_name'] ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="text-muted small mb-0"><i class="far fa-clock"></i> <?= $row_chat['DATE_TIME_CHAT'] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="mb-0"><?= $row_chat['MESSAGE'] ?></p>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <li class="text-center">Tidak ada pesan.</li>
                                <?php endif; ?>
                            </ul>
                            <!-- <form action="" method="POST" class="chat-input fixed-bottom col-xl-10 " style="margin-left: 16rem;">
                                <div class="form-outline">
                                    <textarea class="form-control" id="textAreaExample2" rows="2" name="isichat"></textarea>
                                </div>
                                <input type="hidden" name="id_konsultasi" value="<?= $id_konsultasi ?>">
                                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-rounded float-end mt-2" name="kirim">Send</button>
                            </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <script src="../../vendors/chart.js/Chart.min.js"></script>
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <script src="../../js/settings.js"></script>
    <script src="../../js/todolist.js"></script>
    <script src="../../js/dashboard.js"></script>
</body>

</html>