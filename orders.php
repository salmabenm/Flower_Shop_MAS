
<?php

@include 'configuration.php';
session_start();

$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
    header('location:login.php');
 }

?>
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>Orders</title>
<link rel="icon" href="images/logoo.png">
<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<!-- custom css file link -->
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="boxes_style.css">
</head>
<body>
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
<?php @include 'header.php'; ?>
        
<br></br><br>

<section class="flowers" id="flowers" >
<br><br><br>
<h1 class="heading">Your<span> Orders </span> </h1>
<br><br><br><br>
<?php @include 'progresse.php'; ?>
<br><br><br><br>
<?php
              $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
              if(mysqli_num_rows($select_orders) > 0){
              while($fetch_orders = mysqli_fetch_assoc($select_orders)){
              ?>
<table>

		
   
		<tbody>
           
            <tr>
              <td>Placed on</td>
             <td><?php echo $fetch_orders['placed_on']; ?></td>
            </tr>
            <tr>
              <td>Name</td>
             <td><?php echo $fetch_orders['name']; ?></td>
            </tr>
            <tr>
              <td>Number</td>
             <td><strong></strong><?php echo $fetch_orders['number']; ?></td>
            </tr>
            <tr>
              <td>Email</td>
             <td><strong></strong><?php echo $fetch_orders['email']; ?></td>
            </tr>
            <tr>
              <td>Address</td>
             <td><strong></strong><?php echo $fetch_orders['address']; ?></td>
            </tr>
            <tr>
              <td>Payment method</td>
             <td><strong></strong><?php echo $fetch_orders['method']; ?></td>
            </tr>
            <tr>
              <td>Your orders</td>
             <td><strong></strong><?php echo $fetch_orders['total_products']; ?></td>
            </tr>
            <tr>
              <td>Your message</td>
             <td><strong></strong><?php echo $fetch_orders['messagee']; ?></td>
            </tr>
            <tr>
              <td>Total price</td>
             <td><strong></strong><?php echo $fetch_orders['total_price']; ?> DH</td>
            </tr>
            <tr>
              <td>Payment status</td>
             <td> <a href="" class="btny"><span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){echo 'white'; }else{echo 'white';} ?>"><?php echo $fetch_orders['payment_status']; ?></span></a></td>
             
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











    
    <script src="js/script.js"></script>
    </body>
</html>

