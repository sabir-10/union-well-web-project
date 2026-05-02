<?php
require_once __DIR__ . '/../includes/db.php';
header('Content-Type: application/rss+xml; charset=UTF-8');
$events = $pdo->query('SELECT * FROM events ORDER BY event_date ASC LIMIT 10')->fetchAll();
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
?>
<rss version="2.0">
    <channel>
        <title>Union WELL Events Feed</title>
        <link>http://localhost/union-well-web-project/events.php</link>
        <description>Upcoming campus events RSS feed.</description>
        <?php foreach ($events as $event): ?>
            <item>
                <title><?= htmlspecialchars($event['title'], ENT_XML1 | ENT_QUOTES, 'UTF-8') ?></title>
                <description><?= htmlspecialchars($event['description'], ENT_XML1 | ENT_QUOTES, 'UTF-8') ?></description>
                <pubDate><?= date(DATE_RSS, strtotime($event['event_date'])) ?></pubDate>
                <guid><?= (int) $event['id'] ?></guid>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>
