<?php
include("../../logout.php");
include('../../database/database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Konsultasi Ahli Gizi</title>
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

<>

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php
        include('navbar-ahligizi.php');
        ?>

        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="typcn typcn-cog-outline"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close typcn typcn-times"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>

            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <?php
            include('sidebar-ahligizi.php');
            ?>
            <!-- partial -->
            <div class="main-panel">

                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-xl-6 grid-margin stretch-card flex-column">
                            <h1 class="mb-2 text-titlecase mb-4">Konsultasi</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 grid-margin stretch-card flex-column">
                            <div class="card">
                                <?php
                                // mengambil id user
                                $id_user = $_SESSION['id_user'];
                                // query untuk mengambil id ahligizi berdasarkan id user
                                $sql = "SELECT * FROM nutritionist WHERE id_user = $id_user";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $id_ahligizi = $row['ID_NUTRITIONIST'];
                                // query untuk menampilkan tabel pengajuan
                                $query = "SELECT consultation.id_consultation, patient.fullname_patient, nutritionist.fullname_nutritionist, consultation.DATE_CONSULTATION, consultation.STATUS_CONSULTATION FROM consultation
                                          INNER JOIN patient ON consultation.id_patient = patient.id_patient
                                          INNER JOIN nutritionist ON consultation.id_nutritionist = nutritionist.id_nutritionist
                                          WHERE consultation.id_nutritionist = $id_ahligizi AND consultation.STATUS_CONSULTATION IN ('sedang menunggu', 'dalam proses', 'selesai')";
                                $result3 = mysqli_query($conn, $query);
                                $no = 1;
                                ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pasien</th>
                                            <th>Nama Ahli Gizi</th>
                                            <th>Tanggal Konsultasi</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    if (mysqli_num_rows($result3) > 0) {
                                        while ($Row = mysqli_fetch_assoc($result3)) {
                                            $id_konsultasi = $Row['id_consultation'];
                                    ?>
                                            <tbody>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $Row['fullname_patient'] ?></td>
                                                    <td><?= $Row['fullname_nutritionist'] ?></td>
                                                    <td><?= $Row['DATE_CONSULTATION'] ?></td>
                                                    <td>
                                                        <?php
                                                        if ($Row['STATUS_CONSULTATION'] == "sedang menunggu") {
                                                            echo '<label class="badge badge-warning">' . $Row['STATUS_CONSULTATION'] . '</label>';
                                                        } elseif ($Row['STATUS_CONSULTATION'] == "dalam proses") {
                                                            echo '<label class="badge badge-primary">' . $Row['STATUS_CONSULTATION'] . '</label>';
                                                        } elseif ($Row['STATUS_CONSULTATION'] == "selesai") {
                                                            echo '<label class="badge badge-success">' . $Row['STATUS_CONSULTATION'] . '</label>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($Row['STATUS_CONSULTATION'] == "sedang menunggu") {
                                                        ?>
                                                            <form action="" method="GET" style="display:inline-block;">
                                                                <input type="hidden" name="id_konsultasi" value="<?= $id_konsultasi ?>">
                                                                <button type="submit" class="btn btn-success" name="terima">Terima</button>
                                                            </form>
                                                            <form action="" method="GET" style="display:inline-block;">
                                                                <input type="hidden" name="id_konsultasi" value="<?= $id_konsultasi ?>">
                                                                <button type="submit" class="btn btn-danger" name="tolak">Tolak</button>
                                                            </form>
                                                        <?php
                                                        } elseif ($Row['STATUS_CONSULTATION'] == "dalam proses") {
                                                        ?>
                                                            <a href="chat-ahligizi.php?id_consultation=<?= $id_konsultasi ?>" class="btn btn-info">Buka Chat</a>
                                                            <form action="" method="GET" style="display:inline-block;">
                                                                <input type="hidden" name="id_konsultasi" value="<?= $id_konsultasi ?>">
                                                                <button type="submit" class="btn btn-secondary" name="akhiri">Akhiri Konsultasi</button>
                                                            </form>
                                                        <?php
                                                        } elseif ($Row['STATUS_CONSULTATION'] == "selesai") {
                                                            echo '<a href="riwayat-chat-ahligizi.php?id_consultation=' . $id_konsultasi . '" class="btn btn-secondary">Lihat Riwayat</a>';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                    <?php
                                            $no++;
                                        }

                                        if (isset($_GET['terima'])) {
                                            $id_konsultasi = $_GET['id_konsultasi'];
                                            $status = "dalam proses";
                                            $query = "UPDATE consultation SET STATUS_CONSULTATION = '$status' WHERE id_consultation = '$id_konsultasi'";
                                            $result = mysqli_query($conn, $query);
                                            echo "<script>
                                                alert('Konsultasi berhasil diterima. Silahkan chat pasien Anda.');
                                                window.location.href = window.location.href.split('?')[0];
                                              </script>";
                                        } elseif (isset($_GET['tolak'])) {
                                            $id_konsultasi = $_GET['id_konsultasi'];
                                            $status = "selesai";
                                            $query = "UPDATE consultation SET STATUS_CONSULTATION = '$status' WHERE id_consultation = '$id_konsultasi'";
                                            $result = mysqli_query($conn, $query);
                                            echo "<script>
                                                alert('Konsultasi berhasil ditolak.');
                                                window.location.href = window.location.href.split('?')[0];
                                              </script>";
                                        } elseif (isset($_GET['akhiri'])) {
                                            $id_konsultasi = $_GET['id_konsultasi'];
                                            $status = "selesai";
                                            $query = "UPDATE consultation SET STATUS_CONSULTATION = '$status' WHERE id_consultation = '$id_konsultasi'";
                                            $result = mysqli_query($conn, $query);
                                            echo "<script>
                                                alert('Konsultasi berhasil diakhiri.');
                                                window.location.href = window.location.href.split('?')[0];
                                              </script>";
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
    </div>

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
    </body>

</html>