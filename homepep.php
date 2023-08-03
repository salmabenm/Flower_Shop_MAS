<?php

@include 'configuration.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:loginpep.php');
}

if(isset($_POST['add_to_wishlist'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    
    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
 
    if(mysqli_num_rows($check_wishlist_numbers) > 0){
        $message[] = 'Already added to wishlist';
    }elseif(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'Already added to cart';
    }else{
        mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
        $message[] = 'Product added to wishlist';
    }
 
 }
 
 if(isset($_POST['add_to_cart'])){
 
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $quantity = 1; // Set default quantity to 1
 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'Already added to cart';
    }else{
 
        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
 
        if(mysqli_num_rows($check_wishlist_numbers) > 0){
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }
 
        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$quantity', '$product_image')") or die('query failed');
        $message[] = 'Product added to cart';
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
<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<!-- custom css file link -->
<link rel="stylesheet" href="stylepep.css">
<script>
  function submitForm() {
    document.getElementById("myForm").submit();
  }
</script>
<script>
function submitF() {
    document.getElementById("notForm").submit();
  }
</script>
<script>
function submitFo() {
    document.getElementById("oneForm").submit();
  }
</script>
<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
</script>
</head>
<body>
   

<?php @include 'headerpep.php'; ?>

<!-- header section ends -->
<!-- home section starts -->
<section class="home" id="home">
    <div class="content">
        <span>Natural&beautiful Seedlings</span>
        <p> Produce and plant quality seedlings to satisfy you.<br> For more information don't forget to visit our principal site web.</p>
        <a href="homepep.php#interior" class="btn">Shop now</a>
        <a href="home.php" class="btn" target="_blank">  MasForU  </a>
        <a href="https://wa.me/1234567890" class="btn">Mas Advisor </a>
    </div>
</section>
<!-- home section ends -->
<!-- gardener section start -->
<section class="gardener" id="gardener">
    <h1 class="heading"> The <span>best</span> one</h1>
    <div class="box-container">
    <?php
               $select_products = mysqli_query($conn, "SELECT * FROM `gardener` LIMIT 10") or die('query failed');
               if(mysqli_num_rows($select_products) > 0){
                  while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
        <div class="box">
            <div class="content">
                <h3><i class="fas fa-phone"></i> <?php echo $fetch_products['name']; ?> </h3>
                <a  href="tel:+212689238310" class="phone"><span>+212 <?php echo $fetch_products['phone']; ?></span></a>
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
<!-- gardener section ends -->

<!-- Interior section start -->

<section class="interior" id="interior">
    <h1 class="heading"> Interior <span>plants </span></h1>
    <br>
    <form id="oneForm" action="tri-interior.php" method="GET">
  
        <select name="tri" id="tri" class="select-style" onchange="submitFo()">
            <option value="nom">Name</option>
            <option value="prix">Price</option>
        </select>
    </form></br></br></br></br></br>
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
    <br>
    <form id="myForm" action="tri-outside.php" method="GET">
  
        <select name="tri" id="tri" class="select-style" onchange="submitForm()">
            <option value="nom">Name</option>
            <option value="prix">Price</option>
        </select>
    </form></br></br></br></br></br>
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
<button onclick="topFunction()" id="myBtn" title="Go to top">Back to top</button>
<!--footer section starts-->
<section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>Quick links</h3>
            <a href="homepep.php#home">HOME</a>
            <a href="homepep.php#about">ABOUT</a>
            <a href="homepep.php#interior">INTERIOR</a>
            <a href="homepep.php#outside">OUTSIDE</a>
            <a href="homepep.php#review">REVIEW</a>
            <a href="homepep.php#contact">CONTACT</a> 
        </div>

        <div class="box">
            <h3>Extra links</h3>
            <a href="user.php">My account</a>
            <a href="orders.php">My order</a>
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