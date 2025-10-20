<?php
$eventsFile = 'events.json';
$attendeesFile = 'attendees.json';

if (!file_exists($eventsFile)) file_put_contents($eventsFile, json_encode([]));
if (!file_exists($attendeesFile)) file_put_contents($attendeesFile, json_encode([]));

$events = json_decode(file_get_contents($eventsFile), true);
$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attendees = json_decode(file_get_contents($attendeesFile), true);
    $attendees[] = [
        'event_id' => $_POST['event_id'],
        'name' => $_POST['attendee_name'],
        'email' => $_POST['attendee_email']
    ];
    file_put_contents($attendeesFile, json_encode($attendees, JSON_PRETTY_PRINT));
    $msg = "Registered successfully!";
    $_POST = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white">
            <h3>Register for Event</h3>
        </div>
        <div class="card-body">
            <?php if (!empty($msg)): ?>
                <div class="alert alert-info"><?= $msg; ?></div>
            <?php endif; ?>
            <form method="POST" class="row g-3">
                <div class="col-md-6">
                    <select name="event_id" class="form-select" required>
                        <option value="">Select Event</option>
                        <?php
                        for ($i = 0; $i < count($events); $i++) {
                            $event = $events[$i];
                            $name = htmlspecialchars($event['name']);
                            $id = $event['id'];
                            echo "<option value='$id'>$name</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" name="attendee_name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-12">
                    <input type="email" name="attendee_email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success px-5">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
