<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
$events = $pdo->query('SELECT * FROM events ORDER BY event_date ASC')->fetchAll();
include __DIR__ . '/includes/header.php';
?>
<section class="page-banner">
    <div class="container">
        <h1>Campus Events</h1>
        <p>Programs, workshops, and featured happenings.</p>
    </div>
</section>
<section class="section">
    <div class="container card-grid">
        <?php foreach ($events as $event): ?>
            <article class="card">
                <h2><?= escape($event['title']) ?></h2>
                <p><strong>Date:</strong> <?= escape(format_event_datetime($event['event_date'], $event['event_time'])) ?></p>
                <p><strong>Location:</strong> <?= escape($event['location']) ?></p>
                <p><?= escape(substr($event['description'], 0, 140)) ?>...</p>
                <a href="/event-details.php?id=<?= (int) $event['id'] ?>">Read more</a>
            </article>
        <?php endforeach; ?>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
