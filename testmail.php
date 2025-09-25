<?php
$to = "taongabandachibuye@gmail.com"; // replace with your email to test
$subject = "Test Email from XAMPP";
$message = "This is a test email sent using PHP on XAMPP.";
$headers = "From: taongabandachibuye@gmail.com"; // must match your sendmail.ini auth_username

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.";
}
