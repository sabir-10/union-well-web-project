<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

$errorMessage = '';

if (is_post_request()) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        redirect('/admin/dashboard.php');
    }

    $errorMessage = 'Invalid username or password.';
}

include __DIR__ . '/../includes/header.php';
?>
<section class="section">
    <div class="container narrow">
        <div class="card">
            <h1>Admin Login</h1>
            <?php if ($errorMessage): ?><p class="error-message"><?= escape($errorMessage) ?></p><?php endif; ?>
            <form method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button class="btn btn-primary" type="submit">Login</button>
            </form>
            <p class="hint">Default demo login after importing database: <strong>admin</strong> / <strong>Password123!</strong></p>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
