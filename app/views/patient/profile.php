<?php
use app\models\Patient;
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'patient') {
    header("Location: index.php?page=login");
    exit();
}
$patientModel = new Patient(); $message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    if (!empty($name)) {
        if ($patientModel->updateProfile($_SESSION['user_id'], $name)) {
            $_SESSION['user_name'] = $name;
            $message = "Profile updated successfully.";
        } else {
            $message = "An error occurred during update.";
        }
    }
}
$profile = $patientModel->getProfile($_SESSION['user_id']);
?>
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="index.php?page=patient-dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>
    <div class="d-flex flex-column gap-3 account-form mx-auto mt-5" style="max-width: 500px;">
        <form class="form" method="POST" action="index.php?page=patient-profile">
            <div class="form-items">
                <?php if(!empty($message)): ?>
                    <div class="alert alert-success py-2"><?php echo $message; ?></div>
                <?php endif; ?>
                <div class="mb-3">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?php echo htmlspecialchars($profile['name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email (Cannot be changed)</label>
                    <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($profile['email']); ?>" disabled>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
        </form>
    </div>
</div>