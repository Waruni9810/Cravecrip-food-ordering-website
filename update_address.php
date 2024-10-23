<style>
  /* Reset some default styles */
  body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
  }

  /* Apply a background color and set some default styling for the whole page */
  body {
    background-color: #f2f2f2;
    line-height: 1.6;
    font-size: 16px;
  }

  /* Style the header section */
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

  /* Style the form container */
  .form-container {
    background-color: #fff;
    padding: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin: 20px auto; /* Center the form container */
    max-width: 50%; /* Set the maximum width to 50% */
  }

  .form-container h3 {
    font-size: 24px;
    margin: 0 0 20px;
  }

  .box {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin: 10px 0;
  }

  .btn.save-address {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff; /* Button background color */
    color: #fff; /* Button text color */
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 18px; /* Button text size */
  }

  .btn.save-address:hover {
    background-color: #0056b3; /* Hover background color */
  }
 
  /* ... (Your existing styles) ... */

  /* Style the "Back" button */
  .btn.back {
    display: inline-block;
    padding: 10px 20px;
    background-color: #333; /* Button background color */
    color: #fff; /* Button text color */
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 18px; /* Button text size */
    margin-right: 10px;
  }

  .btn.back:hover {
    background-color: #555; /* Hover background color */
  }

  /* Style the "Save Address" button */
  .btn.save-address {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff; /* Button background color */
    color: #fff; /* Button text color */
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 18px; /* Button text size */
  }

  .btn.save-address:hover {
    background-color: #0056b3; /* Hover background color */
  }


</style>

<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

if(isset($_POST['submit'])){

   $address = $_POST['flat'] .', '. $_POST['city'] .',  '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = 'address saved!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  
<?php include "Title.php"; ?>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update address</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php' ?>

<section class="form-container">

   <form action="" method="post">
      <h3>your address</h3>
      <input type="text" class="box" placeholder="Address" required maxlength="50" name="flat">
      <input type="text" class="box" placeholder="City" required maxlength="50" name="city">
      <input type="number" class="box" placeholder="Postal Code" required max="999999" min="0" maxlength="6" name="pin_code">
      <!-- Back button -->
<a href="checkout.php" class="btn back">Back</a>

<!-- Save Address button -->
<input type="submit" value="Save Address" name="submit" class="btn save-address">

   </form>

</section>










<?php include 'footer.php' ?>

</body>
</html>