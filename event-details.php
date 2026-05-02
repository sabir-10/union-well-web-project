<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$stmt = $pdo->prepare('SELECT * FROM events WHERE id = ?');
$stmt->execute([$id]);
$event = $stmt->fetch();
include __DIR__ . '/includes/header.php';
?>
<section class="section">
    <div class="container">
        <?php if ($event): ?>
            <article class="card detail-card">
                <h1><?= escape($event['title']) ?></h1>
                <p><strong>Date:</strong> <?= escape(format_event_datetime($event['event_date'], $event['event_time'])) ?></p>
                <p><strong>Location:</strong> <?= escape($event['location']) ?></p>
                <p><?= nl2br(escape($event['description'])) ?></p>
            </article>
        <?php else: ?>
            <p>Event not found.</p>
        <?php endif; ?>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
