        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="slimscroll-menu">

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul class="metismenu" id="side-menu">

                        <li class="menu-title">Navigation</li>

                        <li>
                            <a href="<?php echo base_url('dashboard'); ?>" class="waves-effect">
                                <i class="remixicon-dashboard-line"></i>
                                <span> Dashboards </span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="fa-solid fa-server"></i>
                                <span> Data Master </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="<?php echo base_url('jenjang'); ?>">Data Jenjang Pendidikan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('ajaran'); ?>">Data Tahun Ajaran</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('guru'); ?>">Data Guru</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="fa-regular fa-file"></i>
                                <span> Manajemen Data </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="<?php echo base_url('transaksi'); ?>">Transaksi</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('laporan'); ?>">Laporan</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="fa-solid fa-users-gear"></i>
                                <span> Admin App </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="<?php echo base_url('user'); ?>">Data User</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('backupdata'); ?>">BackUp Data</a>
                                </li>
                            </ul>
                        </li>

                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->