<?php
function escape(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $url): void {
    header("Location: $url");
    exit;
}

function is_post_request(): bool {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function format_event_datetime(?string $date, ?string $time): string {
    if (!$date) {
        return 'Date TBA';
    }

    $formattedDate = date('F j, Y', strtotime($date));
    if ($time && $time !== '00:00:00') {
        return $formattedDate . ' at ' . date('g:i A', strtotime($time));
    }

    return $formattedDate;
}
?>
