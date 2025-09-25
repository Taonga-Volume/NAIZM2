<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name    = htmlspecialchars($_POST['name']);
  $email   = htmlspecialchars($_POST['email']);
  $subject = htmlspecialchars($_POST['subject']);
  $message = htmlspecialchars($_POST['message']);

  $mail = new PHPMailer(true);

  try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'taongabandachibuye@gmail.com';
    $mail->Password   = 'tggo jhms edcn cetb'; // App-specific password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('taongabandachibuye@gmail.com'); // Who receives the contact messages

    // Email content
    $mail->isHTML(true);
    $mail->Subject = "New Contact Form Submission: $subject";
    $mail->Body    = "
            <h2>Contact Form Submission</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong> $message</p>
        ";

    $mail->send();
    $_SESSION['status'] = 'success';
  } catch (Exception $e) {
    $_SESSION['status'] = 'error';
  }

  // Redirect back to the contact section
  header("Location: contact.php#contact-form");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - NAI-ZM</title>
  <link rel="stylesheet" href="css/contact.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" href="IMAGES/favicon.ico" type="image/x-icon">
  <script src="script.js"></script>
  <style>
    .success-msg,
    .error-msg {
      text-align: center;
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-weight: bold;
    }

    .success-msg {
      background-color: #d4edda;
      color: #155724;
    }

    .error-msg {
      background-color: #f8d7da;
      color: #721c24;
    }
  </style>
</head>

<body>

  <header>
    <div class="logo"><a href="Home.html"><img src="IMAGES/1.png" alt="NAI-ZM Logo"></a></div>
    <nav id="nav-menu">
      <ul id="nav-menu" class="hamburger-menu">
        <li><a href="Home.html" class="menu-btn">Home</a></li>
        <li><a href="about-us.html" class="menu-btn">About</a></li>
        <li><a href="events.html" class="menu-btn">Events</a></li>
        <li><a href="#blogs" class="menu-btn">Blogs</a></li>
        <li><a href="join-us.php" class="menu-btn">Join Us</a></li>
        <li><a href="contact.php" class="menu-btn">Contact</a></li>
      </ul>
    </nav>
    <button class="donate-btn">Donate</button>
    <div class="hamburger" onclick="toggleMenu()">☰</div>
  </header>

  <main>
    <h1>Contact Us</h1>

    <!-- Display Success/Error Messages -->
    <?php
    if (isset($_SESSION['status'])) {
      if ($_SESSION['status'] === 'success') {
        echo '<p class="success-msg">Your message was sent successfully! We will contact you soon.</p>';
      } else {
        echo '<p class="error-msg">Oops! Something went wrong. Please try again.</p>';
      }
      unset($_SESSION['status']);
    }
    ?>

    <form action="" method="POST" id="contact-form">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="text" name="subject" placeholder="Subject" required>
      <textarea name="message" rows="6" placeholder="Your Message" required></textarea>
      <button type="submit">Send Message</button>
    </form>
  </main>

  <footer>
    <p>&copy; 2025 NAIZM. All rights reserved.</p>
  </footer>

</body>

</html>