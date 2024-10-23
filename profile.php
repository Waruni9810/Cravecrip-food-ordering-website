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

  /* Style the user details section */
  .user-details {
    background-color: #fff;
    padding: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin: 20px auto; /* Center the user details section */
    max-width: 800px; /* Wider maximum width */
    border-radius: 10px; /* Slightly rounded corners */
  }

  /* Style the user info container */
  .user {
    text-align: center;
  }

  .user img {
    width: 150px; /* Adjusted image size */
    border-radius: 50%; /* Circular user image */
    margin: 0 auto 20px;
  }

  .user p {
    font-size: 18px; /* Increased font size for user details */
    margin: 10px 0;
    display: flex;
    align-items: center;
  }

  .user i {
    margin-right: 10px;
    font-size: 24px; /* Increased font size for icons */
  }

  .user .btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 18px;
    margin-top: 20px;
  }

  .user .address {
    font-style: italic;
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
   <title>profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="user-details">

   <div class="user">
      <?php
         
      ?>
      <img src="images/p2.png" alt="">
      <p><i class="fas fa-user"></i><span><span><?= $fetch_profile['name']; ?></span></span></p>
      <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number']; ?></span></p>
      <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email']; ?></span></p>
      <p class="address"><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'please enter your address';}else{echo $fetch_profile['address'];} ?></span></p>
      <a href="update_profile.php" class="btn">update info</a>
   </div>

</section>










<?php include 'footer.php'; ?>


</body>
</html>