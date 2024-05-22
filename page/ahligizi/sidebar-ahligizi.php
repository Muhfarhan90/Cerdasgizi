<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="dashboard-ahligizi.php">
                <i class="mdi mdi-account-box menu-icon"></i>
                <span class="menu-title">Dashboard</span>
                <!-- <div class="badge badge-danger">new</div> -->
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="profil-ahligizi.php">
                <i class="mdi mdi-account-box menu-icon"></i>
                <span class="menu-title">Profil</span>
                <!-- <div class="badge badge-danger">new</div> -->
            </a>
        </li>
       
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="typcn typcn-document-text menu-icon"></i>
                <span class="menu-title">Konsultasi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="konsultasi-ahligizi.php">Konsul Chat</a></li>
                    <li class="nav-item"> <a class="nav-link" href="janji-offline-ahligizi.php">Janji Offline</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="artikel-ahligizi.php">
                <i class="mdi mdi-file-document menu-icon"></i>
                <span class="menu-title">Artikel Kesehatan</span>
                <!-- <div class="badge badge-danger">new</div> -->
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.html" onclick="return confirm('Apakah Anda yakin ingin logout?');">
                <form action="" method="POST">
                    <i class="mdi mdi-logout menu-icon"></i>
                    <button class="badge badge-danger btn-rounded btn-fw" type="submit" name="logout">Logout</button>
                </form>

                <!-- <div class="badge badge-danger">new</div> -->
            </a>
        </li>
    </ul>
</nav>