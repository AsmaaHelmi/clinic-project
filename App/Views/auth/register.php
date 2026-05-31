<?php

use App\Models\User;

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($name) && !empty($email) && !empty($password)) {

        $userModel = new User();

        if ($userModel->findByEmail($email)) {

            $message = "This email is already registered!";

        } else {

            $result = $userModel->createUser(

                $name,
                $email,
                $password,
                'patient'

            );

            if ($result) {

                $user = $userModel->findByEmail($email);

                $_SESSION['user'] = [

                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']

                ];

                echo "
<script>
window.location.href='index.php?page=home';
</script>
";
 exit();

            } else {

                $message = "An error occurred during registration.";

            }
        }

    } else {

        $message = "Please fill in all required fields.";

    }
}

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

            <li class="breadcrumb-item active" aria-current="page">

                Register

            </li>

        </ol>

    </nav>

    <div
        class="d-flex flex-column gap-3 account-form mx-auto mt-5"
        style="max-width: 500px;"
    >

        <form
            class="form"
            method="POST"
            action="index.php?page=register"
        >

            <div class="form-items">

                <?php if (!empty($message)): ?>

                    <div class="alert alert-danger py-2">

                        <?php echo $message; ?>

                    </div>

                <?php endif; ?>

                <div class="mb-3">

                    <label
                        class="form-label required-label"
                        for="name"
                    >
                        Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        id="name"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label
                        class="form-label required-label"
                        for="email"
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        id="email"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label
                        class="form-label required-label"
                        for="password"
                    >
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        id="password"
                        required
                    >

                </div>

            </div>

            <button
                type="submit"
                class="btn btn-primary w-100"
            >
                Create account
            </button>

        </form>

        <div class="d-flex justify-content-center gap-2">

            <span>already have an account?</span>

            <a
                class="link"
                href="index.php?page=login"
            >
                login
            </a>

        </div>

    </div>

</div>

