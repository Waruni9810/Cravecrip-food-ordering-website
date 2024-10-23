<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/connect.php';

if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
   $select_user->execute([$email, $number]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'Email or number already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, number, password) VALUES(?,?,?,?)");
         if($insert_user->execute([$name, $email, $number, $cpass])){
            // Redirect after successful registration.
            header('Location: login.php'); // Check the URL path here.
            exit();
         } else {
            // Handle database insert error, e.g., display an error message.
            $message[] = 'Registration failed. Please try again later.';
         }
      }
   }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   
  <?php include "Title.php"; ?>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
   /* Your CSS code here */
   .form-container {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: -50px;
   }

   .form-container form {
      padding: 25px;
      background-color: #f7f7f7;
      max-width: 500px;
      width: 100%;
      border-radius: 7px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      margin-top: 150px;
   }

   .form-container form h3 {
      font-size: 27px;
      text-align: center;
      margin: 0 0 30px;
   }

   .form-container form .box {
      margin-bottom: 10px;
      position: relative;
   }

   .form-container form label {
      display: block;
      font-size: 15px;
      margin-bottom: 5px;
   }

   .form-container form input {
      height: 40px;
      padding: 10px;
      width: 100%;
      font-size: 15px;
      outline: none;
      background: #fff;
      border-radius: 3px;
      border: 1px solid #bfbfbf;
   }

   .form-container form input:focus {
      border-color: #9a9a9a;
   }

   .form-container form input.error {
      border-color: #f91919;
      background: #f9f0f1;
   }

   .form-container form small {
      font-size: 14px;
      margin-top: 5px;
      display: block;
      color: #f91919;
   }

   .form-container form .password i {
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

   .form-container .btn {
      margin-top: 30px;
      color: white;
      background-color: #FDB10E;
   }

   .form-container .btn input {
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

   .form-container .btn input:hover {
      background: #D00000;
   }

   .form-container .register-otherbt {
      display: flex;
   }

   .form-container .register-otherbt a {
      position: relative;
      left: 195px;
      top: 15px;
      text-align: center;
   }

   .form-container .forgot-otherbt {
      display: flex;
   }

   .form-container .forgot-otherbt a {
      position: relative;
      left: 155px;
      top: 15px;
      text-align: center;
   }
</style>


</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="form-container">

   <form action="" method="post">
      <h3>Register now</h3>
      <input type="text" name="name" required placeholder="enter your name" class="box" maxlength="50">
      <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="number" name="number" required placeholder="enter your number" class="box" min="0" max="9999999999" maxlength="10">
      <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="confirm your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Register now" name="submit" class="btn">
      <p>already have an account? <a href="login.php">Login now</a></p>
   </form>

</section>



<?php include 'footer.php'; ?>

</body>
</html>