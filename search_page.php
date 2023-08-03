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
        $message[] = 'already added to wishlist';
    }elseif(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{
        mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
        $message[] = 'product added to wishlist';
    }

}

if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($check_wishlist_numbers) > 0){
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search page</title>
   <link rel="icon" href="images/logoo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   

<?php @include 'header.php'; ?>
</br></br></br></br></br></br>
<h1 class="heading"> Search <span>page</span></h1>



<section class="search-form">
    <form action="" method="POST">
        <div class="search-container">
            <input type="text" class="search-box" placeholder="Search products..." name="search_box">
            <button type="submit" class="search-btn" name="search_btn">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>
</section>
<section class="Bouquet" style="padding-top: 0;">
   
   <div class="box-container">

      <?php
        if(isset($_POST['search_btn'])){
         $search_box = mysqli_real_escape_string($conn, $_POST['search_box']);
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      
      <div class="box">
            <div class="image">
                <img src="images/<?php echo $fetch_products['image']; ?>" alt="" class="image">
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
                
            }
        }else{
            echo '<p class="empty">Search something!</p>';
        }
      ?>

   </div>

</section>

<section class="Bouquet" style="padding-top: 0;">
   
   <div class="box-container">

      <?php
        if(isset($_POST['search_btn'])){
         $search_box = mysqli_real_escape_string($conn, $_POST['search_box']);
         $select_products = mysqli_query($conn, "SELECT * FROM `card` WHERE name LIKE '%{$search_box}%'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      
      <div class="box">
            <div class="image">
                <img src="images/<?php echo $fetch_products['image']; ?>" alt="" class="image">
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
               
            }
        }else{
            
        }
      ?>

   </div>

</section>

<section class="promo" id="promo">
   
    <div class="box-container">
    <?php
        if(isset($_POST['search_btn'])){
         $search_box = mysqli_real_escape_string($conn, $_POST['search_box']);
         $select_products = mysqli_query($conn, "SELECT * FROM `promo` WHERE name LIKE '%{$search_box}%'") or die('query failed');
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
                
            }
        }else{
            
        }
      ?>

    </div>
</section>

<section class="flowers" id="flowers" >

 <br>
  
  <table>

	
        <?php
        if(isset($_POST['search_btn'])){
         $search_box = mysqli_real_escape_string($conn, $_POST['search_box']);
         $select_products = mysqli_query($conn, "SELECT * FROM `flowers` WHERE name LIKE '%{$search_box}%'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      	<thead>
       
       <tr>
       <th></th>
       <th >Product</th>
       <th>Price</th>
       <th>Quantity</th>
       <th>To cart</th>
       
       </tr>
   </thead>

   <tbody>
		<tr>
           <td><img src="images/<?php echo $fetch_products['image']; ?>" alt="" class="product-image"></td>
           <td><?php echo $fetch_products['name']; ?></td>
		   <td><?php echo $fetch_products['price']; ?>DH </td>
           <form action="" method="post" class="box">
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
				<td class="quantity"><input id="product" type="number" class="quantity" value="<?php echo $fetch_products['quantity']; ?>" min="1" name="product_quantity"></td>
                <td><input type="submit" value="Add to cart" name="add_to_cart" class="btn"> </td>
            </form>
            
            
            
			</tr>

            <?php
         }
            }else{
              
            }
        }else{
            
        }
      ?>
	</tbody>
  
	</table>
  </section>

 
<script src="js/script.js"></script>

</body>
</html>