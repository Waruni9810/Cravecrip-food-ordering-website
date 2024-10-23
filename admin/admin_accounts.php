<style>
body {
   overflow-x: hidden;
   font-family: Arial, sans-serif;
   margin: 0;
   padding: 0;
   background-color: #f2f2f2;
}

.accounts {
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
   text-align: center;

}

.box {
   background-color: #f7f7f7;
   padding: 20px;
   border-radius: 10px;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
   width: 90%;
   height: 230px;
   margin: 0 auto;
   position: relative;
   overflow: hidden;
   transition: transform 0.3s ease-in-out;
}

.regbox{
   background-color: #f7f7f7;
   padding: 20px;
   border-radius: 10px;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
   width: 90%;
   height: 100px;
   margin: 0 auto;
   position: relative;
   overflow: hidden;
   transition: transform 0.3s ease-in-out;
}

.box:hover {
   transform: translateY(-10px);
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

.flex-btn {
   display: flex;
   justify-content: center;
   align-items: center;
   margin-top: 20px;
}

.box .delete-btn {
   background-color: #ff3030;
   color: white;
   padding: 10px 20px;
   border: none;
   border-radius: 5px;
   margin-right: 10px;
   text-decoration: none;
   cursor: pointer;
   transition: background-color 0.3s ease-in-out;
}

.box .delete-btn:hover {
   background-color: #ff0000;
}

.option-btn {
   background-color: #007BFF;
   color: white;
   padding: 10px 20px;
   border: none;
   border-radius: 5px;
   text-decoration: none;
   cursor: pointer;
   transition: background-color 0.3s ease-in-out;
}

.option-btn:hover {
   background-color: #0056b3;
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
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
   $delete_admin->execute([$delete_id]);
   header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admins accounts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admins accounts section starts  -->

<section class="accounts">

   <h1 class="heading">admins account</h1>

   <div class="box-container">

   <div class="regbox">
      <h3>register new admin</h3>
      <a href="register_admin.php" class="option-btn">register</a>
   </div>

   <?php
      $select_account = $conn->prepare("SELECT * FROM `admin`");
      $select_account->execute();
      if($select_account->rowCount() > 0){
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <p> admin id : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> username : <span><?= $fetch_accounts['name']; ?></span> </p>
      <div class="flex-btn">
         <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('delete this account?');">delete</a>
         <?php
            if($fetch_accounts['id'] == $admin_id){
               echo '<a href="update_profile.php" class="option-btn">update</a>';
            }
         ?>
      </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no accounts available</p>';
   }
   ?>

   </div>

</section>

<!-- admins accounts section ends -->




















<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>