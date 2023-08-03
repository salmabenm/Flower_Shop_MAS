<?php

@include 'configuration.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

    if(mysqli_num_rows($select_message) > 0){
        $message[] = 'message sent already!';
    }else{
        mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
        $message[] = 'message sent successfully!';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>
   <link rel="icon" href="images/logoo.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
       
<?php @include 'headerpep.php'; ?>

<!-- contact section starts -->
<section class="contact" id="contact">
</br></br></br></br> </br>   
    <h1 class="heading"><span>Contact</span> us</h1>
    <div class="row">
        <form action="" method="POST">
            <input type="text" name="name" placeholder="name" class="box"required>
            <input type="email" name="email" placeholder="email" class="box" required>
            <input type="number" name="number" placeholder="number" class="box"required>
            <textarea name="message" class="box" placeholder="message" required cols="30" rows="10"></textarea>
            <input type="submit" value="send message" name="send" class="btn">
        </form>
        <div class="image">
            <img src="images/cont1.jfif" alt="">
        </div>
    </div>
</section>
<!-- contact section ends -->


</body>
</html>