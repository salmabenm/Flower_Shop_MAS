<?php
@include 'configuration.php';

session_start();
if (isset($_POST['email'])) {
	// Get user input
	$email = $_POST['email'];

	// Validate user input
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// Email address is not valid
		echo "Invalid email address";
		exit();
	}

	// Check if email address exists in database
	$servername = "localhost";
	$username = "username";
	$password = "password";
	$dbname = "database_name";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM users WHERE email = '$email'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0) {
		// User with this email address does not exist
		echo "User with this email address does not exist";
		exit();
	}

	// Generate unique token
	$token = bin2hex(random_bytes(32));

	// Store token in database
	$sql = "UPDATE users SET reset_token = '$token' WHERE email = '$email'";
	mysqli_query($conn, $sql);

	// Send email with password reset link
	$to = $email;
	$subject = "Password Reset";
	$message = "Click the following link to reset your password: http://example.com/reset-password.php?token=$token";
	$headers = "From: webmaster@example.com\r\n";
	$headers .= "Reply-To: webmaster@example.com\r\n";
	$headers .= "Content-type: text/html\r\n";
	mail($to, $subject, $message, $headers);

	// Display success message
	echo "Password reset link has been sent to your email address";

	mysqli_close($conn);
	exit();
}
?>



