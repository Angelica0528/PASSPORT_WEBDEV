<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="confirmation.css">
    <title>Appointment Confirmation</title>
</head>
<body>
    <div class="transition-overlay"></div>
    <div class="confirmation-container">
        <h1>Appointment Submitted Successfully</h1>
        <?php
        // Retrieve appointment ID from URL query parameter
        if (isset($_GET['id'])) {
            $appointmentId = htmlspecialchars($_GET['id']);
            echo "<p>Your appointment ID is: <strong>$appointmentId</strong></p>";
        } else {
            echo "<p>Appointment ID not found.</p>";
        }
        ?>
        <p>Thank you for scheduling your appointment. Your details have been successfully submitted.</p>
        <a href="/landing_page/landing_page.html">Go Back to Home</a>
    </div>
    <script src="admin.js"></script>
</body>
</html>
