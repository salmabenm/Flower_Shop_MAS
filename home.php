<?php

@include 'configuration.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
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

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="style_notif.css">
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
   

<?php @include 'header.php'; ?>

<!-- home section starts -->
<section class="home" id="home">
    <div class="content">
        <br><h3> Fresh Flowers</h3>
        <span> Natural & Beautiful Flowers </span>
        <p> Send  beautiful flowers anywhere in SAFi at your chosen delevery date and make someone smile.</p>
        <a href="home.php#Bouquet" class="btn">Shop now</a><br>
        <p> Don't forget to visit our Nursery | produce and plant quality seedlings to satisfy you.</p>
        <a href="homepep.php"class="btn" target="_blank"> Nursery Mas</a>
    </div>
</section>
<!-- home section ends -->

<!-- about section starts -->
<section class="about" id="about">
    <h1 class="heading"><span> About </span> Us </h1>
    <div class="row">
        <div class="video-container"> 
              <video src="videos/about-video.mp4" loop autoplay muted></video>
              <h3>Best flower seller</h3>
        </div>
        <div class="content">
            <h3>Why choose Mas?</h3>
            <p>Our shop is full of interesting house plants and gifts on one side and beautiful,seasonal flowers on the other. The smell is divine! It’s ever changing and different every day. </p>
            <p>At our flower shop, we offer a wide range of fresh and vibrant flowers that are perfect for any occasion. Whether you're looking for a beautiful bouquet to surprise your loved one, a stunning centerpiece to decorate your home, or a gift to send to someone special, we've got you covered.</p>
            <a href="learnmore.php" class="btn">Learn more</a>
        </div>
    </div>
</section>
<!-- about section ends -->

<!-- icons section starts -->
<section class="icons-container">
    <div class="icons">
        <img src="images/11.jfif" alt="">
        <div class="info">
            <h3>Free delivery</h3>
            <span>On All Orders</span>
        </div>
    </div>

    <div class="icons">
        <img src="images/13.jfif" alt="">
        <div class="info">
            <h3>10 days returns</h3>
            <span>Moneyback Guarantee</span>
        </div>
    </div>

    <div class="icons">
        <img src="images/10.jfif" alt="">
        <div class="info">
            <h3>Offer & gifts</h3>
            <span>On All Orders</span>
        </div>
    </div>

    <div class="icons">
        <img src="images/imaaaage.jfif" alt="">
        <div class="info">
            <h3>Secure payments</h3>
            <span>Protected By Paypal</span>
        </div>
    </div>
</section>
<!-- icons section ends -->
<br><br>
<!-- promo section start -->
<section class="promo" id="promo">
    <h1 class="heading"> Promo <span>For</span> You</h1>
    <br><br>
    <div class="box-container">
         <?php
               $select_products = mysqli_query($conn, "SELECT * FROM `promo` LIMIT 6") or die('query failed');
               if(mysqli_num_rows($select_products) > 0){
                  while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
        <div class="box">
            <span class="discount">-<?php echo $fetch_products['discount']; ?>%</span>
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
                    <div class="price"><?php echo $fetch_products['price']; ?>DH <span><?php echo $fetch_products['old']; ?>DH</span> </div>
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
<!-- promo section ends -->

<!-- bouquet section start -->
<br><br><br>
<section class="Bouquet" id="Bouquet">

    <h1 class="heading"> Bouquet <span>For </span>You</h1>
    <br>
    <form id="oneForm" action="tri-produits.php" method="GET">
  
        <select name="tri" id="tri" class="select-style" onchange="submitFo()">
            <option value="nom">Name</option>
            <option value="prix">Price</option>
        </select>
    </form></br></br></br></br></br>
    <div class="box-container">
         <?php
               $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
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

<!-- flowers section start -->
<br><br><br>
<section class="flowers" id="flowers" >
 <h1 class="heading"> Make<span> Yours </span></h1>
 <br>
    <form id="myForm" action="tri-flowers.php" method="GET">
  
        <select name="tri" id="tri" class="select-style" onchange="submitForm()">
            <option value="nom">Name</option>
            <option value="prix">Price</option>
        </select>
    </form></br></br>

<br><br>
  <table>

		<thead>
       
			<tr>
            <th></th>
			<th >Product</th>
			<th>Price for one</th>
			<th>Quantity</th>
			<th>To cart</th>
            
            </tr>
		</thead>
   
		<tbody>
        <?php
               $select_products = mysqli_query($conn, "SELECT * FROM `flowers` LIMIT 9") or die('query failed');
               if(mysqli_num_rows($select_products) > 0){
                  while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
		<tr>
           <td><img src="images/<?php echo $fetch_products['image']; ?>" alt="" class="product-image"></td>
           <td><?php echo $fetch_products['name']; ?></td>
		   <td><?php echo $fetch_products['price']; ?>DH </td>
           <form action="" method="post" class="box">
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
				<td class="quantity"><input id="product" type="number" class="quantity" value="1"name="product_quantity"></td>
                <td><input type="submit" value="Add to cart" name="add_to_cart" class="btn"> </td>
            </form>
            
            
            
			</tr>

      <?php
    
        }
    }else{
        echo '<p class="empty">your cart is empty</p>';
    }
    ?>
	</tbody>
  
	</table>
  </section>
<!-- flower section ends -->

<!--  cart section start -->

<section class="card" id="card">
    <h1 class="heading"> Card <span>For </span>You</h1>
    <br><br>
    <form id="notForm" action="tri-cart.php" method="GET">
  
        <select name="tri" id="tri" class="select-style" onchange="submitF()">
            <option value="nom">Name</option>
            <option value="prix">Price</option>
        </select>
    </form></br></br></br></br></br>
    <div class="box-container">
         <?php
               $select_products = mysqli_query($conn, "SELECT * FROM `card`") or die('query failed');
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

<!-- cart section ends -->

<!-- review section starts -->
<section class="review" id="review">
    <h1 class="heading"> Customer's <span>Review</span></h1>
    <div class="box-container">
        <div class="box">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>I received a flower arrangement and it was in a lovely vase. The flowers were beautiful and following the directions for care, they lasted a long time. Love your service and friendliness. I was very pleased with the arrangement and so was the recipient!</p><br><br></br></br>
            <div class="user">
                <img src="images/meriame.jfif" alt="">
                <div class="user-info">
                    <h3>Meriame</h3>
                    <span>Happy customer</span>
                </div>
            </div>
            <span class="fas fa-quote-right"></span>
        </div>

        <div class="box">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>I want to say that my experience with you was okay , there were some areas that could be improved. 
The selection of flowers was good, but the prices were a bit high compared to other websites. 
The flowers arrived on time but weren't as fresh as I expected. Overall, an okay experience, but could be improved .</p>
            <div class="user">
        
                <img src="images/saaaalma.jfif" alt="">
                <div class="user-info">
                    <h3>Salma</h3>
                    <span>Happy customer</span>
                </div>
            </div>
            <span class="fas fa-quote-right"></span>
        </div>

        <div class="box">
            <div class="stars">
                <i class="fa fa-star-half-alt"></i>
            
            </div>
            <p>Sorry but i don't like  your service at all .the prices  were high comapared to other websites .the ordering process wasn't smooth and your offers are limited.</p><br><br></br></br><br><br></br><br>
            <div class="user">
                <img src="images/asmaa.jfif" alt="">
                <div class="user-info">
                    <h3>Asmaa</h3>
                    <span>Unsatisfied customer</span>
                </div>
            </div>
            <span class="fas fa-quote-right"></span>
        </div>
    </div>
</section>
<!-- review section ends -->
<button onclick="topFunction()" id="myBtn" title="Go to top">Back to top</button>
<!--footer section starts-->
<section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>Quick links</h3>
            <a href="home.php#home">HOME</a>
            <a href="home.php#about">ABOUT</a>
            <a href="home.php#promo">PROMO</a>
            <a href="home.php#Bouquet">BOUQUET</a>
            <a href="home.php#review">REVIEW</a>
            <a href="contact.php">CONTACT</a> 
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- partial -->
  <script  src="script.js"></script>
<!-- bouquet section ends -->

</body>
</html>