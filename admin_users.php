<?php

@include 'configuration.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users</title>
   <link rel="icon" href="images/logoo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="stylefortable.css">
  

</head>
<body>
   
<?php @include 'admin_header.php'; ?>


<section class="flowers" id="flowers" >
<br><br><br><br>

  <table>

		<thead>
       
			<tr>
          
			<th >User id</th>
			<th>User name</th>
			<th>Email</th>
			<th>User type</th>
            <th>Delete</th>
            </tr>
		</thead>
   
		<tbody>
        <?php
              $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
              if(mysqli_num_rows($select_users) > 0){
                 while($fetch_users = mysqli_fetch_assoc($select_users)){
                  ?>
		<tr>
           <td><span><?php echo $fetch_users['id']; ?></span></td>
           <td><span><?php echo $fetch_users['name']; ?></span></td>
           <td><span><?php echo $fetch_users['email']; ?></span></td>
           <td><span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; }; ?>"><?php echo $fetch_users['user_type']; ?></span></td>
           <td><a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="btn">Delete</a></td>
            
            
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













</body>
</html>