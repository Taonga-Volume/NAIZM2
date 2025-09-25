<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = htmlspecialchars($_POST['name']);
    $email    = htmlspecialchars($_POST['email']);
    $interest = htmlspecialchars($_POST['interest']);

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
        $_SESSION['status'] = 'success';
    } catch (Exception $e) {
        $_SESSION['status'] = 'error';
    }

    // Redirect back to the join section
    header("Location: join-us.php#signup");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Us | NAIZM</title>
    <link rel="stylesheet" href="CSS/join.css">
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
        <a href="donate.html"><button class="donate-btn">Donate</button></a>
        <div class="hamburger" onclick="toggleMenu()">☰</div>
    </header>

    <section class="join-hero">
        <h1>Be a Part of Something Bigger</h1>
        <p>Join NAIZM and empower your journey with knowledge, innovation, and a powerful community.</p>
        <a href="#signup" class="cta-button">Join Now</a>
    </section>

    <section class="why-join">
        <h2>Why Join NAIZM?</h2>
        <ul>
            <li>🌐 Access to workshops, events, and competitions</li>
            <li>🤝 Network with passionate and inspiring individuals</li>
            <li>🚀 Develop leadership, tech, and creative skills</li>
            <li>🎓 Get recognition and digital certificates</li>
        </ul>
    </section>

    <section class="who-can-join">
        <h2>Who Can Join?</h2>
        <p>We welcome students, creatives, tech enthusiasts, and anyone passionate about making a difference. Whether you're just starting out or already experienced—there’s a place for you at NAIZM.</p>
    </section>

    <section class="get-involved">
        <h2>Ways to Get Involved</h2>
        <div class="involve-cards">
            <div class="card">
                <h3>Become a Member</h3>
                <p>Sign up to be part of our community and get updates on all our programs.</p>
            </div>
            <div class="card">
                <h3>Volunteer With Us</h3>
                <p>Contribute your skills to help run events, manage media, or support outreach.</p>
            </div>
            <div class="card">
                <h3>Join Our Team</h3>
                <p>Looking to take on leadership or creative roles? We're looking for passionate people.</p>
            </div>
        </div>
    </section>

    <section class="join-form" id="signup">
        <h2>Sign Up Now</h2>
        <p>Fill out the form below and we’ll get back to you soon!</p>

        <!-- Display Success/Error Messages -->
        <?php
        if (isset($_SESSION['status'])) {
            if ($_SESSION['status'] === 'success') {
                echo '<p class="success-msg">Your submission was successful! We will contact you soon.</p>';
            } else {
                echo '<p class="error-msg">Oops! Something went wrong. Please try again.</p>';
            }
            unset($_SESSION['status']);
        }
        ?>

        <form action="" method="POST">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="interest">Area of Interest:</label>
            <select id="interest" name="interest">
                <option value="membership">Membership</option>
                <option value="volunteer">Volunteering</option>
                <option value="team">Joining the Team</option>
            </select>

            <button type="submit">Submit</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2025 NAIZM. All rights reserved.</p>
    </footer>

</body>

</html>