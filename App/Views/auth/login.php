<?php
use App\Models\User;
$error = ""; $success_message = "";
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $success_message = "Account created successfully! You can login now.";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $userModel = new User();
    $user = $userModel->findByEmail($email);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        // var_dump($user['role']);
        // exit; 
        if ($user['role'] === 'patient') {
            header("Location: index.php?page=patient-dashboard");
        } elseif($user['role'] === 'admin') {
            header("Location: index.php?page=dashboard"); 
        }
        exit();
    } else {
        $error = "Incorrect email or password.";
    }
}
?>
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="index.php?page=home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Login</li>
        </ol>
    </nav>
    <div class="d-flex flex-column gap-3 account-form mx-auto mt-5" style="max-width: 500px;">
        <form class="form" method="POST" action="index.php?page=login">
            <div class="form-items">
                <?php if(!empty($success_message)): ?>
                    <div class="alert alert-success py-2"><?php echo $success_message; ?></div>
                <?php endif; ?>
                <?php if(!empty($error)): ?>
                    <div class="alert alert-danger py-2"><?php echo $error; ?></div>
                <?php endif; ?>
                <div class="mb-3">
                    <label class="form-label required-label" for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="d-flex justify-content-center gap-2">
            <span>New patient?</span><a class="link" href="index.php?page=register"> Create account</a>
        </div>
    </div>
</div>