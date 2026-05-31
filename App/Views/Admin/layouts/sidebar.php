<!-- Sidebar -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<a href="#" class="brand-link">
					<img src="/clinic_project/App/Views/Admin/assets/img/AdminLTELogo.png" alt="Clinic Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text font-weight-light">Clinic Dashboard</span>
				</a>
				<div class="sidebar">
					<nav class="mt-2">
						
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') :?>
							
						<li class="nav-item">
								<a href="index.php?page=dashboard" class="nav-link">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>Dashboard</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="appointments.html" class="nav-link">
									<i class="nav-icon fas fa-calendar-check"></i>
									<p>Appointments</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="patients.html" class="nav-link">
									<i class="nav-icon fas fa-user-injured"></i>
									<p>Patients</p>
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
									<i class="nav-icon fas fa-user-md"></i>
									<p>Majors</p>
								</a>
							</li>
						
						  
<?php else :?>
	
							<li class="nav-item">
								<a href="index.php?page=admin-doctor" class="nav-link">
									<i class="nav-icon fas fa-user-md"></i>
									<p>Doctors</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="index.php?page=admin-major" class="nav-link">
									<i class="nav-icon fas fa-user-md"></i>
									<p>Majors</p>
								</a>
							</li>
							</ul>
							<?php endif;?>
						
					</nav>
				</div>
			</aside>