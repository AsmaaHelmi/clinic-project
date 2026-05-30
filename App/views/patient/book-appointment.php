<?php

use App\Models\Appointment;
use App\Models\Doctor;
use App\Core\Helper;

$doctorId = $_GET['id'] ?? null;

$doctor = Doctor::findById($pdo, $doctorId);

?>

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

                 <?= $doctor->getName() ?>

            </li>

        </ol>

    </nav>


    <div class="d-flex flex-column gap-3 details-card doctor-details">

        <div class="details d-flex gap-2 align-items-center">

            <img
                src="<?= $doctor->getImage() ?>"
                alt="doctor"
                class="img-fluid rounded-circle"
                height="150"
                width="150"
            >


            <div class="details-info d-flex flex-column gap-3">

                <h4 class="card-title fw-bold">

                    <?= $doctor->getName() ?>
                </h4>

                <h6 class="card-title fw-bold">
                    <?= $doctor->getMajorTitle() ?>

                </h6>

                <p>

                    <?= $doctor->getDescription() ?>

                </p>

            </div>

        </div>

        <hr />


        <?php Helper::showMessage(); ?>


        <?php

            $times = [
                '9:00 AM',
                '10:00 AM',
                '11:00 AM',
                '12:00 PM',
                '1:00 PM',
                '2:00 PM',
            ];

            $selectedDate = $_POST['appointment_date'] ?? '';

            $bookedTimes = [];

            if ($selectedDate) {

                $bookedTimes = Appointment::getBookedTimes(
                    $pdo,
                    $doctorId,
                    $selectedDate
                );

            }

        ?>


        <form
            class="form"
            method="POST"
            action="?page=book-appointment&id=<?= $doctorId ?>"
        >

            <input
                type="hidden"
                name="doctor_id"
                value="<?= $doctorId ?>"
            >


            <div class="form-items">


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
                        value="<?= $_POST['phone'] ?? '' ?>"
                        required
                    />

                </div>



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
                        value="<?= $selectedDate ?>"
                        min="<?= date('Y-m-d') ?>"
                        required
                    />

                </div>



                <?php if (!$selectedDate): ?>

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

                <input
                    type="hidden"
                    name="doctor_id"
                    value="<?= $doctorId ?>"
                >

                <input
                    type="hidden"
                    name="phone"
                    value="<?= $_POST['phone'] ?>"
                >

                <input
                    type="hidden"
                    name="appointment_date"
                    value="<?= $selectedDate ?>"
                >


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
                                value="<?= $time ?>"
                                <?= $isBooked ? 'disabled' : '' ?>
                            >

                                <?= $time ?>

                                <?= $isBooked ? ' (Booked)' : '' ?>

                            </option>

                        <?php endforeach; ?>

                    </select>



                    <?php if (count($bookedTimes) == count($times)): ?>

                        <div class="text-danger mt-2">

                            No available appointments for this day

                        </div>

                    <?php endif; ?>

                </div>



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