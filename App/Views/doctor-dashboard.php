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

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>
                                    <td colspan="6" class="text-center">
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