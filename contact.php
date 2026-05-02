<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$successMessage = '';
$errorMessage = '';

if (is_post_request()) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $subject === '' || $message === '') {
        $errorMessage = 'Please complete all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Please enter a valid email address.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)');
        $stmt->execute([$name, $email, $subject, $message]);
        $successMessage = 'Thank you. Your message has been submitted.';
    }
}

include __DIR__ . '/includes/header.php';
?>
<section class="page-banner">
    <div class="container">
        <h1>Contact Us</h1>
        <p>Send a question, request, or general inquiry.</p>
    </div>
</section>
<section class="section">
    <div class="container two-column">
        <div>
            <h2>Office Information</h2>
            <p>Email: info@unionwell-demo.local</p>
            <p>Phone: (916) 555-0100</p>
            <p>Hours: Monday - Friday, 8 AM - 5 PM</p>
        </div>
        <div class="card">
            <?php if ($successMessage): ?><p class="success-message"><?= escape($successMessage) ?></p><?php endif; ?>
            <?php if ($errorMessage): ?><p class="error-message"><?= escape($errorMessage) ?></p><?php endif; ?>
            <form method="post" novalidate>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required>

                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button class="btn btn-primary" type="submit">Send Message</button>
            </form>
        </div>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
