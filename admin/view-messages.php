<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_admin_login();
$messages = $pdo->query('SELECT * FROM contact_messages ORDER BY submitted_at DESC')->fetchAll();
include __DIR__ . '/../includes/header.php';
?>
<section class="section">
    <div class="container">
        <h1>Contact Messages</h1>
        <div class="card-grid">
            <?php foreach ($messages as $message): ?>
                <article class="card">
                    <h2><?= escape($message['subject']) ?></h2>
                    <p><strong>From:</strong> <?= escape($message['name']) ?> (<?= escape($message['email']) ?>)</p>
                    <p><?= nl2br(escape($message['message'])) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
