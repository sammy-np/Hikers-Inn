<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){
 
         $_SESSION['user_name'] = $row['name'];
         header('location:user_page1.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

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
         <li><a class='active' href="login_form.php">Login</a></li>
         <li><a href="#">Contact Us</a></li>
      </ul>
   </nav>
   
<div class="form-container">

   <form action="" method="POST">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>

</div>

</body>
</html>