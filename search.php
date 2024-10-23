
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
<html lang="en">
<head>
    
  <?php include "Title.php"; ?>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <style>
/* Custom CSS for the search page */

.search-form {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: -130px;
}

.search-form form {
    padding: 25px;
    background-color: #f7f7f7;
    max-width: 500px;
    width: 100%;
    border-radius: 7px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    margin-top: 150px;
}

.search-form form h3 {
    font-size: 27px;
    text-align: center;
    margin: 0 0 30px;
}

.search-form form .box {
    margin-bottom: 10px;
    position: relative;
}

.search-form form label {
    display: block;
    font-size: 15px;
    margin-bottom: 5px;
}

.search-form form input {
    height: 40px;
    padding: 10px;
    width: 100%;
    font-size: 15px;
    outline: none;
    background: #fff;
    border-radius: 3px;
    border: 1px solid #bfbfbf;
}

.search-form form input:focus {
    border-color: #9a9a9a;
}

.search-form form input.error {
    border-color: #f91919;
    background: #f9f0f1;
}

.search-form form small {
    font-size: 14px;
    margin-top: 5px;
    display: block;
    color: #f91919;
}

.search-form form .password i {
    position: absolute;
    right: 0;
    height: 35px;
    top: 23px;
    font-size: 13px;
    line-height: 35px;
    width: 35px;
    cursor: pointer;
    color: #939393;
    text-align: center;
}

.search-form .btn {
    margin-top: 30px;
}

.search-form .btn input {
    color: white;
    border: none;
    height: auto;
    font-size: 16px;
    padding: 10px 0;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 500;
    text-align: center;
    background: var(--main-color); /* Use your main color here */
    transition: 0.2s ease;
}

.search-form .btn input:hover {
    background: #D00000;
}

.search-form .register-otherbt {
    display: flex;
}

.search-form .register-otherbt a {
    position: relative;
    left: 195px;
    top: 15px;
    text-align: center;
}

.search-form .forgot-otherbt {
    display: flex;
}

.search-form .forgot-otherbt a {
    position: relative;
    left: 155px;
    top: 15px;
    text-align: center;
}
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
      
   }

   .heading p {
      font-size: 16px;
      color: #5c5c5c;
     
   }

   /* Product container styles */
.products .box-container {
   display: flex;
   flex-wrap: wrap;
   justify-content: space-between;
   padding: 0 20px;
   margin-top: 20px;
}

/* Product card styles */
.products .box {
   position: relative;
   background-color: #fff;
   text-align: center;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
   z-index: 1;
   margin-top: 20px;
   border-top-left-radius: 100px;
   border-bottom-right-radius: 15px;
   width: 280px;
   height: 350px;
   margin-right: 20px;
   margin-bottom: 20px;
}

.products .box::after {
   content: "";
   position: absolute;
   inset: 0;
   background-color: #ffffff;
   clip-path: polygon(0 0%, 100% 0%, 100% 100%, 0 100%);
   transform: scaleY(0.3);
   transform-origin: bottom;
   z-index: -1;
   transition: 0.25s ease;
}

.products .box:hover::after {
   clip-path: polygon(0 0%, 100% 0%, 100% 100%, 0 100%);
   transform: scaleY(1);
   border-top-left-radius: 100px;
   background-color: var(--main-color);
   border-bottom-right-radius: 100px; /* Adjust this value as needed */
}

/* Adjust the styles for .imagecard */
.products .box .imagecard {
   height: 200px;
   width: 200px;
   background-color: white;
   display: flex;
   justify-content: center;
   align-items: center;
   margin-left: 14%;
   border-radius: 50%;
}

/* Ensure the image doesn't exceed the dimensions of the .imagecard */
.products .box .imagecard img {
   max-width: 100%;
   max-height: 100%;
}

/* Page heading styles */
.products .heading {
   background-color: #fff3d0;
   padding: 20px 0;
   text-align: center;
   margin-top: 5px;
   height: 75px;
}

.products .heading h3 {
   font-size: 24px;
   font-weight: bold;
   margin-top: -15px;
}

.products .heading p {
   font-size: 16px;
   color: #5c5c5c;
}

/* Styles for Add to Cart button */
.products .card__add {
   overflow: hidden;
   width: 150px;
   height: 40px;
   right: 0;
   bottom: 0px;
   position: absolute;
   background-color: #222222;
   border: none;
   color: #fff;
   border-top-left-radius: 15px;
   border-bottom-right-radius: 15px;
   font-size: 20px;
   cursor: pointer;
   outline: none;
   transition: all 0.3s ease-in;
}

.products .card__add:hover {
   opacity: 0.8;
   transform: scale(1.1);
}

.products .card__add:active {
   opacity: 1;
   transform: scale(0.8);
}

/* Styles for the product price */
.products .card-price {
   overflow: hidden;
   width: 120px;
   height: 45px;
   position: relative;
   bottom: 0;
   background-color: var(--main-color);
   border: none;
   color: #fff;
   border-top-left-radius: 15px;
   border-bottom-right-radius: 15px;
   font-size: 20px;
   cursor: pointer;
   outline: none;
   transition: all 0.3s ease-in;
   margin-bottom: -10%;
}

.products .card-price:hover {
   opacity: 0.8;
   transform: scale(1.1);
   background-color: black; /* Adjust the background color */
}

.products .card-price:active {
   opacity: 1;
   transform: scale(0.8);
}

/* Styles for quantity input */
.products .qty {
   margin-left: 70%;
   height: 30px;
   width: 40px;
}

/* Styles for the title */
.products .title {
   background-color: #f3f3f3;
   padding: 20px 0;
   text-align: center;
   margin-top: 10px;
   height: 50px;
}

.products .title h1 {
   font-size: 20px;
   font-weight: bold;
   margin-top: -10px;
   color: gray;
}
/* Ensure the image size is 15% of the container width */
.products .box .imagecard img {
    max-width: 100%;
      max-height: 100%;
}
/* Styles for the search button */
button.fas.fa-search {
   background-color: #3498db; /* Change to your desired background color */
   color: #fff; /* Text color */
   border: none;
   padding: 10px 20px; /* Adjust padding as needed */
   font-size: 16px;
   cursor: pointer;
   border-radius: 5px; /* Rounded corners */
   transition: background-color 0.3s ease-in-out;
}

/* Hover effect */
button.fas.fa-search:hover {
   background-color: #258cd1; /* Change to a slightly different shade for hover effect */
}



</style>

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>

<div class="heading">
   <h3>search</h3>
   <p><a href="menu.php">menu</a> <span> / search</span></p>
</div>
<!-- header section ends -->

<!-- search form section starts  -->

<section class="search-form">
   <form method="post" action="">
      <input type="text" name="search_box" placeholder="search here..." class="box">
      <button type="submit" name="search_btn" class="fas fa-search"></button>
   </form>
</section>

<!-- search form section ends -->


<section class="products" style="min-height: 100vh; padding-top:0;">

<div class="box-container">

      <?php
         if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
         $search_box = $_POST['search_box'];
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
         <form action="" method="post" class="box">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">

            <div class="imagecard">
               <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
            </div>
           
            <button class="card__add" type="submit" name="add_to_cart">Add to Cart</button>
            <a <?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
            <div class="name"><?= $fetch_products['name']; ?></div>
            <div class="card-price">
               <button class="card-price">Rs:<?= $fetch_products['price']; ?>.00</button>
            </div>
            <div class="qty">
               <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
            </div>
         </form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         } 
      }
      ?>

   </div>

</section>
<footer>
    <?php include "Footer.php"; ?>
  </footer>

</body>
</html>