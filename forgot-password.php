<?php

// include the configuration file and any necessary database connections
// ...

// check if the user has submitted the form
if(isset($_POST['submit'])){
   
   // sanitize and escape the submitted email address
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);

   // check if the email address exists in the database
   $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');
   
   if(mysqli_num_rows($select_user) > 0){

      // generate a random temporary password
      $temp_pass = bin2hex(random_bytes(5));
      
      // update the user's password in the database with the temporary password
      $update_pass = mysqli_query($conn, "UPDATE `users` SET password = md5('$temp_pass') WHERE email = '$email'") or die('query failed');
      
      // send an email to the user with the temporary password
      $to = $email;
      $subject = 'Temporary Password';
      $message = 'Your temporary password is: '.$temp_pass;
      $headers = 'From: masforu2@gmail.com' . "\r\n" .
          'Reply-To: example@example.com' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
      
      $mail_sent = mail($to, $subject, $message, $headers);
      
      if($mail_sent){
         $message[] = 'A temporary password has been sent to your email address.';
      }else{
         $message[] = 'There was an error sending the temporary password.';
      }

   }else{
      $message[] = 'The email address you entered is not registered.';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Forgot Password</title>
   <link rel="icon" href="images/logoo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
    
<section class="form-container">

   <form action="" method="post">
      <h1 class="heading"><span>Forgot</span> password</h1></br></br>
      <p>Enter your email address and we will send you a temporary password.</p></br>
      <input type="email" name="email" class="box" placeholder="enter your email" required>
      </br></br></br>
      
      <input type="submit" class="btn" name="submit" value="Send temporary password">
     
      <p>Remembered your password? <a href="login.php">Login now</a></p>
      <p>Don't have an account? <a href="register.php">Register now</a></p>
</form>
</section>
</body>
</html>

