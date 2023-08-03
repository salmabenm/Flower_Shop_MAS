<?php

@include 'configuration.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_order'])){
   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_id'") or die('query failed');
   $message[] = 'payment status has been updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin orders</title>
   <link rel="icon" href="images/logoo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="styleadmin.css">
   <link rel="stylesheet" href="boxes_style.css">

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
</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section>

<h1 class="title">placed orders</h1>
    <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
        if(mysqli_num_rows($select_orders) > 0){
        while($fetch_orders = mysqli_fetch_assoc($select_orders)){
    ?>
<table>
   
    <tbody>
    
        <tr>
            <td>Placed on :</td>
            <td><?php echo $fetch_orders['placed_on']; ?></td>
        </tr>

        <tr>
            <td>Name :</td>
            <td><?php echo $fetch_orders['name']; ?></td>
        </tr>

        <tr>
            <td>Number :</td>
            <td><?php echo $fetch_orders['number']; ?></td>
        </tr>
        
        <tr>
            <td>Email :</td>
            <td><?php echo $fetch_orders['email']; ?></td>
        </tr>

        <tr>
            <td>Address :</td>
            <td><?php echo $fetch_orders['address']; ?></td>
        </tr>

        <tr>
            <td>Payment method :</td>
            <td><?php echo $fetch_orders['method']; ?></td>
        </tr>

        <tr>
            <td>Your orders :</td>
            <td><?php echo $fetch_orders['total_products']; ?></td>
        </tr>

        <tr>
            <td>Total price :</td>
            <td><?php echo $fetch_orders['total_price']; ?> DH</td>
        </tr>

        <tr>
            <td>Update payment:</td>
        <td>
            <form action="" method="post">
                <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                <select name="update_payment" class="selecty-style" onchange="submitFo()">
                    <option disabled selected><strong><?php echo $fetch_orders['payment_status']; ?></strong></option>
                    <option value="pending">pending</option>
                    <option value="completed">completed</option>
                    <option value="shipped">shipped</option>
                    <option value="delivred">delivred</option>
                </select></br></br>
                <input type="submit" name="update_order" value="update" class="btn">
                <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" class="btn" onclick="return confirm('delete this order?');">delete</a>
            </form>
            </td>
        </tr>
        
      </tbody>
   
	</table>
    <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>

    </section>







<script src="js/admin_script.js"></script>

</body>
</html>