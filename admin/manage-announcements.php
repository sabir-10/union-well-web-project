<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_admin_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create') {
        $stmt = $pdo->prepare('INSERT INTO announcements (title, body) VALUES (?, ?)');
        $stmt->execute([trim($_POST['title']), trim($_POST['body'])]);
    }

    if ($action === 'delete') {
        $stmt = $pdo->prepare('DELETE FROM announcements WHERE id = ?');
        $stmt->execute([(int) $_POST['id']]);
    }

    header('Location: /admin/manage-announcements.php');
    exit;
}

$announcements = $pdo->query('SELECT * FROM announcements ORDER BY created_at DESC')->fetchAll();
include __DIR__ . '/../includes/header.php';
?>
<section class="section">
    <div class="container two-column admin-layout">
        <div class="card">
            <h1>Manage Announcements</h1>
            <form method="post">
                <input type="hidden" name="action" value="create">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
                <label for="body">Body</label>
                <textarea id="body" name="body" rows="5" required></textarea>
                <button class="btn btn-primary" type="submit">Add Announcement</button>
            </form>
        </div>
        <div class="card">
            <h2>Existing Announcements</h2>
            <?php foreach ($announcements as $announcement): ?>
                <div class="admin-item">
                    <p><strong><?= escape($announcement['title']) ?></strong></p>
                    <form method="post">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= (int) $announcement['id'] ?>">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
