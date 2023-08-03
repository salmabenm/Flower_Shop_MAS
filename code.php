<?php 
    session_start();
    @include 'configuration.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';

    function sendemail_verify($name,$email,$verify_token)
    {
        $mail = new PHPMailer(true);
         //Server settings                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'masforu2@gmail.com';                     //SMTP username
    $mail->Password   = 'm@s4u123';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('masforu2@gmail.com', 'MasForU');
    $mail->addAddress($email);     //Add a recipient
 

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'email verification from MasForU';

    $email_template = "<h2>You have registered with MasForU</h2>
                    <h5>Verify your email to login with the below given link</h5>
                    <br><br>
                    <a href='http://localhost/projetmas/verify_email.php?token=$verify_token'> Click me </a>";
    $mail->Body = $email_template;
    

    $mail->send();
    echo 'Message has been sent';
}


    if (isset($_POST['register_btn']))
    {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $verify_token = md5(rand());

        //email exists or not
        $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
        $check_email_query_run = mysqli_query($conn, $check_email_query);
        
        if(mysqli_num_rows($check_email_query_run) > 0)
        {
            $_SESSION['status'] = "Email id already exists";
            header("localisation: regitre.php");
        }
        else 
        {
            //insert user data
            $query = "INSERT INTO users(name,phone,email,password,verify_token) VALUE('$name','$phone','$email','$password','$verify_token')";
            $query_run = mysqli_query($conn, $query);

            if($query_run)
            {
                sendemail_verify("$name","$email","$verify_token");
                $_SESSION['status'] = "registration succesful! please check your email";
                header("localisation: regitre.php");
            }
            else
            {
                $_SESSION['status'] = "registration failed";
                header("localisation: regitre.php");
            }
        }
    }
?>