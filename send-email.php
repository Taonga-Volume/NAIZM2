<?php
session_start(); // Start session to store messages
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = htmlspecialchars($_POST['name']);
    $email    = htmlspecialchars($_POST['email']);
    $interest = htmlspecialchars($_POST['interest']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'taongabandachibuye@gmail.com'; // Your email
        $mail->Password   = 'tggo jhms edcn cetb';          // App-specific password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('taongabandachibuye@gmail.com', 'NAI-ZM');
        $mail->addAddress('taongabandachibuye@gmail.com');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "New Join Us Form Submission";
        $mail->Body    = "
            <h2>New Join Us Submission</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Interest:</strong> $interest</p>
        ";

        $mail->send();

        // Set success message and redirect back
        $_SESSION['status'] = 'success';
        header("Location: join-us.php");
        exit();
    } catch (Exception $e) {
        // Set error message and redirect back
        $_SESSION['status'] = 'error';
        header("Location: join-us.php");
        exit();
    }
} else {
    header("Location: join-us.php");
    exit();
}
