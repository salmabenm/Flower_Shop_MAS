<?php

@include 'configuration.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
};

if(isset($_POST['update_quantity'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = 'cart quantity updated!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping cart</title>
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
<h1 class="heading"> Your<span> cart </span></h1>
  <table>
   
		<thead>
			<tr>
        <th></th>
				<th> Product</th>
        <th></th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Sub-total</th>
        <th></th>
        
			</tr>
		</thead>
   
		<tbody>
    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
    ?>
			<tr>
				<td><span class="delete">
        <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
        </span>
        </td>
				<td><img src="images/<?php echo $fetch_cart['image']; ?>" alt="" class="product-image"></td>
        <td><?php echo $fetch_cart['name']; ?></td>
				<td><?php echo $fetch_cart['price']; ?>DH </td>
        <form action="" method="post" class="box">
        <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
				<td class="quantity"><input id="product" type="number" class="quantity" value="<?php echo $fetch_cart['quantity']; ?>" min="1" name="cart_quantity"></td>
				<td><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>DH</td>
        <td><input type="submit" value="UPDATE" class="cart__button cart__button--checkou" name="update_quantity"></td></form>
			</tr>

      <?php
    $grand_total += $sub_total;
        }
    }else{
        echo '<p class="empty">your cart is empty</p>';
    }
    ?>
		</tbody>
  
	</table>
  </section>

 

	
  <h1 class="heading"> Cart <span>Total </span></h1>

  <div class="cart">
  <div class="cart__header">
    <h1 class="cart__title">Your total</h1>
    <p class="cart__total">Total: <?php echo $grand_total; ?> DH</p>
  </div>
  <div class="cart__items">
    <!-- Product cards go here -->
  </div>
  <div class="cart__actions">
    <a class="cart__button cart__button--delete-all" href="cart.php?delete_all" <?php echo ($grand_total > 1) ? '' : 'disabled' ?>>
      <span>Delete All</span>
  </a>
    <a class="cart__button cart__button--continue-shopping" href="home.php#promo">
      <span>Continue Shopping</span>
    </a>
    <a class="cart__button cart__button--checkout" href="chocolat.php" <?php echo ($grand_total > 1) ? '' : 'disabled' ?>>
      <span>Checkout</span>
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
