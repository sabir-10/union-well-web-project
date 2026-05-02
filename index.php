<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$announcements = $pdo->query('SELECT * FROM announcements ORDER BY created_at DESC LIMIT 3')->fetchAll();
$events = $pdo->query('SELECT * FROM events ORDER BY event_date ASC LIMIT 3')->fetchAll();
$classes = $pdo->query('SELECT * FROM classes ORDER BY FIELD(class_day, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"), start_time ASC LIMIT 4')->fetchAll();

include __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="container hero-grid">
        <div>
            <p class="eyebrow">Student Union and Recreation Website</p>
            <h1>Build community, wellness, and campus connection.</h1>
            <p class="lead">This portfolio project demonstrates PHP, MySQL, JavaScript, responsive design, accessibility, and CMS-style content management for a campus web environment.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="/membership.php">Explore Membership</a>
                <a class="btn btn-secondary" href="/events.php">Upcoming Events</a>
            </div>
        </div>
        <div class="hero-card">
            <h2>Highlights</h2>
            <ul>
                <li>Dynamic event listings</li>
                <li>Class schedule filtering</li>
                <li>Admin dashboard for updates</li>
                <li>Accessible and responsive layout</li>
            </ul>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Announcements</h2>
        <div class="card-grid">
            <?php foreach ($announcements as $announcement): ?>
                <article class="card">
                    <h3><?= escape($announcement['title']) ?></h3>
                    <p><?= nl2br(escape(substr($announcement['body'], 0, 180))) ?>...</p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section alt-bg">
    <div class="container">
        <h2>Upcoming Events</h2>
        <div class="card-grid">
            <?php foreach ($events as $event): ?>
                <article class="card">
                    <h3><?= escape($event['title']) ?></h3>
                    <p><strong>When:</strong> <?= escape(format_event_datetime($event['event_date'], $event['event_time'])) ?></p>
                    <p><strong>Where:</strong> <?= escape($event['location']) ?></p>
                    <a href="/event-details.php?id=<?= (int) $event['id'] ?>">View details</a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Weekly Class Preview</h2>
        <div class="card-grid">
            <?php foreach ($classes as $class): ?>
                <article class="card">
                    <h3><?= escape($class['class_name']) ?></h3>
                    <p><strong>Day:</strong> <?= escape($class['class_day']) ?></p>
                    <p><strong>Time:</strong> <?= date('g:i A', strtotime($class['start_time'])) ?> - <?= date('g:i A', strtotime($class['end_time'])) ?></p>
                    <p><strong>Instructor:</strong> <?= escape($class['instructor']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
