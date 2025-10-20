<?php
$eventsFile = 'events.json';
if (!file_exists($eventsFile)) file_put_contents($eventsFile, json_encode([]));

$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $events = json_decode(file_get_contents($eventsFile), true);
    $events[] = [
        'id' => uniqid(),
        'name' => $_POST['event_name'],
        'date' => $_POST['event_date'],
        'description' => $_POST['event_description']
    ];
    file_put_contents($eventsFile, json_encode($events, JSON_PRETTY_PRINT));
    $msg = "Event added successfully!";
    $_POST = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h3>Create Event</h3>
        </div>
        <div class="card-body">
            <?php if (!empty($msg)): ?>
                <div class="alert alert-success">
                    <?= $msg; ?> 
                    <a href="EventRegistration.php" class="alert-link">Go to Sign Up</a>
                </div>
            <?php endif; ?>
            <form method="POST" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="event_name" class="form-control" placeholder="Event Name" required>
                </div>
                <div class="col-md-6">
                    <input type="date" name="event_date" class="form-control" required>
                </div>
                <div class="col-12">
                    <textarea name="event_description" class="form-control" placeholder="Event Description" rows="3" required></textarea>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary px-5">Add Event</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
