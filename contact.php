<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
  <?php include "Title.php"; ?>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>
   <link rel="stylesheet" href="styles.css"> <!-- Link to the external CSS file -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<style>

   /* styles.css */

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

.contact {
   display: flex;
   align-items: center;
   justify-content: center;
  
}

.contact form {
   padding: 25px;
   background-color: #f7f7f7;
   max-width: 500px;
   width: 100%;
   border-radius: 7px;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
   margin-top: 40px;
}

.contact form h3 {
   font-size: 27px;
   text-align: center;
   margin: 0px 0 30px;
}

.contact form .box {
   margin-bottom: 10px;
   position: relative;
}

.contact form label {
   display: block;
   font-size: 15px;
   margin-bottom: 5px;
}

.contact form textarea {
   width: 98%;
   height: 100px;
}

.contact form input,
.contact form select {
   height: 30px;
   padding: 10px;
   width: 95%;
   font-size: 15px;
   outline: none;
   background: #fff;
   border-radius: 3px;
   border: 1px solid #bfbfbf;
}

.contact form input:focus,
.contact form select:focus,
.contact form textarea:focus {
   border-color: #9a9a9a;
}

.contact form input.error,
.contact form select.error,
.contact form textarea.error {
   border-color: #f91919;
   background: #f9f0f1;
}

.contact form small {
   font-size: 14px;
   margin-top: 5px;
   display: block;
   color: #f91919;
}

.contact form .btn {
   /* Button styles */
   padding: 10px 20px;
   border: none;
   border-radius: 5px;
   font-size: 16px;
   color: white;
   background-color: #FDB10E;
   cursor: pointer;
   height: 40px;
   width: 200px;
}

.contact form .btn-danger {
   /* Red button styles */
   background-color: gray;
}

.contact form .btn-danger:hover {
   /* Red button styles on hover */
   background-color: #FDB10E;
}

.contact form .submit-btn {
   margin-top: 30px;
}

.contact form .submit-btn input {
   color: white;
   border: none;
   height: auto;
   font-size: 16px;
   padding: 10px 0;
   border-radius: 5px;
   cursor: pointer;
   font-weight: 500;
   text-align: center;
   background: #FDB10E;
   transition: 0.2s ease;
   width: 76%;
}

.contact form .submit-btn input:hover {
   background: #D00000;
}

.contact form .otherbt {
   display: flex;
}

.contact form .otherbt a {
   position: relative;
   left: 300px;
   top: 15px;
}

.message {
   color: blue;
}

</style>
<body>

   <header><?php include 'components/user_header.php'; ?></header>

   <div class="heading">
      <h3>Contact Us</h3>
      <p><a href="home.php">Home</a> <span> / Contact</span></p>
   </div>

   <!-- Contact section starts -->
   <section class="contact">
      <div class="row">
         <form action="" method="post">
            <h3>Tell Us Something!</h3>
            <input type="text" name="name" maxlength="50" class="box" placeholder="Enter your name" required>
            <input type="email" name="email" maxlength="50" class="box" placeholder="Enter your email" required>
            <textarea name="msg" class="box" placeholder="Write your message here" required></textarea>

            <?php
            if (isset($_POST['send'])) {
               $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
               $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
               $msg = filter_var($_POST['msg'], FILTER_SANITIZE_STRING);

               // Prepare and execute the SQL query to check if the message already exists
               $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ?  AND message = ?");
               $select_message->execute([$name, $email, $msg]);

               if ($select_message->rowCount() > 0) {
                  $message = 'Message already sent!';
               } else {
                  // Prepare and execute the SQL query to insert the new message
                  $insert_message = $conn->prepare("INSERT INTO `messages` (user_id, name, email, message) VALUES (?, ?, ?, ?)");
                  if ($insert_message->execute([$user_id, $name, $email, $msg])) {
                     $message = 'Message sent successfully!';
                  } else {
                     $message = 'Error sending message. Please try again.';
                  }
               }
            }

            // Output the message status here
            if (isset($message)) {
               echo '<div class="message">' . $message . '</div><br>';
            }
            ?>
            <input type="submit" value="Send Message" name="send" class="btn">
         </form>
      </div>
   </section>

   <!-- Footer section starts -->
   <?php include 'footer.php'; ?>
</body>
</html>
