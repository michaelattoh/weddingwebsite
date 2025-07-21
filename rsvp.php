<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $attendance = htmlspecialchars($_POST['attendance']);
    $dietary = htmlspecialchars($_POST['dietary']);

    // Recipient email addresses
    $to = 'wedding@nathanielandadelaide.com, rsvp@nathanielandadelaide.com';
    $subject = 'RSVP Confirmation';

    // HTML email message
    $emailMessage = "
    <html>
    <head>
        <title>RSVP Confirmation</title>
    </head>
    <body>
        <h2>RSVP Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Attendance:</strong> $attendance</p>
        <p><strong>Dietary Restrictions:</strong> $dietary</p>
    </body>
    </html>
    ";

    // Email headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: no-reply@nathanielandadelaide.com\r\n"; // Use a domain-approved sender 

    // Send the email and show confirmation
    if (mail($to, $subject, $emailMessage, $headers)) {
        echo "<script>
            alert('Thank you $name for taking the time to RSVP. We appreciate your response and will share more details with you soon.');
            window.location.href = 'https://nathanielandadelaide.com';
        </script>";
    } else {
        echo "<script>
            alert('Failed to send RSVP email. Please try again later.');
            window.location.href = 'https://nathanielandadelaide.com';
        </script>";
    }
}
?>
