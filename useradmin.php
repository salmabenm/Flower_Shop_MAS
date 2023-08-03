
<?php

@include 'configuration.php';
session_start();

$user_id = $_SESSION['admin_id'];
if(!isset($user_id)){
    header('location:login.php');
 }

?>
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>User account</title>
<link rel="icon" href="images/logoo.png">
<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<!-- custom css file link -->
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="boxes_style.css">
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
<?php @include 'admin_header.php'; ?>
        

<section class="useracc" id="useracc">
  <div class="user-profile">
    <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
        while($fetch_orders = mysqli_fetch_assoc($select_orders)){
    ?>
    <h1 class="heading">Your <span>Account</span></h1>
    <hr>
    <div class="profile-details">
      <img src="images/<?php echo $fetch_orders['image']; ?>" alt="">
      <h2><?php echo $fetch_orders['name']; ?></h2></br>
      <p class="email"><i class="fa fa-envelope"></i>   <?php echo $fetch_orders['email']; ?></p>
      <p class="phone"><i class="fa fa-phone"></i>  +212 <?php echo $fetch_orders['phone']; ?></p>
      <hr>
   
  </div>
  <?php
      }
    } else {
      echo '<p class="empty">No changes yet!</p>';
    }
  ?>
  <div class="cart">
  <h1 class="cart__title"><i class="fa fa-cog"></i>
 Setting</h1>
  <div class="cart__items">
    <!-- Product cards go here -->
  </div>
  <div class="cart__actions">
 
    <a class="cart__button cart__button--delete-all" href="adminchangepass.php" >
      <span>Update Password</span>
  </a>
    <a class="cart__button cart__button--continue-shopping" href="adminchange.php">
      <span>Update   Info</span>
    </a>
   
    
    
  </div>

</div>
</br></br>
<a href="login.php" class="btny">Logout</a>
</section>



    
    <script src="js/script.js"></script>
    </body>
</html>