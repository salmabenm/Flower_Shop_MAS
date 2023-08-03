<?php

@include 'configuration.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  
   mysqli_query($conn, "UPDATE `users` SET name = '$name', phone = '$phone' WHERE id = '$update_p_id'") or die('query failed');
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'images/'.$image;
   $old_image = $_POST['update_p_image'];
   
   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image file size is too large!';
      }else{
         mysqli_query($conn, "UPDATE `users` SET image = '$image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($image_tmp_name, $image_folter);
         unlink('images/'.$old_image);
         $message[] = 'image updated successfully!';
      }
   }


   $message[] = 'Information updated successfully!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update informations</title>
   <link rel="icon" href="images/logoo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom user css file link  -->
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="boxes_style.css">
   <link rel="stylesheet" href="styleadmin.css">
</head>
<body>
<?php @include 'header.php'; ?>
<section class="update-product">

<section class="userac" id="userac">

  <div class="user-profile">
  <h1 class="heading">Personal <span> Informations </span></h1>
  <hr>

         <?php

            $select_products = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
               while($fetch_products = mysqli_fetch_assoc($select_products)){
         ?>
  
         <form action="" method="post" enctype="multipart/form-data">
            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" class="image"  alt="">
            <input type="hidden" value="<?php echo $fetch_products['id']; ?>" name="update_p_id">
            <input type="hidden" class="box" value="<?php echo $fetch_products['image']; ?>" name="update_p_image">
            <input type="text"  class="box" value="<?php echo $fetch_products['name']; ?>" required placeholder="update your username" name="name">
            <input type="number" class="box" value="<?php echo $fetch_products['phone']; ?>"  required placeholder="update your number" name="phone">
            <input type="file"  accept="image/jpg, image/jpeg, image/png" class="box" name="image">
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
