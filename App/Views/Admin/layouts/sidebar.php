
<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" class="brand-link">

        <img
            src="<?= BASE_URL ?>App/Views/Admin/assets/img/AdminLTELogo.png"
            alt="Clinic Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8"
        >

        <span class="brand-text font-weight-light">

            Clinic Dashboard

        </span>

    </a>

    <div class="sidebar">

        <nav class="mt-2">

            <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false"
            >

<?php if (
    isset($_SESSION['user'])
    && $_SESSION['user']['role'] === 'doctor'
): ?>



                    <!-- Doctor Dashboard -->

                    <li class="nav-item">

                        <a
                            href="index.php?page=doctor-dashboard"
                            class="nav-link"
                        >

                            <i class="nav-icon fas fa-user-md"></i>

                            <p>Doctor Dashboard</p>

                        </a>

                    </li>

                    <!-- Logout -->

                    <li class="nav-item">

                        <a
                            href="index.php?page=logout"
                            class="nav-link text-danger"
                        >

                            <i class="nav-icon fas fa-sign-out-alt"></i>

                            <p>Logout</p>

                        </a>

                    </li>

                <?php else: ?>

                    <!-- Doctors -->

                    <li class="nav-item">

                        <a
                            href="index.php?page=admin-doctor"
                            class="nav-link"
                        >

                            <i class="nav-icon fas fa-user-md"></i>

                            <p>Doctors</p>

                        </a>

                    </li>

                    <!-- Majors -->

                    <li class="nav-item">

                        <a
                            href="index.php?page=admin-major"
                            class="nav-link"
                        >

                            <i class="nav-icon fas fa-stethoscope"></i>

                            <p>Majors</p>

                        </a>

                    </li>

                    <!-- Appointments -->

                    <li class="nav-item">

                        <a
                            href="index.php?page=admin-appointments"
                            class="nav-link"
                        >

                            <i class="nav-icon fas fa-calendar-check"></i>

                            <p>Appointments</p>

                        </a>

                    </li>

                    <!-- Logout -->

                    <li class="nav-item">

                        <a
                            href="index.php?page=admin-logout"
                            class="nav-link text-danger"
                        >

                            <i class="nav-icon fas fa-sign-out-alt"></i>

                            <p>Logout</p>

                        </a>

                    </li>

                <?php endif; ?>

            </ul>

        </nav>

    </div>

</aside>

