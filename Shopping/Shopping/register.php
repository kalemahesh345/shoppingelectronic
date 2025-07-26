<?php
include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `user_from` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'User already exists!';
   } else {
      mysqli_query($conn, "INSERT INTO `user_from`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
      $message[] = 'Registered successfully!';
      header('location:login.php');
   }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 450px;
            margin: 50px auto;
        }

        .form-container h3 {
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .box {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn-register {
            background-color: #ff9900;
            color: white;
            border-radius: 5px;
            padding: 12px;
            font-size: 16px;
            border: none;
            width: 100%;
        }

        .btn-register:hover {
            background-color: #ff7f00;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }

        .footer a {
            color: #ff9900;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            font-size: 14px;
        }

        .message-success {
            background-color: #d4edda;
            color: #155724;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="form-container">
            <h3>Create an Account</h3>
            <form action="" method="post">
                <input type="text" name="name" class="box" required placeholder="Enter your username">
                <input type="email" name="email" class="box" required placeholder="Enter your email">
                <input type="password" name="password" class="box" required placeholder="Enter your password">
                <input type="password" name="cpassword" class="box" required placeholder="Confirm your password">
                <button type="submit" name="submit" class="btn-register">Register Now</button>
            </form>

            <p class="footer">Already have an account? <a href="login.php">Login Now</a></p>

            <?php
            if(isset($message)){
               foreach($message as $msg){
                  echo '<div class="message">'. $msg .'</div>';
               }
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
