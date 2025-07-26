<?php
include 'config.php';
session_start();

if (isset($_POST['submit'])) {
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_from` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if (mysqli_num_rows($select) > 0) {
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      echo "<script>
         setTimeout(function() {
            Swal.fire({
               icon: 'success',
               title: 'Login Successful',
               text: 'Welcome back!',
               showConfirmButton: false,
               timer: 2000
            }).then(() => {
               window.location.href = 'index.php';
            });
         }, 100);
      </script>";
   } else {
      echo "<script>
         setTimeout(function() {
            Swal.fire({
               icon: 'error',
               title: 'Login Failed',
               text: 'Incorrect email or password!',
               confirmButtonText: 'Try Again'
            });
         }, 100);
      </script>";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- Include SweetAlert -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
   <!-- Include Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
   <!-- Custom CSS for Style -->
   <style>
      body {
         background-color: #f1f1f1;
      }
      .login-container {
         background-color: #fff;
         border-radius: 10px;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
         padding: 40px;
         max-width: 400px;
         width: 100%;
         margin-top: 50px;
      }
      .login-container h3 {
         font-weight: bold;
         color: #333;
         text-align: center;
         margin-bottom: 30px;
      }
      .form-control {
         border-radius: 5px;
         padding: 15px;
         font-size: 14px;
         border: 1px solid #ddd;
         box-shadow: none;
      }
      .btn-login {
         background-color: #ff9900;
         color: white;
         border-radius: 5px;
         padding: 12px;
         font-size: 16px;
         border: none;
         width: 100%;
      }
      .btn-login:hover {
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
   </style>
</head>

<body>

   <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
      <div class="login-container">
         <h3>Login to Your Account</h3>
         <form action="" method="post">
            <div class="mb-3">
               <label for="email" class="form-label">Email Address</label>
               <input type="email" class="form-control" name="email" id="email" required placeholder="Enter your email">
            </div>
            <div class="mb-3">
               <label for="password" class="form-label">Password</label>
               <input type="password" class="form-control" name="password" id="password" required placeholder="Enter your password">
            </div>
            <button type="submit" name="submit" class="btn-login">Login</button>
         </form>

         <div class="footer">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
         </div>
      </div>
   </div>

   <!-- Include Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
