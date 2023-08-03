<?php

@include 'configuration.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
 
  

   $select_product_name = mysqli_query($conn, "SELECT name FROM `gardener` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'flower name already exist!';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `gardener`(name, phone) VALUES('$name',  '$phone')") or die('query failed');

      
      
   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT * FROM `gardener` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
 
   mysqli_query($conn, "DELETE FROM `gardener` WHERE id = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');
   header('location:admin_gardener.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Gardener</title>
   <link rel="icon" href="images/logoo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="styleadmin.css">
   
</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="add-products">
   
      <form action="" method="POST" enctype="multipart/form-data">
         <h3>Add NEW GARDENER</h3>
         <input type="text" class="box" required placeholder="enter product name" name="name">
         <input type="number" min="0" class="box" required placeholder="enter product phone" name="phone">

         <input type="submit" value="add product" name="add_product" class="btn">
      </form>
   
</section>

<section class="promo" id="promo">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `gardener`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         

         <div class="content">
            <h3><?php echo $fetch_products['name']; ?></h3><br>
            <div class="pricy">+212 <?php echo $fetch_products['phone']; ?></div>
         
               <div class="icons">
                <br>
                  <a href="admin_update_gardener.php?update=<?php echo $fetch_products['id']; ?>" class="btn">Update</a>
                  <a href="admin_gardener.php?delete=<?php echo $fetch_products['id']; ?>" class="btn" onclick="return confirm('delete this plant?');">Delete</a>
               </div>
         </div>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no gardener added yet!</p>';
      }
      ?>
   </div>
   

</section>

