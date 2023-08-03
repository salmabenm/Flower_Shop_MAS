<?php

@include 'configuration.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

    $promo_id = $_POST['promo_id'];
    $promo_name = $_POST['promo_name'];
    $promo_price = $_POST['promo_price'];
    $promo_image = $_POST['promo_image'];
    $promo_quantity = $_POST['promo_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$promo_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$promo_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($check_wishlist_numbers) > 0){
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$promo_name' AND user_id = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$promo_id', '$promo_name', '$promo_price', '$promo_quantity', '$promo_image')") or die('query failed');
        $message[] = 'products added to cart';
    }

}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$delete_id'") or die('query failed');
    header('location:wishlist.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
    header('location:wishlist.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Whishlist</title>
   <link rel="icon" href="images/logoo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="notif_style.css">
  

</head>
<body>
   
<?php @include 'wc-header.php'; ?>

<br><br><br><br><br>

<section >
<h1 class="heading"> Your<span> whishlist</span></h1>
  <table>
   
		<thead>
        <tr>
                    <th></th>
                    <th>Product</th>
                    <th></th>
                    <th>Price</th>
                  
        
			</tr>
		</thead>
   
		<tbody>
    <?php
       $grand_total = 0;
       $select_cart = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
       if(mysqli_num_rows($select_cart) > 0){
           while($fetch_cart = mysqli_fetch_assoc($select_cart)){
    ?>
			<tr>
            <td><span class="delete">
        <a href="wishlist.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from wishlist?');"></a>
        </span>
        </td>
        <td><img src="images/<?php echo $fetch_cart['image']; ?>" alt="" class="product-image"></td>
        <td><?php echo $fetch_cart['name']; ?></td>
		<td><?php echo $fetch_cart['price']; ?>DH </td>
        <form action="" method="POST" class="box">
                    <td><input type="hidden" name="promo_id" value="<?php echo $fetch_cart['id']; ?>"></td>
                    <td><input type="hidden" name="promo_name" value="<?php echo $fetch_cart['name']; ?>"></td>
                    <td><input type="hidden" name="promo_price" value="<?php echo $fetch_cart['price']; ?>"></td>
                    <td><input type="hidden" name="promo_image" value="<?php echo $fetch_cart['image']; ?>"></td>
                    <td><input type="submit" value="ADD TO CART" class="cart__button cart__button--continue-shopping" name="add_to_cart"></td>
                   
                </form>

      <?php
   
        }
    }else{
        echo '<p class="empty">your whishlist is empty</p>';
    }
    ?>
		</tbody>
  
	</table>
  </section>

 

	
  

  <div class="cart">
  
  <div class="cart__items">
    <!-- Product cards go here -->
  </div>
  <div class="cart__actions">
  <a class="cart__button cart__button--continue-shopping" href="search_page.php">
      <span>Search page</span>
    </a>
    <a class="cart__button cart__button--delete-all" href="wishlist.php?delete_all" <?php echo ($grand_total > 1) ? '' : 'disabled' ?>>
      <span>Delete All</span>
  </a>
    <a class="cart__button cart__button--continue-shopping" href="home.php#promo">
      <span>Continue Shopping</span>
    </a>
   
    
    
  </div>

</div>
</br></br>



</div>

</div>









</div>



 
  


<script src="script.js"></script>

</body>
</html>
