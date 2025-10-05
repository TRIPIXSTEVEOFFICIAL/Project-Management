<?php
$eventsFile = 'events.json';
if (!file_exists($eventsFile)) file_put_contents($eventsFile, json_encode([]));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $events = json_decode(file_get_contents($eventsFile), true);
    $newEvent = [
        'id' => time(),
        'name' => $_POST['event_name'],
        'date' => $_POST['event_date'],
        'time' => $_POST['event_time'],
        'location' => $_POST['event_location'],
        'description' => $_POST['event_description']
    ];
    $events[] = $newEvent;
    file_put_contents($eventsFile, json_encode($events, JSON_PRETTY_PRINT));
    $message = "Event created successfully!";
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
            <?php if (!empty($message)): ?>
                <div class="alert alert-success"><?= $message; ?></div>
                <a href="EventCreation.php" class="btn btn-secondary">Create Another</a>
            <?php else: ?>
                <form method="POST" class="row g-3">
                    <div class="col-md-6"><input type="text" name="event_name" class="form-control" placeholder="Event Name" required></div>
                    <div class="col-md-3"><input type="date" name="event_date" class="form-control" required></div>
                    <div class="col-md-3"><input type="time" name="event_time" class="form-control" required></div>
                    <div class="col-md-6"><input type="text" name="event_location" class="form-control" placeholder="Location" required></div>
                    <div class="col-md-12"><textarea name="event_description" rows="3" class="form-control" placeholder="Description"></textarea></div>
                    <div class="col-12 text-center"><button type="submit" class="btn btn-primary px-5">Create</button></div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
