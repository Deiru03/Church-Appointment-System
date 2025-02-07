<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

    // Load PHPMailer library
    require '/home/frmmssit/public_html/PHPMailer/src/Exception.php';
   require '/home/frmmssit/public_html/PHPMailer/src/PHPMailer.php';
    require '/home/frmmssit/public_html/PHPMailer/src/SMTP.php';


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'frmmssite@gmail.com'; // Your Gmail email address
        $mail->Password   = 'lcuwkyiaekjyhpzn'; // Your Gmail password
        $mail->SMTPSecure = tls;
        $mail->Port       = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('frmmssite@gmail.com'); // Add a recipient email address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Message from Contact Form';
        $mail->Body    = $message;

        // Send email
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
</head>
<body>

<h2>Contact Us</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>
    <label for="message">Message:</label><br>
    <textarea id="message" name="message" required></textarea><br><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>
