    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="<?= base_url(); ?>assets/images/project.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light" style="font-size: 20px; font-weight: bold;"><b>Small Project Test</b></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?= base_url(); ?>assets/images/user_blank.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Operator</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="<?= base_url('main') ?>" class="nav-link <?= $this->uri->segment(1) == 'main' && $this->uri->segment(2) == '' ? ' active' : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">Data Master</li>

                    <li class="nav-item">
                        <a href="<?= base_url('jurusan') ?>" class="nav-link <?= $this->uri->segment(1) == 'jurusan' ? ' active' : '' ?>">
                            <i class="nav-icon fas fa-graduation-cap"></i>
                            <p>
                                Jurusan
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url('matakuliah') ?>" class="nav-link <?= $this->uri->segment(1) == 'matakuliah' ? ' active' : '' ?>">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Mata Kuliah
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('mahasiswa') ?>" class="nav-link <?= $this->uri->segment(1) == 'mahasiswa' ? ' active' : '' ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Mahasiswa
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">Data Transaksi</li>
                    <li class="nav-item">
                        <a href="<?= base_url('transkrip_nilai') ?>" class="nav-link <?= $this->uri->segment(1) == 'transkrip_nilai' ? ' active' : '' ?>">
                            <i class="nav-icon fas fa-graduation-cap"></i>
                            <p>
                                Transkrip Nilai
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">Data Report</li>

                    <li class="nav-item">
                        <a href="<?= base_url('report') ?>" class="nav-link <?= $this->uri->segment(1) == 'report' ? ' active' : '' ?>">
                            <i class="nav-icon fas fa-file-pdf"></i>
                            <p>
                                Report Transkrip Nilai
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>