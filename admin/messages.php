<style>
   body {
   overflow-x: hidden;
   font-family: Arial, sans-serif;
   margin: 0;
   padding: 0;
   background-color: #f2f2f2;
}

.messages {
   padding: 20px;
   text-align: center;
   width: 95%;
   
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
   margin-left: 20px;
}

.box {
   
   background-color: #f7f7f7;
   padding: 20px;
   border-radius: 10px;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
   width: 90%;
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

.delete-btn {
   background-color: #ff3030;
   color: white;
   padding: 10px 20px;
   border: none;
   border-radius: 5px;
   text-decoration: none;
   cursor: pointer;
   transition: background-color 0.3s ease-in-out;
   margin-top: 10px;
   display: inline-block;
}

.delete-btn:hover {
   background-color: #ff0000;
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
   $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- messages section starts  -->

<section class="messages">

   <h1 class="heading">messages</h1>

   <div class="box-container">

   <?php
      $select_messages = $conn->prepare("SELECT * FROM `messages`");
      $select_messages->execute();
      if($select_messages->rowCount() > 0){
         while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> name : <span><?= $fetch_messages['name']; ?></span> </p>
      <p> email : <span><?= $fetch_messages['email']; ?></span> </p>
      <p> message : <span><?= $fetch_messages['message']; ?></span> </p>
      <a href="messages.php?delete=<?= $fetch_messages['id']; ?>" class="delete-btn" onclick="return confirm('delete this message?');">delete</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">you have no messages</p>';
      }
   ?>

   </div>

</section>

<!-- messages section ends -->









<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>