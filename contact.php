<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    $to = "ambikamantole@gmail.com"; // Your email
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $fullMessage = "Name: $name\n";
    $fullMessage .= "Email: $email\n";
    $fullMessage .= "Subject: $subject\n";
    $fullMessage .= "Message:\n$message\n";

    if (mail($to, $subject, $fullMessage, $headers)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "Invalid request";
}
?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Your Gmail
        $mail->Password = 'your-app-password'; // Use App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($email, $name);
        $mail->addAddress('ambikamantole@gmail.com'); // Recipient

        $mail->Subject = $subject;
        $mail->Body = "Name: $name\nEmail: $email\nMessage:\n$message";
        
        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request";
}
?>
