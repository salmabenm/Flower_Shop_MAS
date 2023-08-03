<?php

@include 'configuration.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $messagee = mysqli_real_escape_string($conn, $_POST['messagee']);
    $address = mysqli_real_escape_string($conn,  $_POST['flat'].', '. $_POST['City'].', '. $_POST['Country'].' - '. $_POST['Post-code']);
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products[] = '';

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode($cart_products );

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total' AND messagee='$messagee'") or die('query failed');

    if($cart_total == 0){
        $message[] = 'your cart is empty!';
    }elseif(mysqli_num_rows($order_query) > 0){
        $message[] = 'order placed already!';
    }else{
        mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on,messagee) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on','$messagee')") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $message[] = 'order placed successfully!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
   <link rel="icon" href="images/logoo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>

<?php @include 'wc-header.php'; ?>

<br><br><br><br>

<section class="promo">
<h1 class="heading"> Checkout <span>Order </span></h1>
    <div class="cart-total">
    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
    ?>    
    <p> <?php echo $fetch_cart['name'] ?> <span>(<?php echo $fetch_cart['price'].'DH'.' x '.$fetch_cart['quantity']  ?>)</span> </p>
    <?php
        }
        }else{
            echo '<p class="empty">your cart is empty</p>';
        }
    ?>
    
    <p>grand total <span>:<?php echo $grand_total; ?> DH</span></p>
    </div>
</section>

<section class="checkout">
    <div class="row">   
         <form action="" method="POST">

                <h3>Place Your Order</h3>
                <input type="text" class="box" name="name" placeholder="enter your name">
                <input type="number" class="box" name="number" min="0"  placeholder="enter your number">
                <input type="email" class="box" name="email" placeholder="enter your email">
                
                <select class="box" name="method" >
                    <option value="cash on delivery">cash on delivery</option>
                    <option value="credit card">credit card</option>
                    <option value="paypal">paypal</option>
                   
                </select>
            
                <input type="text" class="box" name="flat" placeholder="Adresse">
            
                <input type="text" class="box" name="City" placeholder="City">
            
                <input type="text" class="box" name="State" placeholder="State">
            
                <input type="text" class="box"name="Country" placeholder="County">
          
                <input type="number" class="box" min="0" name="Post-code" placeholder="Post-code">
 
                <textarea  class="box" name="messagee" rows="6" cols="50" maxlength="150" placeholder="Even if you dont add a card , MasForU offre a simple card for you as a gift            
                
Write your card message in 150 lettre or less ! " ></textarea>
               

                <input type="submit" name="order" value="order now" class="btn">
    
    </form>
    
    </div>

</section>






<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>