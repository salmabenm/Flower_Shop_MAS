<?php

$select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
$order = mysqli_fetch_assoc($select_orders);

// État actuel de la commande
if(strtolower($order['payment_status']) == 'pending'){
    $order_status = 'Passed Order';
} elseif(strtolower($order['payment_status']) == 'completed'){
    $order_status = 'In preparation';
} elseif(strtolower($order['payment_status']) == 'shipped') {
    $order_status =  'Shipped';
} elseif(strtolower($order['payment_status']) == 'delivered'){
    $order_status = 'Order delivered';
}


// Tableau des états de commande
$order_statuses = [
    'Passed Order',
    'In preparation',
    'Shipped',
    'Order delivered'
];

// Récupère l'index de l'état actif de la commande
$current_status_index = array_search(strtolower($order_status), array_map('strtolower', $order_statuses));

// Génère la barre de progression

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Interior</title>
   <link rel="icon" href="images/logoo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="style.css">
   
</head>
<body>
<div class="order-progress">
  <?php
 for ($i = 0; $i < count($order_statuses); $i++) {
    $class = '';
    if ($i < $current_status_index) {
      $class = 'completed';
    } elseif ($i == $current_status_index) {
      $class = 'active';
    }
    $icon_class = '';
    if ($order_statuses[$i] == 'Passed Order') {
      $icon_class = 'fas fa-shopping-cart';
    } elseif ($order_statuses[$i] == 'In preparation') {
      $icon_class = 'fas fa-box-open';
    } elseif ($order_statuses[$i] == 'Shipped') {
      $icon_class = 'fas fa-truck';
    } elseif ($order_statuses[$i] == 'Order delivered') {
      $icon_class = 'fas fa-check-circle';
    }
    ?>
    <div class="progress-step <?php echo $class; ?>">
      <div class="step-number"><i class="<?php echo $icon_class; ?>"></i></div>
      <div class="step-title"><?php echo $order_statuses[$i]; ?></div>
    </div>
    
  <?php } ?>
</div>

</body>
</html>