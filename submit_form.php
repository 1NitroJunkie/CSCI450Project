<?php
$servername = "stem-reg";
$username = "josewh2";
$password = "TrustNo1v1";
$dbname = "camp_registration";

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO registrations (parentsname, address, contactphonenumber, email, participantname, participantage, participantgrade, campprogramname, statusofregistration, dateofregistration) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", $parentsname, $address, $contactphonenumber, $email, $participantname, $participantage, $participantgrade, $campprogramname, $statusofregistration, $dateofregistration);

// Set parameters and execute
$parentsname = $_POST['parentsname'];
$address = $_POST['address'];
$contactphonenumber = $_POST['contactphonenumber'];
$email = $_POST['email'];
$participantname = $_POST['participantname'];
$participantage = $_POST['participantage'];
$participantgrade = $_POST['participantgrade'];
$campprogramname = $_POST['campprogramname'];
$statusofregistration = $_POST['statusofregistration'];
$dateofregistration = $_POST['dateofregistration'];

$stmt->execute();

// Send email after successful registration
//$mail = new PHPMailer(true);
//try {
//    //Server settings
//    $mail->isSMTP();
//    $mail->Host = 'smtp.example.com';  // Specify main and backup SMTP servers
//    $mail->SMTPAuth = true;
//    $mail->Username = 'your-email@example.com';
//    $mail->Password = 'your-password';
//    $mail->SMTPSecure = 'tls';
//    $mail->Port = 587;

    //Recipients
//    $mail->setFrom('your-email@example.com', 'Camp Registration');
//    $mail->addAddress($email, $participantname); // Send to participant's email

    // Content
//    $mail->isHTML(true);
//    $mail->Subject = 'Registration Confirmation';
//    $mail->Body    = 'Hello ' . $participantname . ', your registration for the ' . $campprogramname . ' has been successfully processed.';

//    $mail->send();
//    echo 'New records created successfully. Confirmation email sent.';
//} catch (Exception $e) {
//    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//}

$stmt->close();
$conn->close();
?>