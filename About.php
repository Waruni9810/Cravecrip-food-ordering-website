<style>

  .heading {
      background-color: #fff3d0;
      padding: 20px 0;
      text-align: center;
      margin-top: 5px;
      height: 75px;
   }

   .heading h3 {
      font-size: 24px;
      font-weight: bold;
      margin-top: -15px;
      color: black;
      
   }

   .heading p {
      font-size: 16px;
      color: #5c5c5c;
     
   }


</style>
<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>
<!DOCTYPE html>
<html>

<head>
  
<?php include "Title.php"; ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <style>
    
    <?php include "css_main/style.css"; ?>
  </style>



</head>

<body>

<!-----------------------------------
  #Navigation bar
------------------------------------->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>About us</h3>
   <p><a href="home.php">home</a> <span> / about</span></p>
</div>


  
<!-----------------------------------
  #About Us section
------------------------------------->
  <section class="about-us">

    <div class="about">
      <img src="images/about3.png" width="50%" height="50%" />

      <div class="about-text">
        <h2>About Us</h2>
        <h5><strong>We cook the best tasty food</strong></h5>
        <p>We cook the best food in the entire city, with excellent customer service, the best meals and at the best price, visit us.</p>
      </div>

    </div>

  </section>


<!-----------------------------------
  #Footer
------------------------------------->
  <footer>
    <?php include "Footer.php"; ?>
  </footer>



</body>

</html>