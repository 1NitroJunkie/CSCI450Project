<?php

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
$stmt = $con->prepare("INSERT INTO registration (parentsname, address, contactPhoneNumber, email, participantname, participantage, participantgrade, campprogramname, statusofregistration) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
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

// Execute the prepared statement
if ($stmt->execute()) {
    echo "New records created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$con->close();