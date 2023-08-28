<?php
// Check if the token is provided and matches the expected value
if (empty($_POST['token']) || $_POST['token'] != 'FsWga4&@f6aw') {
    echo '<span class="notice">Error!</span>';
    exit;
}

// Sanitize and retrieve form data
$name = $_POST['name'];
$from = $_POST['email'];
$phone = $_POST['phone'];
$subject = stripslashes($_POST['subject']);
$message = stripslashes($_POST['message']);

// Set email headers
$headers = "From: $from\r\n";  // Corrected format for headers
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";  // Corrected charset value

// Construct the email body using output buffering
ob_start();
?>
Hi AlsecTech!<br /><br />
<?php echo ucfirst($name); ?> has sent you a message via the contact form on your website!
<br /><br />

Name: <?php echo ucfirst($name); ?><br />
Email: <?php echo $from; ?><br />
Phone: <?php echo $phone; ?><br />
Subject: <?php echo $subject; ?><br />
Message: <br /><br />
<?php echo $message; ?>
<br />
<br />
============================================================
<?php
$body = ob_get_contents();
ob_end_clean();

$to = 'alsectechofficial@gmail.com';

// Using the mail function to send the email
$s = mail($to, $subject, $body, $headers);

if ($s) {
    echo '<div class="success"><i class="fas fa-check-circle"></i><h3>Thank You!</h3>Your message has been sent successfully.</div>';
} else {
    echo '<div>Your message sending failed!</div>';
}
?>
