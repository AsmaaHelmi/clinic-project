<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Appointments</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Appointments List</h3>
                </div>

                <div class="card-body table-responsive p-0">




                    <table class="table table-hover text-nowrap">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Patient Name</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($appointments)): ?>

                                <?php foreach ($appointments as $appointment): ?>

                                    <tr>

                                        <td><?= $appointment['id'] ?></td>

                                        <td><?= htmlspecialchars($appointment['patient_name']) ?></td>

                                        <td><?= htmlspecialchars($appointment['phone']) ?></td>

                                        <td><?= $appointment['appointment_date'] ?></td>

                                        <td><?= $appointment['appointment_time'] ?></td>

                                        <td>

                                            <?php if ($appointment['status'] == 'pending'): ?>

                                                <span class="badge badge-warning">
                                                    Pending
                                                </span>

                                            <?php elseif ($appointment['status'] == 'confirmed'): ?>

                                                <span class="badge badge-primary">
                                                    Confirmed
                                                </span>

                                            <?php elseif ($appointment['status'] == 'completed'): ?>

                                                <span class="badge badge-success">
                                                    Completed
                                                </span>

                                            <?php elseif ($appointment['status'] == 'cancelled'): ?>

                                                <span class="badge badge-danger">
                                                    Cancelled
                                                </span>

                                            <?php endif; ?>

                                        </td>

                                        <td class="project-actions">

                                            <?php if ($appointment['status'] == 'pending'): ?>

                                                <a href="index.php?page=appointment-controller&action=confirm&id=<?= $appointment['id'] ?>"
                                                    class="btn btn-success btn-sm"
                                                    title="Confirm Appointment"
                                                    onclick="return confirm('Confirm this appointment?');">
                                                    <i class="fas fa-check"></i> Confirm
                                                </a>

                                                <a href="index.php?page=appointment-controller&action=cancel&id=<?= $appointment['id'] ?>"
                                                    class="btn btn-warning btn-sm"
                                                    title="Cancel Appointment"
                                                    onclick="return confirm('Are you sure you want to cancel this appointment?');">
                                                    <i class="fas fa-times"></i> Cancel
                                                </a>

                                            <?php elseif ($appointment['status'] == 'confirmed'): ?>

                                                <a href="index.php?page=appointment-controller&action=cancel&id=<?= $appointment['id'] ?>"
                                                    class="btn btn-warning btn-sm"
                                                    title="Cancel Appointment"
                                                    onclick="return confirm('Are you sure you want to cancel this appointment?');">
                                                    <i class="fas fa-times"></i> Cancel
                                                </a>

                                            <?php elseif ($appointment['status'] == 'completed'): ?>

                                                <span class="text-muted">No Actions</span>

                                            <?php elseif ($appointment['status'] == 'cancelled'): ?>

                                                <span class="text-muted">Cancelled</span>

                                            <?php endif; ?>

                                            &nbsp;
                                            <a href="index.php?page=appointment-controller&action=delete&id=<?= $appointment['id'] ?>"
                                                class="btn btn-danger btn-sm"
                                                title="Delete Appointment"
                                                onclick="return confirm('Are you sure you want to delete this appointment? This action cannot be undone.');">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>
                                    <td colspan="7" class="text-center">
                                        No Appointments Found
                                    </td>
                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </section>

</div>