<?php
include("../../logout.php");
include("../../database/database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../../vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php
    include('navbar-admin.php');
    ?>
    <!-- partial -->
    <!-- Fitur Search -->
    <nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
      <div class="navbar-links-wrapper d-flex align-items-stretch">
        <!-- <div class="nav-link">
                    <a href="javascript:;"><i class="typcn typcn-calendar-outline"></i></a>
                </div>
                <div class="nav-link">
                    <a href="javascript:;"><i class="typcn typcn-mail"></i></a>
                </div>
                <div class="nav-link">
                    <a href="javascript:;"><i class="typcn typcn-folder"></i></a>
                </div>
                <div class="nav-link">
                    <a href="javascript:;"><i class="typcn typcn-document-text"></i></a>
                </div> -->
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <!-- <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item ml-0">
                        <h4 class="mb-0">Dashboard</h4>
                    </li>
                    <li class="nav-item">
                        <div class="d-flex align-items-baseline">
                            <p class="mb-0">Home</p>
                            <i class="typcn typcn-chevron-right"></i>
                            <p class="mb-0">Main Dahboard</p>
                        </div>
                    </li>
                </ul> -->
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-search d-none d-md-block mr-0">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search..." aria-label="search" aria-describedby="search">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="typcn typcn-zoom"></i>
                </span>
              </div>
            </div>
          </li>
        </ul>
      </div>

    </nav>
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
include('sidebar-admin.php');
      ?>
      <!-- partial -->
      <div class="main-panel">

        <div class="content-wrapper">
          <!-- Judul fitur -->
          <div class="row">

            <div class="col-xl-6 grid-margin stretch-card flex-column">
              <h1 class="mb-2 text-titlecase mb-4">Data Pasien</h1>
            </div>
            <div class="col-md-6 grid-margin flex-column text-md-right">
              <a href="tambah-pasien.php"><button type="button" class="btn btn-primary btn-icon-text">
                  <i class="typcn typcn-document btn-icon-prepend"></i>
                  Tambah
                </button></a>

            </div>


          </div>
          <!-- Tabel CRUD -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="table-responsive pt-3">
                  <table class="table table-striped project-orders-table">
                    <thead>
                      <tr>
                        <th class="ml-5">NO</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Tinggi (Cm)</th>
                        <th>Berat (Kg)</th>
                        <th>Foto Profil</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT * FROM patient";
                      $result = mysqli_query($conn, $query);
                      $i = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                        <tr>
                          <td><?= $i ?></td>
                          <td><?= $row['FULLNAME_PATIENT'] ?></td>
                          <td><?= $row['EMAIL_PATIENT'] ?></td>
                          <td><?= $row['DATE_OF_BIRTH'] ?></td>
                          <td><?= $row['GENDER'] ?></td>
                          <td><?= $row['HEIGHT'] ?></td>
                          <td><?= $row['WEIGHT'] ?></td>
                          <td><img src="../../images/icons8-user-32.png"></td>
                          <td>
                            <div class="d-flex align-items-center">
                              <a href="edit-pasien.php?id=<?= $row['ID_PATIENT'] ?>"><button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                  Edit
                                  <i class="typcn typcn-edit btn-icon-append"></i>
                                </button></a>
                              <a href="hapus-pasien.php?id=<?= $row['ID_PATIENT'] ?>& id_user=<?= $row['ID_USER'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn btn-icon-text"><button type="submit" class="btn btn-danger btn-sm btn-icon-text" name="hapus-pasien">
                                  Delete
                                  <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                </button></a>

                            </div>
                          </td>
                        </tr>
                      <?php
                        $i++;
                      }

                      ?>

                      <!-- <tr>
                                                <td>#D2</td>
                                                <td>Correlation natural resources silo</td>
                                                <td>Mitchel Dunford</td>
                                                <td>09 Oct 2019</td>
                                                <td>$ 3233</td>
                                                <td>5.4K</td>
                                                <td>asd</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                            Edit
                                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                                                            Delete
                                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#D3</td>
                                                <td>social capital compassion social</td>
                                                <td>Pei Canaday</td>
                                                <td>18 Jun 2019</td>
                                                <td>$ 4311</td>
                                                <td>2.1K</td>
                                                <td>asdasd</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                            Edit
                                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                                                            Delete
                                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#D4</td>
                                                <td>empower communities thought</td>
                                                <td>Gaynell Sharpton</td>
                                                <td>23 Mar 2019</td>
                                                <td>$ 7743</td>
                                                <td>2.7K</td>
                                                <td>123123</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                            Edit
                                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                                                            Delete
                                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#D5</td>
                                                <td> Targeted effective; mobilize </td>
                                                <td>Audrie Midyett</td>
                                                <td>22 Aug 2019</td>
                                                <td>$ 2455</td>
                                                <td>1.2K</td>
                                                <td>17231</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                            Edit
                                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                                                            Delete
                                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr> -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- Grafik -->
          <!-- <div class="content-wrapper">

          <div class="row">
            <div class="col-xl-6 grid-margin stretch-card flex-column">
                <h5 class="mb-2 text-titlecase mb-4">Status statistics</h5>
              <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body d-flex flex-column justify-content-between">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="mb-0 text-muted">Transactions</p>
                        <p class="mb-0 text-muted">+1.37%</p>
                      </div>
                      <h4>1352</h4>
                      <canvas id="transactions-chart" class="mt-auto" height="65"></canvas>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body d-flex flex-column justify-content-between">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                          <p class="mb-2 text-muted">Sales</p>
                          <h6 class="mb-0">563</h6>
                        </div>
                        <div>
                          <p class="mb-2 text-muted">Orders</p>
                          <h6 class="mb-0">720</h6>
                        </div>
                        <div>
                          <p class="mb-2 text-muted">Revenue</p>
                          <h6 class="mb-0">5900</h6>
                        </div>
                      </div>
                      <canvas id="sales-chart-a" class="mt-auto" height="65"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row h-100">
                <div class="col-md-6 stretch-card grid-margin grid-margin-md-0">
                  <div class="card">
                    <div class="card-body d-flex flex-column justify-content-between">
                      <p class="text-muted">Sales Analytics</p>
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <h3 class="mb-">27632</h3>
                        <h3 class="mb-">78%</h3>
                      </div>
                      <canvas id="sales-chart-b" class="mt-auto" height="38"></canvas>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div class="row h-100">
                        <div class="col-6 d-flex flex-column justify-content-between">
                          <p class="text-muted">CPU</p>
                          <h4>55%</h4>
                          <canvas id="cpu-chart" class="mt-auto"></canvas>
                        </div>
                        <div class="col-6 d-flex flex-column justify-content-between">
                          <p class="text-muted">Memory</p>
                          <h4>123,65</h4>
                          <canvas id="memory-chart" class="mt-auto"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 grid-margin stretch-card flex-column">
              <h5 class="mb-2 text-titlecase mb-4">Income statistics</h5>
              <div class="row h-100">
                <div class="col-md-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-start flex-wrap">
                        <div>
                          <p class="mb-3">Monthly Increase</p>
                          <h3>67842</h3>
                        </div>
                        <div id="income-chart-legend" class="d-flex flex-wrap mt-1 mt-md-0"></div>
                      </div>
                      <canvas id="income-chart"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xl-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body border-bottom">
                  <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-2 mb-md-0 text-uppercase font-weight-medium">Overall sales</h6>
                    <div class="dropdown">
                      <button class="btn bg-white p-0 pb-1 text-muted btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Last 30 days
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        <h6 class="dropdown-header">Settings</h6>
                        <a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:;">Separated link</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="sales-chart-c" class="mt-2"></canvas>
                  <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3 mt-4">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                      <p class="text-muted">Gross Sales</p>
                      <h5>492</h5>
                      <div class="d-flex align-items-baseline">
                        <p class="text-success mb-0">0.5%</p>
                        <i class="typcn typcn-arrow-up-thick text-success"></i>
                      </div>
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-center">
                      <p class="text-muted">Purchases</p>
                      <h5>87k</h5>
                      <div class="d-flex align-items-baseline">
                        <p class="text-success mb-0">0.8%</p>
                        <i class="typcn typcn-arrow-up-thick text-success"></i>
                      </div>
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-center">
                      <p class="text-muted">Tax Return</p>
                      <h5>882</h5>
                      <div class="d-flex align-items-baseline">
                        <p class="text-danger mb-0">-04%</p>
                        <i class="typcn typcn-arrow-down-thick text-danger"></i>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="dropdown">
                      <button class="btn bg-white p-0 pb-1 pt-1 text-muted btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Last 7 days
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        <h6 class="dropdown-header">Settings</h6>
                        <a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:;">Separated link</a>
                      </div>
                    </div>
                    <p class="mb-0">overview</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4 grid-margin stretch-card">
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card newsletter-card bg-gradient-warning">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center justify-content-center h-100">
                        <h5 class="mb-3 text-white">Newsletter</h5>
                        <form class="form d-flex flex-column align-items-center justify-content-between w-100">
                          <div class="form-group mb-2 w-100">
                            <input type="text" class="form-control" placeholder="email address">
                          </div>
                          <button class="btn btn-danger btn-rounded mt-1" type="submit">Subscribe</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 stretch-card">
                  <div class="card profile-card bg-gradient-primary">
                    <div class="card-body">
                      <div class="row align-items-center h-100">
                        <div class="col-md-4">
                          <figure class="avatar mx-auto mb-4 mb-md-0">
                            <img src="images/faces/face20.jpg" alt="avatar">
                          </figure>
                        </div>
                        <div class="col-md-8">
                          <h5 class="text-white text-center text-md-left">Phoebe Kennedy</h5>
                          <p class="text-white text-center text-md-left">kennedy@gmail.com</p>
                          <div class="d-flex align-items-center justify-content-between info pt-2">
                            <div>
                              <p class="text-white font-weight-bold">Birth date</p>
                              <p class="text-white font-weight-bold">Birth city</p>
                            </div>
                            <div>
                              <p class="text-white">16 Sep 2019</p>
                              <p class="text-white">Netherlands</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body border-bottom">
                  <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-2 mb-md-0 text-uppercase font-weight-medium">Sales statistics</h6>
                    <div class="dropdown">
                      <button class="btn bg-white p-0 pb-1 text-muted btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Last 7 days
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton4">
                        <h6 class="dropdown-header">Settings</h6>
                        <a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:;">Separated link</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="sales-chart-d" height="320"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                      <p class="mb-2 text-md-center text-lg-left">Total Expenses</p>
                      <h1 class="mb-0">8742</h1>
                    </div>
                    <i class="typcn typcn-briefcase icon-xl text-secondary"></i>
                  </div>
                  <canvas id="expense-chart" height="80"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                      <p class="mb-2 text-md-center text-lg-left">Total Budget</p>
                      <h1 class="mb-0">47,840</h1>
                    </div>
                    <i class="typcn typcn-chart-pie icon-xl text-secondary"></i>
                  </div>
                  <canvas id="budget-chart" height="80"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                      <p class="mb-2 text-md-center text-lg-left">Total Balance</p>
                      <h1 class="mb-0">$7,243</h1>
                    </div>
                    <i class="typcn typcn-clipboard icon-xl text-secondary"></i>
                  </div>
                  <canvas id="balance-chart" height="80"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="table-responsive pt-3">
                  <table class="table table-striped project-orders-table">
                    <thead>
                      <tr>
                        <th class="ml-5">ID</th>
                        <th>Project name</th>
                        <th>Customer</th>
                        <th>Deadline</th>
                        <th>Payouts	</th>
                        <th>Traffic</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>#D1</td>
                        <td>Consectetur adipisicing elit </td>
                        <td>Beulah Cummings</td>
                        <td>03 Jan 2019</td>
                        <td>$ 5235</td>
                        <td>1.3K</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                              Edit
                              <i class="typcn typcn-edit btn-icon-append"></i>                          
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                              Delete
                              <i class="typcn typcn-delete-outline btn-icon-append"></i>                          
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>#D2</td>
                        <td>Correlation natural resources silo</td>
                        <td>Mitchel Dunford</td>
                        <td>09 Oct 2019</td>
                        <td>$ 3233</td>
                        <td>5.4K</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                              Edit
                              <i class="typcn typcn-edit btn-icon-append"></i>                          
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                              Delete
                              <i class="typcn typcn-delete-outline btn-icon-append"></i>                          
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>#D3</td>
                        <td>social capital compassion social</td>
                        <td>Pei Canaday</td>
                        <td>18 Jun 2019</td>
                        <td>$ 4311</td>
                        <td>2.1K</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                              Edit
                              <i class="typcn typcn-edit btn-icon-append"></i>                          
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                              Delete
                              <i class="typcn typcn-delete-outline btn-icon-append"></i>                          
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>#D4</td>
                        <td>empower communities thought</td>
                        <td>Gaynell Sharpton</td>
                        <td>23 Mar 2019</td>
                        <td>$ 7743</td>
                        <td>2.7K</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                              Edit
                              <i class="typcn typcn-edit btn-icon-append"></i>                          
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                              Delete
                              <i class="typcn typcn-delete-outline btn-icon-append"></i>                          
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>#D5</td>
                        <td> Targeted effective; mobilize </td>
                        <td>Audrie Midyett</td>
                        <td>22 Aug 2019</td>
                        <td>$ 2455</td>
                        <td>1.2K</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                              Edit
                              <i class="typcn typcn-edit btn-icon-append"></i>                          
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                              Delete
                              <i class="typcn typcn-delete-outline btn-icon-append"></i>                          
                            </button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div> -->

          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <!-- <footer class="footer">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Free <a href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrap dashboard</a> templates from Bootstrapdash.com</span>
                    </div>
                </div>    
            </div>        
        </footer> -->
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- base:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
</body>

</html>