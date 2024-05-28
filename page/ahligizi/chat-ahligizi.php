<?php
include("../../logout.php");
include('../../database/database.php');

// pasien
$id_user = $_SESSION['id_user'];
$query_ahligizi = "SELECT * FROM nutritionist WHERE id_user = $id_user";
$result_ahligizi = mysqli_query($conn, $query_ahligizi);
$row_pasien = mysqli_fetch_assoc($result_ahligizi);
$id_konsultasi = $_GET['id_consultation'];
if (isset($_POST['kirim'])) {
    $message = $_POST['isichat'];

    $tanggal = date('Y-m-d H:i:s');
    $query_insert = "INSERT INTO chat (id_consultation, `message`, date_time_chat) VALUES ($id_konsultasi, '$message', '$tanggal')";
    $result = mysqli_query($conn, $query_insert);
    if (mysqli_affected_rows($conn)) {
        echo "<script>
        alert('pesan berhasil dikirim');
        </script>";
    } else {
        echo "<script>
        alert('pesan gagal dikirim');
        </script>";
    }
} 

$query_chat = "SELECT chat.*, consultation.id_patient, consultation.id_nutritionist 
               FROM chat 
               INNER JOIN consultation ON chat.id_consultation = consultation.id_consultation 
               WHERE chat.id_consultation = $id_konsultasi 
               ORDER BY chat.date_time_chat ASC";
$result_chat = mysqli_query($conn, $query_chat);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Konsultasi</title>
    <!-- base:css -->
    <link rel="stylesheet" href="../../vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css" />
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include('navbar-ahligizi.php'); ?>

        <div class="container-fluid page-body-wrapper">
          
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <?php include('sidebar-ahligizi.php'); ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-xl-6 grid-margin stretch-card flex-column">
                            <h1 class="mb-2 text-titlecase mb-4">Chat Konsultasi</h1>
                        </div>
                    </div>

                    <!-- chat konsultasi -->
                    <div class="row">
                        <div class="col-md-6 col-lg-7 col-xl-12" style="margin-bottom: 4rem;">
                            <ul class="d-flex flex-column list-unstyled chat-container">
                                <?php while ($row_chat = mysqli_fetch_assoc($result_chat)) : ?>
                                    <?php if ($row_chat['id_nutritionist'] == $row_pasien['ID_NUTRITIONIST']) : ?>
                                        <!-- Pesan dari pengguna -->
                                        <li class="d-flex justify-content-end mb-4">
                                            <div class="card w-100 message-right">
                                                <div class="card-header d-flex justify-content-between p-3">
                                                    <div class="d-flex align-items-center">
                                                        <img src="../../images/icons8-doctor-32.png" alt="avatar" class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                                                        <p class="fw-bold mb-0">Lara Croft</p>
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
                                    <?php else : ?>
                                        <!-- Pesan dari lawan chat -->
                                        <li class="d-flex justify-content-start mb-4">
                                            <div class="card message-left">
                                                <div class="card-header d-flex justify-content-between p-3">
                                                    <div class="d-flex align-items-center">
                                                        <img src="../../images/icons8-user-32.png" alt="avatar" class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                                                        <p class="fw-bold mb-0">Anto</p>
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
                            </ul>

                            <form action="" method="POST" class="chat-input fixed-bottom col-xl-10 " style="margin-left: 16rem;">
                                <div class="form-outline">
                                    <textarea class="form-control" id="textAreaExample2" rows="2" name="isichat"></textarea>
                                </div>
                                <input type="hidden" name="id_konsultasi" value="1"> <!-- Replace with actual consultation ID -->
                                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-rounded float-end mt-2" name="kirim">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

        <!-- base:js -->
        <script src="../../vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="../../vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="../../vendors/chart.js/Chart.min.js"></script>
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="../../js/off-canvas.js"></script>
        <script src="../../js/hoverable-collapse.js"></script>
        <script src="../../js/template.js"></script>
        <script src="../../js/settings.js"></script>
        <script src="../../js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="../../js/dashboard.js"></script>
    </div>
</body>

</html>