
<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:login.php');
};

if (isset($_POST['delete'])) {
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
   $message[] = 'cart item deleted!';
}

if (isset($_POST['delete_all'])) {
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   // header('location:cart.php');
   $message[] = 'deleted all from cart!';
}

if (isset($_POST['update_qty'])) {
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

$grand_total = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
   
  <?php include "Title.php"; ?>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

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
      height: 400px;
      /* Increased height */
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

   .card-price2 {

      width: 180px;
      height: 45px;
      background-color: var(--main-color);
      border: none;
      color: #fff;
      border-top-left-radius: 15px;
      border-bottom-right-radius: 15px;
      font-size: 18px;
      cursor: pointer;
      outline: none;
      transition: all 0.3s ease-in;
      align-items: center;
      display: flex;
      justify-content: center;

   }

   .card-price:hover,
   .card-price2:hover {
      opacity: 0.8;
      transform: scale(1.1);
      background-color: black;
   }

   .card-price:active,
   .card-price2:active {
      opacity: 1;
      transform: scale(0.8);
   }

  /* Style the quantity input field */
.qty {
    width: 50px; /* Adjust the width as needed */
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-left: 70%;
    margin-bottom: 5px;
}

/* Style the edit button */
button[type="submit"].fa-edit {
    background-color: transparent;
    border: none;
    color: #007bff; /* You can choose your preferred color */
    font-size: 16px;
    cursor: pointer;
    transition: color 0.3s;
}

button[type="submit"].fa-edit:hover {
    color: #00569b; /* Change the color on hover */
}


   .card__add {
      overflow: hidden;
      width: 100px;
      height: 30px;
      right: 0;
      bottom: 0px;
      position: absolute;
      background-color: #222222;
      border: none;
      color: #fff;
      border-top-left-radius: 15px;
      border-bottom-right-radius: 15px;
      font-size: 15px;
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


/* Style the cart-control container */
.cart-control {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f7f7f7;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Style the cart-total section */
.cart-total {
    font-size: 18px;
}

/* Style the proceed to checkout button */
.processbtn {
    padding: 10px 20px;
    background-color: var(--main-color);
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    cursor: pointer;
}

.processbtn.disabled {
    background-color: #ccc;
    pointer-events: none;
    cursor: not-allowed;
}

.processbtn:hover {
    background-color: #00569b;
}

/* Style the delete all button */
.delete-btn button {
    padding: 10px 20px;
    background-color: black;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.delete-btn.disabled button {
    background-color: #ccc;
    pointer-events: none;
    cursor: not-allowed;
}

.delete-btn button:hover {
    background-color: #d23323;
}

/* Style the continue shopping button */
.continue-shopping .btn {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.continue-shopping .btn:hover {
    background-color: #39ad49;
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

</style>
</head>

<body>

   <!-- header section starts  -->
   <?php include 'components/user_header.php'; ?>
   <!-- header section ends -->

   <div class="heading">
      <h3>shopping cart</h3>
      <p><a href="home.php">home</a> <span> / cart</span></p>
   </div>

   <!-- shopping cart section starts  -->

   <section class="products">


      <div class="box-container">

         <?php
         $grand_total = 0;
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if ($select_cart->rowCount() > 0) {
            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                  <div class="imagecard">

                     <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                  </div>

                  <div class="name"><?= $fetch_cart['name']; ?></div>
                  <div class="flex">

                     <div class="card-price">
                        <button class="card-price">Rs:<?= $fetch_cart['price']; ?>.00</button>
                     </div>

                     <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
                     <button type="submit" class="fas fa-edit" name="update_qty"></button>
                  </div>
                  <div class="card-price2">
                     <div class="sub-total"> sub total : <span>Rs.<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
                     </div>
                     <div class="delete">
                        <button class="card__add" type="submit" name="delete" onclick="return confirm('Delete this item?');">Delete</button>
                     </div>

               </form>
         <?php
               $grand_total += $sub_total;
            }
         } else {
            echo '<p class="empty">your cart is empty</p>';
         }
         ?>

      </div>

<div class="cart-control">
    <div class="cart-total">
        <p>Cart Total: <span>Rs.<?= $grand_total; ?></span></p>
    </div>
    <div class="procheckout">
        <a href="checkout.php" class="processbtn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
    </div>

    <div class="continue-shopping">
        <a href="menu.php" class="btn">Continue Shopping</a>
    </div>
    <div class="delete-btn">
        <form action="" method="post">
            <button type="submit" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" name="delete_all" onclick="return confirm('Delete All from Cart?');">Delete All</button>
        </form>
    </div>
</div>


   </section>

   <!-- shopping cart section ends -->










   <!-- footer section starts  -->
   <?php include 'footer.php'; ?>
   <!-- footer section ends -->

</body>

</html>