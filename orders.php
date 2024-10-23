<style>
  /* Reset some default styles */
  body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
  }

  /* Apply a background color and set some default styling for the whole page */
  body {
    background-color: #f2f2f2;
    line-height: 1.6;
    font-size: 16px;
  }

  /* Style the header section */
  .heading {
    background-color: #fff3d0;
    padding: 20px 0;
    text-align: center;
    margin-top: 5px;
    height: 75px;
  }

  .heading h3 {
    font-size: 28px; /* Increased font size */
    font-weight: bold;
    margin-top: -15px;
    color: #333; /* Darker text color */
  }

  .heading p {
    font-size: 16px;
    color: #888; /* Slightly darker text color */
  }

  /* Style the orders section */
  .orders {
    background-color: #fff;
    padding: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin: 20px auto; /* Center the orders section */
    max-width: 800px; /* Wider maximum width */
    border-radius: 10px; /* Slightly rounded corners */
  }

  .title {
    font-size: 32px; /* Larger title font size */
    margin: 0 0 20px;
    color: #333; /* Darker title text color */
  }

  /* Style the box container */
  .box-container {
    border-bottom: 1px solid #ccc;
    padding-bottom: 20px;
    margin-bottom: 20px;
  }

  /* Style each order box */
  .box {
    font-size: 18px; /* Larger font size for order details */
    border: 1px solid #ccc;
    border-radius: 10px; /* More rounded corners */
    padding: 20px; /* Increased padding for better spacing */
    margin: 20px 0; /* Increased margin for better spacing */
    box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1); /* Subtle box shadow */
  }

  .box p {
    margin: 10px 0; /* Adjusted spacing between order details */
    display: flex;
    justify-content: space-between;
  }

  .box span {
    font-weight: bold;
  }

  .box .payment-status {
    color: #007bff; /* Payment status color */
  }

  .empty {
    font-size: 24px; /* Larger font size for empty message */
    text-align: center;
    color: #555; /* Darker text color */
  }
</style>

<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <?php include "Title.php"; ?>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>orders</h3>
   <p><a href="home.php">home</a> <span> / orders</span></p>
</div>

<section class="orders">

   <h1 class="title">Your Orders</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">please login to see your orders</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>name : <span><?= $fetch_orders['name']; ?></span></p>
      <p>email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>number : <span><?= $fetch_orders['number']; ?></span></p>
      <p>address : <span><?= $fetch_orders['address']; ?></span></p>
      <p>payment method : <span><?= $fetch_orders['method']; ?></span></p>
      <p>your orders : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>total price : <span>$<?= $fetch_orders['total_price']; ?>/-</span></p>
      <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">No orders placed yet!</p>';
      }
      }
   ?>

   </div>

</section>



<!-- footer section starts  -->
<?php include 'footer.php'; ?>
<!-- footer section ends -->

</body>
</html>