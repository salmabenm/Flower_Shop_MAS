<?php

@include 'configuration.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   
   // check if old password matches
   $old_password = mysqli_real_escape_string($conn, md5($_POST['old_password']));
   $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$update_p_id' AND password = '$old_password'") or die('query failed');
   if(mysqli_num_rows($select_user) == 0){
      $message[] = 'Old password does not match!';
   }else{
      // check if new password and confirm password match
      $new_password = mysqli_real_escape_string($conn, md5($_POST['new_password']));
      $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));
      if($new_password != $confirm_password){
         $message[] = 'New password and confirm password do not match!';
      }else{
         mysqli_query($conn, "UPDATE `users` SET password = '$new_password' WHERE id = '$update_p_id'") or die('query failed');
         $message[] = 'Password updated successfully!';
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update password</title>
   <link rel="icon" href="images/logoo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom user css file link  -->
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="boxes_style.css">
   <link rel="stylesheet" href="styleadmin.css">
</head>
<body>
<?php @include 'admin_header.php'; ?>
<section class="update-product">

<section class="userac" id="userac">

  <div class="user-profile">
  <h1 class="heading">Password <span>update</span></h1>
  <hr>
  <div class="profile-details">
   
  </div>
         <?php

            $select_products = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$admin_id'") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
               while($fetch_products = mysqli_fetch_assoc($select_products)){
         ?>
  
         <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $fetch_products['id']; ?>" name="update_p_id">
            
            <input type="password" class="box" required placeholder="your old password" name="old_password">
            <input type="password" class="box" required placeholder="your new password" name="new_password">
            <input type="password" class="box" required placeholder="confirm your new password" name="confirm_password">
            <input type="submit" value="Update information" name="update_product" class="btn">
            <a href="user.php" class="btn">Go back</a>

         
         </form>

         <?php
               }
            }else{
               echo '<p class="empty">No update information</p>';
            }
         ?>
</div>
</section>

</section>



<script src="js/admin_script.js"></script>

</body>
</html>