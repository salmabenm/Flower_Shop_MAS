<?php
@include 'configuration.php';
session_start();

$user_id = $_SESSION['user_id'];

$tri = $_GET['tri'];

// requête SQL pour sélectionner tous les produits triés selon l'option choisie
if ($tri == 'nom') {
  $sql = "SELECT * FROM products ORDER BY name";
} elseif ($tri == 'prix') {
  $sql = "SELECT * FROM products ORDER BY price";
} elseif ($tri == 'date_ajout') {
  $sql = "SELECT * FROM products ORDER BY date_ajout";
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
   <title>Bouquet</title>
   <link rel="icon" href="images/logoo.png">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="style.css">


</head>
<body>
   

<?php @include 'header.php'; ?>
</br></br></br></br>
<section class="Bouquet" id="Bouquet">
</br>
  <div class="box-container">
    <?php
    $resultat = mysqli_query($conn, $sql);
    while ($fetch_products = mysqli_fetch_assoc($resultat)) {
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
      
      ?>

    </div>
</section>








