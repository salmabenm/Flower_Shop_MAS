<?php

@include 'configuration.php';

session_start();

if(isset($_POST['submit'])){

   $filter_username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
   $username = mysqli_real_escape_string($conn, $filter_username);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE name = '$username' AND password = '$pass'") or die('query failed');


   if(mysqli_num_rows($select_users) > 0){
      
      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:adminpage.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }else{
         $message[] = 'no user found!';
      }

   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link rel="icon" href="images/logoo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">
   <script>
function showPassword() {
  var x = document.getElementsByName("pass")[0];
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

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
   <h1 class="heading"><span>Login</span> now</h1></br></br>
   <input type="text" name="username" class="box" placeholder="enter your username" required>
   <input type="password" name="pass" class="box" placeholder="enter your password" required></br></br></br>
   <div class="show-password">
   <input type="checkbox" onclick="showPassword()">Show password
   
</div>

   <input type="submit" class="btn" name="submit" value="Login now">
  
   <p>Don't have an account? <a href="registre.php">Register now</a></p>
   <p> Did you <a href="forgot-password.php">forgot your password?</a><p>
</form>

</section>


</body>
</html>