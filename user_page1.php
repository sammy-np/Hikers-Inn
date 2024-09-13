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
       body
            {
                background-image: url('image/background.jpg');
                background-attachment: fixed;
                background-size: cover;
            }
            *{
                padding: 0px;
                margin: 0px;
            }
            body
            {
                background-image: url('images/background.jpg');
                background-attachment: fixed;
                background-size: cover;
            }
            #home{
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
            #rooms{
                height:550px;
                margin-left:auto;
                margin-right:auto;
                width: 90%;
                background-color:#127369;
                margin-top: 300px;
                border-radius: 25px;
            }
            #rooms h2,#services h2{
                text-align: center;
                color:white;
                font-size:100px;
            }

            #rooms div{
                margin-top: 50px;
                margin-left:40px;
                margin-right: 40px;
                text-align: center;
                height:300px;
                width: 23%;
                display: inline-block;
                color:white;
                border-radius: 25px;
            }
            div.luxury{
                background-image:url(images/luxury.jpg);
                background-attachment: local;
                background-size:contain;
            }
            div.deluxe{
                background-image:url(images/deluxe.jpg);
                background-attachment:local;
                background-size:contain;
            }
            div.single{
                background-image:url(images/single1.jpg);
                background-attachment:local;
                background-size:contain;
            }
            #services{
                height:550px;
                margin-left:auto;
                margin-right:auto;
                width: 90%;
                background-color:#127369;
                margin-top: 300px;
                border-radius: 25px;
            }
            #services div{
                
                display: inline-block;
                width:19%;
                margin-top:50px;
                margin-left:25px;
                margin-right:25px;
                text-align:center;
                height:300px;
                font-size: 10px;
                color: white;
            }
            #services div:hover{
                background-color:#10403B;
                color:white;
                transition: 1s;
            }
            #services div img,#services div h1{
                margin-top: 50px;
            }
   </style>
</head>
<body>
      <nav>
         <label class="logo">Hikers Inn</label>
         <ul>
            <li><a class="active" href="#home">Home</a></li>
            <li><a href="user_page.php">Book a room</a></li>
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
      <div id="home">
        <section>
            <a href="home"></a>
            <h2>Your Home Away From Home</h2>
        </section>
        </div>
        <div id="rooms">
            <h2>ROOMS</h2>
            <div class="luxury">
                <H1>LUXURY</H1>
                
            </div>
            <div class="deluxe">
                <H1>DELUXE</H1>
            </div>
            <div class="single" >
                <H1>SINGLE</H1>
            </div>
        </div>
        <div id="services">
            <h2>SERVICES</h2>
            <div class="view">
                <img src="images/balcony.png" alt="balcony">
                <H1>Balcony View</H1>
            </div>
            <div class="bedrooms">
                <img src="images/bed.png" alt="bedrooms">
                <H1>Master Bedrooms</H1>
            </div>
            <div class="cafe" >
                <img src="images/cafe.png" alt="cafe">
                <H1>Large Cafe</H1> 
            </div>
            <div class="wifi" >
                <img src="images/wifi.png" alt="wifi">
                <H1>wifi coverage</H1>
            </div>
        </div>
    </body>
   
</body>
</html>