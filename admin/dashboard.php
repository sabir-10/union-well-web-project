<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_admin_login();

$eventCount = $pdo->query('SELECT COUNT(*) FROM events')->fetchColumn();
$classCount = $pdo->query('SELECT COUNT(*) FROM classes')->fetchColumn();
$messageCount = $pdo->query('SELECT COUNT(*) FROM contact_messages')->fetchColumn();

include __DIR__ . '/../includes/header.php';
?>
<section class="section">
    <div class="container">
        <h1>Admin Dashboard</h1>
        <p>Welcome, <?= escape($_SESSION['admin_username']) ?>.</p>
        <div class="card-grid">
            <article class="card"><h2>Events</h2><p><?= (int) $eventCount ?></p></article>
            <article class="card"><h2>Classes</h2><p><?= (int) $classCount ?></p></article>
            <article class="card"><h2>Messages</h2><p><?= (int) $messageCount ?></p></article>
        </div>
        <div class="admin-links">
            <a class="btn btn-secondary" href="/admin/manage-events.php">Manage Events</a>
            <a class="btn btn-secondary" href="/admin/manage-classes.php">Manage Classes</a>
            <a class="btn btn-secondary" href="/admin/manage-announcements.php">Manage Announcements</a>
            <a class="btn btn-secondary" href="/admin/view-messages.php">View Messages</a>
            <a class="btn btn-secondary" href="/admin/logout.php">Logout</a>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
