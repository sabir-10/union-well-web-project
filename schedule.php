<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
$classes = $pdo->query('SELECT * FROM classes ORDER BY FIELD(class_day, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"), start_time ASC')->fetchAll();
include __DIR__ . '/includes/header.php';
?>
<section class="page-banner">
    <div class="container">
        <h1>Class Schedule</h1>
        <p>Browse campus wellness and recreation programming.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <label for="classFilter" class="filter-label">Filter by category</label>
        <select id="classFilter">
            <option value="all">All</option>
            <option value="Fitness">Fitness</option>
            <option value="Mindfulness">Mindfulness</option>
            <option value="Sports">Sports</option>
        </select>
        <div class="table-wrapper">
            <table class="schedule-table">
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Category</th>
                        <th>Instructor</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($classes as $class): ?>
                        <tr data-category="<?= escape($class['category']) ?>">
                            <td><?= escape($class['class_name']) ?></td>
                            <td><?= escape($class['category']) ?></td>
                            <td><?= escape($class['instructor']) ?></td>
                            <td><?= escape($class['class_day']) ?></td>
                            <td><?= date('g:i A', strtotime($class['start_time'])) ?> - <?= date('g:i A', strtotime($class['end_time'])) ?></td>
                            <td><?= escape($class['location']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
