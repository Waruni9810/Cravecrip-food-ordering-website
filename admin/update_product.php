<style>
   body {
      overflow-x: hidden;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f2f2f2;
   }

   .update-product {
      text-align: center;
      padding: 20px;
   }

   .heading {
      font-size: 36px;
      margin-bottom: 20px;
      color: #333;
   }

   .box {
      background-color: #f7f7f7;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      width: 100%;
      margin-bottom: 20px;
   }

   img {
      max-width: 100%;
      height: auto;
      margin-bottom: 10px;
   }

   .box span {
      font-size: 24px;
      font-weight: bold;
      color: #333;
      display: block;
      margin-bottom: 10px;
   }

   select {
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

   .flex-btn {
      display: flex;
      justify-content: flex-start;
   }

   .btn,
   .option-btn {
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

   .btn {
      background-color: #FDB10E;
      transition: background-color 0.3s ease-in-out;
   }

   .option-btn {
      background-color: #007BFF;
      transition: background-color 0.3s ease-in-out;
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
   .errormesg{
      color: blue;
      margin-right: 90%;
   }
</style>
<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update product</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

   <?php include '../components/admin_header.php' ?>
   <?php
   if (isset($_POST['update'])) {

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $category = $_POST['category'];
      $category = filter_var($category, FILTER_SANITIZE_STRING);

      $update_product = $conn->prepare("UPDATE `products` SET name = ?, category = ?, price = ? WHERE id = ?");
      $update_product->execute([$name, $category, $price, $pid]);

      $message[] = 'product updated!';

      $old_image = $_POST['old_image'];
      $image = $_FILES['image']['name'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $image_size = $_FILES['image']['size'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $image_folder = '../uploaded_img/' . $image;

      if (!empty($image)) {
         if ($image_size > 2000000) {
            $message[] = 'images size is too large!';
         } else {
            $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $pid]);
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('../uploaded_img/' . $old_image);
            $message[] = 'image updated!';
         }
      }
   }

   ?>
   <!-- update product section starts  -->

   <section class="update-product">

      <h1 class="heading">update product</h1>

      <?php
      $update_id = $_GET['update'];
      $show_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $show_products->execute([$update_id]);
      if ($show_products->rowCount() > 0) {
         while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
            <form action="" method="POST" enctype="multipart/form-data">
               <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
               <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
               <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
               <span>update name</span>
               <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box" value="<?= $fetch_products['name']; ?>">
               <span>update price</span>
               <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_products['price']; ?>">
               <span>update category</span>
               <select name="category" class="box" required>
                  <option selected value="<?= $fetch_products['category']; ?>"><?= $fetch_products['category']; ?></option>
                  <option value="main dish">main dish</option>
                  <option value="fast food">fast food</option>
                  <option value="drinks">drinks</option>
                  <option value="desserts">desserts</option>
               </select>
               <span>update image</span>
               <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
               
               <div class="errormesg">
      <?php
      if(isset($message)) {
         foreach ($message as $msg) {
            echo "<p>$msg</p>";
         }
      }
      ?></div>
      <div class="flex-btn">
                  <input type="submit" value="update" class="btn" name="update">
                  <a href="products.php" class="option-btn">go back</a>
               </div>
            </form>
      <?php
         }
      } else {
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>

   </section>

   <!-- update product section ends -->










   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</body>

</html>