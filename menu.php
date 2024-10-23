
<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>menu</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
<style>
   /* Product container styles */
   .box-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      padding: 0 20px;
      margin-top: 20px;

   }

   /* Product card styles */
   .box {
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

   .box::after {
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

   .box:hover::after {
      clip-path: polygon(0 0%, 100% 0%, 100% 100%, 0 100%);
      transform: scaleY(1);
      border-top-left-radius: 100px;
      background-color: var(--main-color);
      /* Define your main color here */
      border-bottom-right-radius: 100px;
   }

   /* Adjust the styles for .imagecard */
   .box .imagecard {
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
   .box .imagecard img {
      max-width: 100%;
      max-height: 100%;
   }

   /* Page heading styles */
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

   .card__add {
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

   .card__add:hover {
      opacity: 0.8;
      transform: scale(1.1);
   }

   .card__add:active {
      opacity: 1;
      transform: scale(0.8);
   }

   .card-price {
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

   .card-price:hover {
      opacity: 0.8;
      transform: scale(1.1);
      background-color: black;
   }

   .card-price:active {
      opacity: 1;
      transform: scale(0.8);
   }

   .qty {
      margin-left: 70%;
      height: 30px;
      width: 40px;
   }

   .title{
      background-color: #f3f3f3;
      padding: 20px 0;
      text-align: center;
      margin-top: 10px;
      height: 50px;
   }
   .title h1{
      font-size: 20px;
      font-weight: bold;
      margin-top: -10px;
      color: gray;
   }


</style>
</head>

<body>

   <!-- header section starts  -->
   <?php include 'components/user_header.php'; ?>
   <!-- header section ends -->

   <div class="heading">
      <h3>Our Menu</h3>
      <p><a href="home.php">home</a> <span> / menu</span></p>
   </div>

   <!-- menu section starts  -->

<?php
 

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/add_cart.php';

// Fetch unique product categories
$categories = array();

$select_categories = $conn->prepare("SELECT DISTINCT category FROM products");
$select_categories->execute();

while ($row = $select_categories->fetch(PDO::FETCH_ASSOC)) {
   $categories[] = $row['category'];
}

foreach ($categories as $category) {
   echo '<section class="products">';
   echo '<div class="title">';
   echo '<h1>' . $category . '</h1>';
   echo '</div>';
   echo '<div class="box-container">';

   $select_products = $conn->prepare("SELECT * FROM products WHERE category = :category");
   $select_products->bindParam(':category', $category);
   $select_products->execute();

   if ($select_products->rowCount() > 0) {
      while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
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
            <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
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
   } else {
      echo '<p class="empty">No products in this category yet!</p>';
   }

   echo '</div>';
   echo '</section>';
}
?>


<!-- footer section starts  -->
<?php include 'footer.php'; ?>
<!-- footer section ends -->

</body>
</html>