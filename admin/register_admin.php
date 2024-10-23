
<style>
body {
   overflow-x: hidden;
   font-family: Arial, sans-serif;
   margin: 0;
   padding: 0;
   background-color: #f2f2f2;
}

.form-container {
   display: flex;
   justify-content: center;
   align-items: center;
   height: 100vh;
 
}

form {
   background-color: #f7f7f7;
   padding: 20px;
   border-radius: 10px;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
   width: 90%;
   max-width: 400px;
   text-align: center;
   margin-top: -100px;
}

h3 {
   font-size: 24px;
   margin-bottom: 20px;
   color: #333;
}

.box {
   width: 100%;
   padding: 10px;
   margin: 10px 0;
   border: none;
   border-radius: 5px;
   background-color: #fff;
   box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
   font-size: 16px;
   color: #333;
}

.btn {
   display: block;
   width: 100%;
   padding: 10px;
   margin-top: 20px;
   border: none;
   border-radius: 5px;
   font-size: 18px;
   color: #fff;
   background-color: #FDB10E;
   cursor: pointer;
   transition: background-color 0.3s ease-in-out;
   text-decoration: none;
}

.btn:hover {
   background-color: #D00000;
}
.message{
   color: blue;
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
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>


<!-- register admin section starts  -->

<<!-- register admin section starts  -->
<section class="form-container">
   <form action="" method="POST">
      <h3>register new</h3>
      <input type="text" name="name" maxlength="20" required placeholder="enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" maxlength="20" required placeholder="confirm your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <?php
   if(isset($_POST['submit'])){
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $pass = sha1($_POST['pass']);
      $pass = filter_var($pass, FILTER_SANITIZE_STRING);
      $cpass = sha1($_POST['cpass']);
      $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

      $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
      $select_admin->execute([$name]);

      if($select_admin->rowCount() > 0){
         $message[] = 'username already exists!';
      }else{
         if($pass != $cpass){
            $message[] = 'confirm password not matched!';
         }else{
            $insert_admin = $conn->prepare("INSERT INTO `admin`(name, password) VALUES(?,?)");
            $insert_admin->execute([$name, $cpass]);
            $message[] = 'new admin registered!';
         }
      }

      // Display messages
      if(isset($message) && !empty($message)) {
         echo '<div class="message-container">';
         foreach($message as $msg) {
            echo '<p class="message">' . $msg . '</p>';
         }
         echo '</div>';
      }
   }
   ?>
      <input type="submit" value="register now" name="submit" class="btn">
   </form>
   

</section>
<!-- register admin section ends -->


<!-- register admin section ends -->
















<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>