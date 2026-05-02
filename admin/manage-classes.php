<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_admin_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create') {
        $stmt = $pdo->prepare('INSERT INTO classes (class_name, instructor, class_day, start_time, end_time, location, category) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            trim($_POST['class_name']),
            trim($_POST['instructor']),
            trim($_POST['class_day']),
            $_POST['start_time'],
            $_POST['end_time'],
            trim($_POST['location']),
            trim($_POST['category'])
        ]);
    }

    if ($action === 'delete') {
        $stmt = $pdo->prepare('DELETE FROM classes WHERE id = ?');
        $stmt->execute([(int) $_POST['id']]);
    }

    header('Location: /admin/manage-classes.php');
    exit;
}

$classes = $pdo->query('SELECT * FROM classes ORDER BY FIELD(class_day, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"), start_time ASC')->fetchAll();
include __DIR__ . '/../includes/header.php';
?>
<section class="section">
    <div class="container two-column admin-layout">
        <div class="card">
            <h1>Manage Classes</h1>
            <form method="post">
                <input type="hidden" name="action" value="create">
                <label for="class_name">Class Name</label>
                <input type="text" id="class_name" name="class_name" required>
                <label for="instructor">Instructor</label>
                <input type="text" id="instructor" name="instructor" required>
                <label for="class_day">Day</label>
                <select id="class_day" name="class_day" required>
                    <option>Monday</option><option>Tuesday</option><option>Wednesday</option><option>Thursday</option><option>Friday</option><option>Saturday</option><option>Sunday</option>
                </select>
                <label for="start_time">Start Time</label>
                <input type="time" id="start_time" name="start_time" required>
                <label for="end_time">End Time</label>
                <input type="time" id="end_time" name="end_time" required>
                <label for="location">Location</label>
                <input type="text" id="location" name="location" required>
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option>Fitness</option><option>Mindfulness</option><option>Sports</option>
                </select>
                <button class="btn btn-primary" type="submit">Add Class</button>
            </form>
        </div>
        <div class="card">
            <h2>Existing Classes</h2>
            <?php foreach ($classes as $class): ?>
                <div class="admin-item">
                    <p><strong><?= escape($class['class_name']) ?></strong></p>
                    <p><?= escape($class['class_day']) ?> | <?= escape($class['instructor']) ?> | <?= escape($class['category']) ?></p>
                    <form method="post">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= (int) $class['id'] ?>">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
