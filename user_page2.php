<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>user page</title>

 <link rel="stylesheet" href="css/userpage.css">
   <style>
        body{
            background-image: url('images/background.jpg');
            background-attachment: fixed;
            background-size: cover;
        }
        #book{
            margin-top: 130px;
            background: #127369;
            width: 75%;
            height:300px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 25px;
        }
        section {
            padding-top: 80px;
		    align-items: center;
		    justify-content: center;
		    text-align: center;
		    color: white;
		    font-size: 48px;
        }
        button{
            width: 95%;
            padding:10px 15px;
            font-size: 12px;
            margin:8px 0;
            background: #eee;
            border-radius: 5px;
        }
 
        button{
            background: #10403B;
            color:#fff;
            text-transform: capitalize;
            font-size: 20px;
            cursor: pointer;
        }
 
        button:hover{
            background: #10403B;
            color:#fff;
        }
   
   </style>
</head>
<body>
    <nav>
        <label class="logo">Hikers Inn</label>
        <ul>
            <li><a class="active" href="user_page1.php">Home</a></li>
            <li><a  href="user_page.php">Book a room</a></li>
            <li>
               <div class="dropdown">
                    <a><span><?php echo $_SESSION['user_name'] ?></span> 
                     <i class="fa fa-caret-down"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="logout.php" class="btn">logout</a>
                    </div>
               </div>
            </li>

        </ul>
    </nav>
    <div id="book">
        <section>
            <h2>Congrulation you have sucessfully booked your room</h2>
            <button type="button" onclick="window.location.href='user_page3.php';">back to homepage</button>
        </section>
    </div>
</body>
</html>