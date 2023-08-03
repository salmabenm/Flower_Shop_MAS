<?php

@include 'configuration.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login_pep.php');
}

if(isset($_POST['add_to_wishlist'])){
    header('location:login_pep.php');
}

if(isset($_POST['add_to_cart'])){
    header('location:login_pep.php');

}


?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>Nursery Mas Group website</title>
<link rel="icon" href="images/logoo.png">
<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<!-- custom css file link -->
<link rel="stylesheet" href="stylepep.css">
<link rel="stylesheet" href="headerpep.css">
</head>
<body>
   
<!-- header section starts-->
<header class="header">

    <input type="checkbox" name="" id="toggler">
    <label for ="toggler" class="fas fa-bars"></label>
    
    <a href="#" class="logo">Nursery <span>Mas.</span></a>
    <div class="flex">
        <nav class="navbar">
            <ul>
                <li><a href="pepini.php">HOME</a></li>
                <li><a href="pepini.php#gardener">GARDENER</a></li>
                <li><a href="#">SHOP +</a>
                    <ul>
                        <li><a href="pepini.php#interior">Interior</a></li>
                        <li><a href="pepini.php#outside">Outside</a></li>
                    </ul>
                </li>
                <li><a href="contactpep.php#contact">CONTACT</a></li>
            
            </ul>
        </nav>
    </div>
    <div class="icons">
        <a href="login_pep.php" class="fas fa-heart"></a>
        <a href="login_pep.php" class="fas fa-shopping-cart"></a>
        <a href="login_pep.php" class="fas fa-user"></a>
    </div>
</header>
<!-- header section ends -->

<!-- header section ends -->
<!-- home section starts -->
<section class="home" id="home">
    <div class="content">
        <span>Natural&beautiful Seedlings</span>
        <p> Produce and plant quality seedlings to satisfy you.<br> For more information don't forget to visit our principal site web.</p>
        <a href="pepini.html#interior" class="btn">Shop now</a>
        <a href="index.php" class="btn" target="_blank">  MasForU  </a>
        <a href="https://wa.me/1234567890" class="btn">Mas Advisor </a>
    </div>
</section>
<!-- home section ends -->
<!-- gardener section start -->
<section class="gardener" id="gardener">
    <h1 class="heading"> The <span>best</span> one</h1>
    <div class="box-container">
        <div class="box">
            <div class="content">
                <h3><i class="fas fa-phone"></i> Haj Mobarak</h3>
                <a  href="tel:+212689238310" class="phone"><span>+212 689238310</span></a>
            </div>
        </div>

        <div class="box">
            <div class="content">
                <h3><i class="fas fa-phone"></i> Si Mohammed</h3>
                <a  href="tel:+212689238310" class="phone"><span>+212 609586685</span></a>
            </div>
        </div>
        <div class="box">
            
            <div class="content">
                <h3><i class="fas fa-phone"></i> Haj Abass</h3>
                <a  href="tel:+212689238310" class="phone"><span>+212 639502387</span></a>
            </div>
        </div>
    </div>
</section>
<!-- gardener section ends -->

<!-- Interior section start -->

<section class="interior" id="interior">
    <h1 class="heading"> Interior <span>plants </span></h1>
    <div class="box-container">
         <?php
               $select_products = mysqli_query($conn, "SELECT * FROM `interior` LIMIT 10") or die('query failed');
               if(mysqli_num_rows($select_products) > 0){
                  while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
        <div class="box">
            
            <div class="image">
                <img src="images/<?php echo $fetch_products['image']; ?>" alt="">
                
                    <form action="" method="POST" class="box">
                
                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <div class="icons">
                        <input type="submit" value="&#x1F6D2;" name="add_to_cart" class="cart-btn white-cart">
                         <input type="submit" value="&#x2665;" name="add_to_wishlist" class="cart-btn">
                        </div>
                    </form>
                
            </div>
            <div class="content">
                <h3><?php echo $fetch_products['name']; ?></h3>
                    <div class="price"><?php echo $fetch_products['price']; ?>DH</div>
            </div>
           

        </div>


        <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>

    </div>
</section>

<!-- Interior section ends -->

<!--  outside section start -->

<section class="outside" id="outside">
    <h1 class="heading"> Outside<span> plants </span></h1>
    <div class="box-container">
         <?php
               $select_products = mysqli_query($conn, "SELECT * FROM `outside`") or die('query failed');
               if(mysqli_num_rows($select_products) > 0){
                  while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
        <div class="box">
            
            <div class="image">
                <img src="images/<?php echo $fetch_products['image']; ?>" alt="">
                
                    <form action="" method="POST" class="box">
                
                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <div class="icons">
                        <input type="submit" value="&#x1F6D2;" name="add_to_cart" class="cart-btn white-cart">
                         <input type="submit" value="&#x2665;" name="add_to_wishlist" class="cart-btn">
                        </div>
                    </form>
                
            </div>
            <div class="content">
                <h3><?php echo $fetch_products['name']; ?></h3>
                    <div class="price"><?php echo $fetch_products['price']; ?>DH</div>
            </div>
           

        </div>


        <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>

    </div>
</section>

<!-- outside section ends -->

<!--footer section starts-->
<section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>Quick links</h3>
            <a href="homepep.php#home">Home</a>
            <a href="homepep.php#about">About</a>
            <a href="homepep.php#interior">Indoor</a>
            <a href="homepep.php#outside">Outdoor</a>
            <a href="homepep.php#review">Review</a>
            <a href="homepep.php#contact">Contact</a> 
        </div>

        <div class="box">
            <h3>Extra links</h3>
            <a href="user.php">My account</a>
            <a href="user.php">My order</a>
            <a href="wishlist.php">My favorite</a>
        </div>

        <div class="box">
            <h3>Social Media</h3>
            <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i> Facebook</a>
            <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="https://www.linkedin.com/"><i class="fab fa-linkedin"></i> Linkedin</a>
        </div>

        <div class="box">
            <h3>Contact info</h3>
            <a href="tel:+212689238310">+212 689238310</a>
            <a href="mailto:masforu@gmail.com">masforu@gmail.com</a>
            <a href="https://www.google.com/maps/place/Safi/@32.3038871,-9.2567456,17z/data=!4m6!3m5!1s0xdac212049843597:0x6b618c47dfd85d40!8m2!3d32.3008151!4d-9.2272033!16zL20vMDViZjJ3">Safi , Morocco - 46000</a>
            <img src="images/im.jfif" alt="">
        </div>
    </div>
    <div class="credit"> Created by <span>MAS GROUP <i>(BENMOUSSA ABDOUNI BELAABDOULI)</i></span> | All Rights Reserved &copy;</div>
</section>
<!--footer section ends-->

</body>
</html>