<style> 
body {
   overflow-x: hidden;
   font-family: Arial, sans-serif;
   margin: 0;
   padding: 0;
   background-color: #f2f2f2;
}

.placed-orders {
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
   grid-template-columns: repeat(1, 1fr);
   grid-gap: 20px;
   text-align: left;
   margin-top: 20px;
}

.box {
   background-color: #f7f7f7;
   padding: 20px;
   border-radius: 10px;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
   width: 100%;
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

.btn {
   display: inline-block;
   padding: 10px 20px;
   border: none;
   border-radius: 5px;
   font-size: 16px;
   color: #fff;
   background-color: #FDB10E;
   cursor: pointer;
   transition: background-color 0.3s ease-in-out;
   text-decoration: none;
   margin-right: 10px;
}

.delete-btn {
   display: inline-block;
   padding: 10px 20px;
   border: none;
   border-radius: 5px;
   font-size: 16px;
   color: #fff;
   background-color: #ff3030;
   cursor: pointer;
   transition: background-color 0.3s ease-in-out;
   text-decoration: none;
}

.btn:hover, .delete-btn:hover {
   background-color: #D00000;
}

.empty {
   text-align: center;
   font-size: 24px;
   margin-top: 20px;
   color: #666;
}

</style>
<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>placed orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>
<?php if(isset($_POST['update_payment'])){

$order_id = $_POST['order_id'];
$payment_status = $_POST['payment_status'];
$update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
$update_status->execute([$payment_status, $order_id]);
$message[] = 'payment status updated!';

}

if(isset($_GET['delete'])){
$delete_id = $_GET['delete'];
$delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
$delete_order->execute([$delete_id]);
header('location:placed_orders.php');
}?>

<!-- placed orders section starts  -->

<section class="placed-orders">

   <h1 class="heading">placed orders</h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders`");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> user id : <span><?= $fetch_orders['user_id']; ?></span> </p>
      <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> total products : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> total price : <span>$<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
      <form action="" method="POST">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="payment_status" class="drop-down">
            <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
            <option value="pending">pending</option>
            <option value="completed">completed</option>
         </select>
         <div class="flex-btn">
            <input type="submit" value="update" class="btn" name="update_payment">
            <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
         </div>
      </form>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no orders placed yet!</p>';
   }
   ?>

   </div>

</section>



</body>
</html>