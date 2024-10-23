<style>
   body {
      overflow-x: hidden;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f2f2f2;
   }

   .add-products, .show-products {
      padding: 20px;
      text-align: center;
   }

   .heading {
      font-size: 36px;
      margin-bottom: 20px;
      color: #333;
   }

   .box-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-gap: 20px;
      text-align: left;
      margin-top: 20px;
   }

   .box2{
      background-color: #f7f7f7;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      width: 30%; /* Changed to 75% */
      margin: 0 auto;
      
   }
   .box {
      background-color: #f7f7f7;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      width: 90%; /* Changed to 75% */
      margin: 0 auto; /* Center align the box */
   }

   .box p {
      margin: 10px 0;
      font-size: 18px;
      color: #444;
   }

   .box p span {
      font-weight: bold;
      color: #333;
   }

   .box img {
      max-width: 35%; /* Set the maximum width to 25% */
      height: auto;
      margin-bottom: 10px;
   }

   .flex {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
   }

   .price {
      font-size: 24px;
      color: #333;
   }

   .price span {
      font-size: 18px;
   }

   .category {
      font-size: 18px;
      color: #777;
   }

   .name {
      font-size: 24px;
      color: #333;
   }

   .flex-btn {
      display: flex;
      justify-content: flex-start;
   }

   .option-btn,
   .delete-btn,
   .btn {
      display: inline-block;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      text-decoration: none;
      margin-right: 10px;
   }

   .option-btn {
      background-color: #FDB10E;
      transition: background-color 0.3s ease-in-out;
   }

   /* Style the "Add Product" button with bigger size */
   .btn {
      background-color: #FDB10E;
      padding: 15px 30px; /* Increased padding for a bigger button */
      font-size: 18px; /* Increased font size */
      transition: background-color 0.3s ease-in-out;
   }

   /* Style the "Delete" button with black color */
   .delete-btn {
      background-color: #000;
      color: #fff; /* White text color */
      transition: background-color 0.3s ease-in-out;
   }

   .delete-btn:hover {
      background-color: #D00000; /* Red on hover */
   }

   .btn:hover,
   .option-btn:hover {
      background-color: #D00000;
   }

   .empty {
      text-align: center;
      font-size: 24px;
      margin-top: 20px;
      color: #666;
   }

   .drop-down {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      border: none;
      border-radius: 5px;
      background-color: #fff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
      font-size: 16px;
      color: #333;
   }
   .errormesg{
      color: blue;
   }
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

</style>

<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};


if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>
<?php 
if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exists!';
   }else{
      if($image_size > 2000000){
         $message[] = 'image size is too large';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = $conn->prepare("INSERT INTO `products`(name, category, price, image) VALUES(?,?,?,?)");
         $insert_product->execute([$name, $category, $price, $image]);

         $message[] = 'new product added!';
      }

   }

}

?>

<!-- add products section starts  -->

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h1>Add Product</h1>
      <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box2">
      <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box2">
      <select name="category" class="box2" required>
         <option value="" disabled selected>select category --</option>
         <option value="Chicken">Chicken</option>
         <option value="Burger">Burger</option>
         <option value="Snacks">Snacks</option>
         <option value="Beverages">Beverages</option>
      </select>
      <input type="file" name="image" class="box2" accept="image/jpg, image/jpeg, image/png, image/webp" required><br>
      <input type="submit" value="add product" name="add_product" class="btn">
      <div class="errormesg">
      <?php
      if(isset($message)) {
         foreach ($message as $msg) {
            echo "<p>$msg</p>";
         }
      }
      ?></div>
   </form>


</section>

<!-- add products section ends -->

<!-- show products section starts  -->

<section class="show-products" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_products = $conn->prepare("SELECT * FROM `products`");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
     
      <div class="imagecard">
      <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
            </div>
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_products['price']; ?><span>/-</span></div>
         <div class="category"><?= $fetch_products['category']; ?></div>
      </div>
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>

   </div>

</section>

<!-- show products section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>