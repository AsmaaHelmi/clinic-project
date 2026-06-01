<?php

use App\Models\Doctor;
use App\Models\Major;

$majorId = $_GET['id'] ?? 0;

$major = Major::findById($pdo, $majorId);


$doctors = Doctor::getByMajor($pdo, $majorId);

?>

<div class="container">

    <nav
        style="--bs-breadcrumb-divider: '>';"
        aria-label="breadcrumb"
        class="fw-bold my-4 h4"
    >

        <ol class="breadcrumb justify-content-center">

            <li class="breadcrumb-item">

                <a
                    class="text-decoration-none"
                    href="index.php?page=home"
                >
                    Home
                </a>

            </li>

            <li class="breadcrumb-item">

                <a
                    class="text-decoration-none"
                    href="index.php?page=major"
                >
                    Majors
                </a>

            </li>

            <li
                class="breadcrumb-item active"
                aria-current="page"
            >
               
            <?= $major->getTitle(); ?> Doctors


            </li>

        </ol>

    </nav>

    <div class="d-flex flex-wrap gap-4 justify-content-center">

        <?php foreach ($doctors as $doctor): ?>

            <div
                class="card p-3"
                style="width: 18rem;"
            >

                <img
                    src="<?= $doctor->getImage(); ?>"
                    class="card-img-top rounded-circle card-image-circle"
                    alt="doctor"
                >

                <div class="card-body">

                    <h4 class="fw-bold text-center">

                        <?= $doctor->getName(); ?>

                    </h4>

                    <h6 class="fw-bold text-center">

                        <?= $doctor->getMajorTitle(); ?>

                    </h6>

                    <p class="text-center">

                        <?= $doctor->getDescription(); ?>

                    </p>

                    <a
                        href="index.php?page=book-appointment&id=<?= $doctor->getId(); ?>"
                        class="btn btn-outline-primary w-100"
                    >
                        Book Appointment
                    </a>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

