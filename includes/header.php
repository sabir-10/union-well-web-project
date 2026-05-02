<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Campus recreation and student union website portfolio project.">
    <title>Union WELL Campus Experience</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script defer src="/assets/js/main.js"></script>
</head>
<body>
<header class="site-header">
    <div class="container nav-wrapper">
        <a class="logo" href="/index.php">Union WELL</a>
        <button class="menu-toggle" aria-label="Toggle navigation" aria-expanded="false">Menu</button>
        <nav class="site-nav" aria-label="Main navigation">
            <ul>
                <li><a href="/index.php">Home</a></li>
                <li><a href="/about.php">About</a></li>
                <li><a href="/membership.php">Membership</a></li>
                <li><a href="/schedule.php">Schedule</a></li>
                <li><a href="/events.php">Events</a></li>
                <li><a href="/contact.php">Contact</a></li>
                <li><a href="/admin/login.php">Admin</a></li>
            </ul>
        </nav>
    </div>
</header>
<main>
