        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <img src="<?php echo base_url().'assets/admin/dist/img/AdminLTELogo.png'; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo base_url().'assets/img/user.png'; ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $this->session->userdata('nama'); ?></a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?php echo base_url().'Dashboard'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">TRANSACTION</li>
                        <li class="nav-item">
                            <a href="<?php echo base_url().'Transaksi'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>
                                    Contact List
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">REPORTS</li>
                        <li class="nav-item">
                            <a href="<?php echo base_url().'Report'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Laporan Contact List
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url().'Total'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Laporan Total Contact List
                                </p>
                            </a>
                        </li>
                        <?php
                            if($this->session->userdata('level') == '0')
                            {
                                ?>
                                    <li class="nav-header">MASTER DATA</li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'Periode'; ?>" class="nav-link">
                                            <i class="nav-icon fas fa-calendar-check"></i>
                                            <p>
                                                Periode
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'Karyawan'; ?>" class="nav-link">
                                            <i class="nav-icon fas fa-user-alt"></i>
                                            <p>
                                                Employee
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'Machine'; ?>" class="nav-link">
                                            <i class="nav-icon fas fa-industry"></i>
                                            <p>
                                                Machine
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'Project'; ?>" class="nav-link">
                                            <i class="nav-icon fas fa-project-diagram"></i>
                                            <p>
                                                Project
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'Material'; ?>" class="nav-link">
                                            <i class="nav-icon fas fa-tasks"></i>
                                            <p>
                                                Material
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'Defect'; ?>" class="nav-link">
                                            <i class="nav-icon fas fa-tasks"></i>
                                            <p>
                                                Defect List
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'Type'; ?>" class="nav-link">
                                            <i class="nav-icon fas fa-tasks"></i>
                                            <p>
                                                Abnormality Type
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'Satuan'; ?>" class="nav-link">
                                            <i class="nav-icon fas fa-tasks"></i>
                                            <p>
                                                UoM
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'User'; ?>" class="nav-link">
                                            <i class="nav-icon fas fa-users"></i>
                                            <p>
                                                Users
                                            </p>
                                        </a>
                                    </li>
                                <?php
                            }
                        ?>

                        <li class="nav-item">
                            <a href="<?php echo base_url().'Login/logout'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Sign-Out
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>