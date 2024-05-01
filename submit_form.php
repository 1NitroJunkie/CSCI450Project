<?php

//require 'vendor/autoload.php';  // This path assumes that this script is in the root folder of your project

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

//function sendEmailNotification($recipientEmail, $subject, $body) {
//    $phpmailer = new PHPMailer();
//    $phpmailer->isSMTP();
//    $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
//    $phpmailer->SMTPAuth = true;
//    $phpmailer->Username = 'ca3320f4608c9c';
//    $phpmailer->Password = 'becb0b7b6c8e1a';
//    $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Optional: if you want encryption
//    $phpmailer->Port = 2525;
//    
//    $phpmailer->setFrom('josewh2@regent.edu', 'STEM Summer Camp'); // Sender's email address and name
//    $phpmailer->addAddress($recipientEmail); // Add a recipient
//    
//    $phpmailer->isHTML(true); // Set email format to HTML
//    $phpmailer->Subject = $subject;
//    $phpmailer->Body    = $body;
//    $phpmailer->AltBody = strip_tags($body);
//    
//    if(!$phpmailer->send()) {
//        echo 'Message could not be sent.';
//        echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
//    } else {
//        echo 'Message has been sent';
//    }
//  }


$host = "den1.mysql2.gear.host";
$port = 3306;
$socket = "";
$user = "campreg";
$password = "Wi4v-0s3FC~f"; // Make sure to put your actual password here
$dbname = "campreg";

// Create connection
$con = new mysqli($host, $user, $password, $dbname, $port, $socket);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Prepare and bind
$stmt = $con->prepare("INSERT INTO registrations (parentsname, address, contactPhoneNumber, email, participantname, participantage, participantgrade, campprogramname, statusofregistration) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssiiss", $parentsname, $address, $contactPhoneNumber, $email, $participantname, $participantage, $participantgrade, $campprogramname, $statusofregistration);

// Set parameters from POST data
$parentsname = $_POST['parentsname'];
$address = $_POST['address'];
$contactPhoneNumber = preg_replace('/\D/', '', $_POST['contactPhoneNumber']); // Strip non-numeric characters
$email = $_POST['email'];
$participantname = $_POST['participantname'];
$participantage = $_POST['participantage'];
$participantgrade = $_POST['participantgrade'];
$campprogramname = $_POST['campprogramname'];
$statusofregistration = $_POST['statusofregistration'];
$dateofregistration = date("Y-m-d H:i:s");  // Current date and time

// Execute the prepared statement
if ($stmt->execute()) {
  echo "New records created successfully";

  //if ($statusofregistration == 'paid') {
  //    sendEmailNotification($email, 'Payment Confirmation', 'Your payment has been confirmed, and your camp spot is secured!');
  //} elseif ($statusofregistration == 'registered') {
  //    sendEmailNotification($email, 'Registration Confirmation', 'Thank you for registering for the STEM Summer Camp! We will update you on your payment status.');
  //} elseif ($statusofregistration == 'waiting list') {
  //    sendEmailNotification($email, 'Waitlist Notification', 'You have been placed on the waiting list. We will contact you if a spot becomes available.');
  //}
} else {
  echo "Error: " . $stmt->error;
};
// Close statement and connection
$stmt->close();
$con->close();