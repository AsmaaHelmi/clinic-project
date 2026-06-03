<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" class="brand-link">
        <img src="<?= BASE_URL ?>App/Views/Admin/assets/img/AdminLTELogo.png"
             class="brand-image img-circle elevation-3" style="opacity:.8">
        <span class="brand-text font-weight-light">Clinic Dashboard</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column">

                <?php $role = $_SESSION['user_role'] ?? null; ?>

                
                <?php if ($role === 'admin'): ?>

                    <li class="nav-item">
                        <a href="index.php?page=dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?page=admin-doctor" class="nav-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Doctors</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?page=admin-major" class="nav-link">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Majors</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?page=admin-patients" class="nav-link">
                            <i class="nav-icon fas fa-user-injured"></i>
                            <p>Patients</p>
                        </a>
                    </li>

                
                <?php elseif ($role === 'doctor'): ?>

                    <li class="nav-item">
                        <a href="index.php?page=doctor-dashboard" class="nav-link">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Appointments</p>
                        </a>
                    </li>

                
                <?php elseif ($role === 'patient'): ?>

                    <li class="nav-item">
                        <a href="index.php?page=patient-dashboard" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?page=book-appointment" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>Book Appointment</p>
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

        </nav>
    </div>

</aside>