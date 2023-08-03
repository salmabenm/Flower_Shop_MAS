<?php

@include 'configuration.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);


   mysqli_query($conn, "UPDATE `gardener` SET name = '$name', phone = '$phone' WHERE id = '$update_p_id'") or die('query failed');

   

   $message[] = 'Gardener updated successfully!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update interior</title>
   <link rel="icon" href="images/logoo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="styleadmin.css">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="update-product">

<?php

   $update_id = $_GET['update'];
   $select_products = mysqli_query($conn, "SELECT * FROM `gardener` WHERE id = '$update_id'") or die('query failed');
   if(mysqli_num_rows($select_products) > 0){
      while($fetch_products = mysqli_fetch_assoc($select_products)){
?>
<br><br></br></br></br>
<form action="" method="post" enctype="multipart/form-data">
   
   <input type="hidden" value="<?php echo $fetch_products['id']; ?>" name="update_p_id">

   <input type="text" class="box" value="<?php echo $fetch_products['name']; ?>" required placeholder="update product name" name="name">
   <input type="number" min="0" class="box" value="<?php echo $fetch_products['phone']; ?>" required placeholder="update product phone" name="phone">

   <input type="submit" value="update product" name="update_product" class="btn">
   <a href="admin_interior.php" class="btn">Go back</a>
</form>

<?php
      }
   }else{
      echo '<p class="empty">no update gardener select</p>';
   }
?>

</section>