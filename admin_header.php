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
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>
   <link rel="icon" href="images/logoo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="style_notif.css">


</head>
<body>
<header class="header">
    <a href="adminpage.php" class="logo">AdminMas<span>.</span></a>
    <div class="flex">
        <nav class="navbar">
            <ul>
                <li><a href="adminpage.php">HOME</a></li>
                <li><a href="#">Mas +</a>
                    <ul>
                        <li><a href="admin_promo.php">Promo</a></li>
                        <li><a href="admin_products.php">Bouquet</a></li>
                        <li><a href="admin_flower.php">Flowers</a></li>
                        <li><a href="admin_card.php">Card</a></li>
                    </ul>
                </li>
                <li><a href="#">Nursery +</a>
                    <ul>
                        <li><a href="admin_gardener.php">Gardener</a></li>
                        <li><a href="admin_interior.php">Interior</a></li>
                        <li><a href="admin_outside.php">Outside</a></li>
                    </ul>
                </li>
                <li><a href="admin_orders.php">ORDERS</a></li>
                <li><a href="admin_users.php">USERS</a></li>
                <li><a href="admin_contacts.php">MESSAGE</a></li>
            
            </ul>
        </nav>
        </div>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="useradmin.php" class="fas fa-user"></a>
       </div>
    
      
     
</div>

       
    

</header>
</body>
</html>