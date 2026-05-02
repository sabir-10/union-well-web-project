<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_admin_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create') {
        $stmt = $pdo->prepare('INSERT INTO events (title, description, location, event_date, event_time) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            trim($_POST['title']),
            trim($_POST['description']),
            trim($_POST['location']),
            $_POST['event_date'],
            $_POST['event_time']
        ]);
    }

    if ($action === 'delete') {
        $stmt = $pdo->prepare('DELETE FROM events WHERE id = ?');
        $stmt->execute([(int) $_POST['id']]);
    }

    header('Location: /admin/manage-events.php');
    exit;
}

$events = $pdo->query('SELECT * FROM events ORDER BY event_date ASC')->fetchAll();
include __DIR__ . '/../includes/header.php';
?>
<section class="section">
    <div class="container two-column admin-layout">
        <div class="card">
            <h1>Manage Events</h1>
            <form method="post">
                <input type="hidden" name="action" value="create">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5" required></textarea>
                <label for="location">Location</label>
                <input type="text" id="location" name="location" required>
                <label for="event_date">Event Date</label>
                <input type="date" id="event_date" name="event_date" required>
                <label for="event_time">Event Time</label>
                <input type="time" id="event_time" name="event_time" required>
                <button class="btn btn-primary" type="submit">Add Event</button>
            </form>
        </div>
        <div class="card">
            <h2>Existing Events</h2>
            <?php foreach ($events as $event): ?>
                <div class="admin-item">
                    <p><strong><?= escape($event['title']) ?></strong></p>
                    <p><?= escape($event['event_date']) ?> | <?= escape($event['location']) ?></p>
                    <form method="post">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= (int) $event['id'] ?>">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
