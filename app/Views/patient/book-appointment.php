<div class="container">

    <nav
        style="--bs-breadcrumb-divider: '>'"
        aria-label="breadcrumb"
        class="fw-bold my-4 h4"
    >
        <ol class="breadcrumb justify-content-center">

            <li class="breadcrumb-item">
                <a class="text-decoration-none" href="index.php">
                    Home
                </a>
            </li>

            <li class="breadcrumb-item">
                <a class="text-decoration-none" href="?page=doctors">
                    Doctors
                </a>
            </li>

            <li class="breadcrumb-item active" aria-current="page">

                Doctor Name

                <!-- later -->
                <!-- <?php /*echo $doctor['name']*/?> -->

            </li>

        </ol>
    </nav>


    <div class="d-flex flex-column gap-3 details-card doctor-details">

        <!-- doctor info -->

        <div class="details d-flex gap-2 align-items-center">


            <img
                src="public/assets/images/major.jpg"
                alt="doctor"
                class="img-fluid rounded-circle"
                height="150"
                width="150"
            />

            <!-- later -->
            <!-- src="<?php /*echo $doctor['image'] */?>" -->


            <div class="details-info d-flex flex-column gap-3">

                <h4 class="card-title fw-bold">

                    Doctor Name

                    <!-- later -->
                    <!-- <?php /*echo $doctor['name']*/?> -->

                </h4>

                <h6 class="card-title fw-bold">

                    Doctor Major and summary about the doctor

                    <!-- later -->
                    <!-- <?php /*echo $doctor['description'] */?> -->

                </h6>

            </div>

        </div>

        <hr />


        <?php

            /*
            later:
            doctor id will come dynamically
        */

            $doctorId = 1;

            /*
            all clinic times
        */

            $times = [
                '9:00 AM',
                '10:00 AM',
                '11:00 AM',
                '12:00 PM',
                '1:00 PM',
                '2:00 PM',
            ];

            /*
            selected date
        */

            $selectedDate = $_POST['appointment_date'] ?? '';

            /*
            later:
            booked times will come from database

            example:

            $sql = "
            SELECT appointment_time
            FROM appointments
            WHERE doctor_id = ?
            AND appointment_date = ?
            ";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $doctorId,
                $selectedDate
            ]);

            $bookedTimes = $stmt->fetchAll(PDO::FETCH_COLUMN);
        */

            /*
            temporary booked times
        */

            $bookedTimes = [];

            if ($selectedDate == '2026-05-25') {
                $bookedTimes = [
                    '10:00 AM',
                    '1:00 PM',
                ];
            }

            if ($selectedDate == '2026-05-26') {
                $bookedTimes = [
                    '9:00 AM',
                    '10:00 AM',
                    '11:00 AM',
                    '12:00 PM',
                    '1:00 PM',
                    '2:00 PM',
                ];
            }

        ?>


        <!-- booking form -->
<!-- <?/*php showMessage()*/?> -->
       <form
    class="form"
    method="POST"
    action="?page=book-appointment"
>

    <input
        type="hidden"
        name="doctor_id"
        value="<?php echo $doctorId; ?>"
    >


    <div class="form-items">


        <!-- phone -->

        <div class="mb-3">

            <label
                class="form-label required-label"
                for="phone"
            >
                Phone
            </label>

            <input
                type="tel"
                class="form-control"
                id="phone"
                name="phone"
                value="<?php echo $_POST['phone'] ?? ''; ?>"
                required
            />

        </div>



        <!-- appointment date -->

        <div class="mb-3">

            <label
                class="form-label required-label"
                for="appointment_date"
            >
                Appointment Date
            </label>

           <input
                type="date"
                class="form-control"
                id="appointment_date"
                name="appointment_date"
                value="<?php echo $selectedDate; ?>"
                min="<?php echo date('Y-m-d'); ?>"
                required
            />

        </div>



        <!-- check available times -->

        <?php if (! $selectedDate): ?>

            <button
                type="submit"
                name="check_times"
                class="btn btn-outline-primary mb-4"
            >
                Check Available Times
            </button>

        <?php endif; ?>

    </div>

</form>
<?php if ($selectedDate): ?>

    <form
        method="POST"
        action="?page=appointment-controller"
    >

        <!-- keep old data -->

        <input
            type="hidden"
            name="doctor_id"
            value="<?php echo $doctorId; ?>"
        >

        <input
            type="hidden"
            name="phone"
            value="<?php echo $_POST['phone']; ?>"
        >

        <input
            type="hidden"
            name="appointment_date"
            value="<?php echo $selectedDate; ?>"
        >


        <!-- appointment time -->

        <div class="mb-3">

            <label
                class="form-label required-label"
                for="appointment_time"
            >
                Appointment Time
            </label>


            <select
                class="form-select"
                id="appointment_time"
                name="appointment_time"
                required
            >

                <option value="">
                    Select Time
                </option>


                <?php foreach ($times as $time): ?>

                    <?php
                        $isBooked = in_array($time, $bookedTimes);
                    ?>


                    <option
                        value="<?php echo $time; ?>"
                        <?php echo $isBooked ? 'disabled' : ''; ?>
                    >

                        <?php echo $time; ?>

                        <?php
                            echo $isBooked ? ' (Booked)' : '';
                        ?>

                    </option>

                <?php endforeach; ?>

            </select>



            <?php if (count($bookedTimes) == count($times)): ?>

                <div class="text-danger mt-2">

                    No available appointments for this day

                </div>

            <?php endif; ?>


        </div>



        <!-- confirm booking -->

        <button
            type="submit"
            class="btn btn-primary"
        >
            Confirm Booking
        </button>

    </form>

<?php endif; ?>

    </div>

</div>