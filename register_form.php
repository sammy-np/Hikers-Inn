<?php

@include 'config.php';
$user_type = 'user';
if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = ($_POST['user_type'])


   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$password'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($password != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$password','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      *{
         padding: 0px;
         margin: 0px;
      }
      body{
         background-image: url('images/background.jpg');
         background-attachment: fixed;
         background-size: cover;
      }
   </style>
</head>
<body>
<nav>
            <label class="logo">Hikers Inn</label>
            <ul>
                <li><a href="index.html#home">Home</a></li>
                <li><a href="index.html#rooms">Rooms</a></li>
                <li><a href="index.html#services">Services</a></li>
                <li><a href="login_form.php">Login</a></li>
                <li><a class="active" href="register_form.php">register</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </nav>
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <input type="text" name="user_type">
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>

</body>
</html>