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
   <script>
    const menuBtn = document.querySelector(".menu-btn");
    const navbar = document.querySelector(".navbar");

    let menuOpen = false;
    menuBtn.addEventListener("click", () => {
    if (!menuOpen) {
        menuBtn.classList.add("open");
        navbar.classList.add("active");
        menuOpen = true;
    } else {
        menuBtn.classList.remove("open");
        navbar.classList.remove("active");
        menuOpen = false;
    }
    });
    const navbar = document.querySelector('.navbar');
const navbarIcon = document.querySelector('.navbar-icon');
const navbarLinks = document.querySelectorAll('.navbar li');

navbarIcon.addEventListener('click', () => {
  navbarLinks.forEach(link => {
    link.style.display = link.style.display === 'block' ? 'none' : 'block';
  });
});

</script>

</head>
<body>
<header class="header">
    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>
    <a href="home.php" class="logo">MasForU<span>.</span></a>
    <div class="flex">
        <nav class="navbar">
            <ul>
                <li><a href="home.php">HOME</a></li>
                <li><a href="home.php#about">ABOUT</a></li>
                <li><a href="#">SHOP +</a>
                    <ul>
                        <li><a href="home.php#promo">Promo</a></li>
                        <li><a href="home.php#Bouquet">Bouquet</a></li>
                        <li><a href="home.php#flowers">Flower</a></li>
                        <li><a href="home.php#card">Card</a></li>
                    </ul>
                </li>
                <li><a href="home.php#review">REVIEW</a></li>
                <li><a href="contact.php">CONTACT</a></li>
                <nav>
  
  <div class="navbar-icon">
    <i class="fas fa-bars"></i>
  </div>
</nav>

            </ul>
        </nav>
        </div>
        <div class="icons">
        <div id="menu-btn" class="fas fa-bars"></div>
        <a href="search_page.php" class="fas fa-search"></a>
            <?php
                $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php"><div class="icon-container">
            <i class="fas fa-heart"></i>
                <div class="notification-badge"><?php echo $wishlist_num_rows; ?></div>
            </div>
            </a>
            <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><div class="icon-container">
            <i class="fas fa-shopping-cart"></i>
                <div class="notification-badge"><?php echo $cart_num_rows; ?></div>
                </div>
            </a>
            <a href="user.php" class="fas fa-user"></a>
       </div>

       
    

</header>
</body>
</html>
