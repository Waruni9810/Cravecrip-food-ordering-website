<!DOCTYPE html>

<head>

<!-----------------------------------
  #style
------------------------------------->
  <style>
    /*-----------------------------------*\
  #Footer
\*-----------------------------------*/
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
  text-decoration: none;
  list-style: none;
}

:root {
  --bg-color: #fff;
  --text-color: #D00000;
  --main-color: #FDB10E;
  --text2-color: #5c5c5c;

}
footer {
  
  position: relative;
  z-index: 1000;
  width: 100%;
  height: 220px;
  background-color: #FDB10E;
  bottom: 0;
  /*border-top-left-radius: 75px;
  border-top-right-radius: 75px;*/
  margin-top: 50px;
  margin-bottom: 20px;
  
}

.footer-col .paragraph {
  color: white;
  position: relative;
  top: 10px;
  left: 0px;
}

.logow {
  position: relative;
  top: 10px;
  left: 0px;
  margin-bottom: 20px
}

.footer-row {
  width: 90%;
  margin: auto;
  display: flex;
  flex-wrap: wrap;
  align-items: flex-start;
  justify-content: space-between;
}

.footer-col {
  flex-basis: 20%;
  padding: 10px;
}

.footer-col h3 {
  top: 10px;
  width: fit-content;
  margin-bottom: 25px;
  position: relative;
  color: #ffffff;
  font-size: 22px;
  border-bottom: 3px solid #fff;

}

.footer-col h4 {
  width: fit-content;
  position: relative;
  color: #fff;
}

.email-id {
  width: fit-content;
  border-bottom: 1px solid #fff;
  color: #fff;
  margin: 20px 0;
}

.footer-col ul li a {
  list-style: none;
  color: #fff;
  display: block;
  margin: -9px 0;
  font-size: 15px;
  
}

.Social-Media {
  width: 80%;
  margin: auto;
  display: flex;
  justify-content: space-between;
  position: relative;
  top: 10px;
  right: 30px;

}

.Social-Media img {
  margin-right: 8px;
  padding-left: 5px;
}

.footer_copy .copy {
  color: #5c5c5c;
  position: relative;
  bottom: -5px;
  text-align: center;
  font-size: 13px;
  
}

.footer-col a:hover {
            text-decoration: underline;
            color: #222;
        }
  .loader {
   position: fixed;
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   z-index: 1000000;
   background-color: white; /* Set the background color to white */
   display: flex;
   align-items: center;
   justify-content: center;
}

.loader img {
   height: 15rem;
}
  </style>

</head>

<body>

  <footer>

    <div class="footer-row">

  <!-----------------------------------
  #column-logo
  ------------------------------------->
      <div class="footer-col">
        <img src="images/logow.png" width="50%" height="50%" class="logow">
        <p class="paragraph">Favor the Flavors, Feed Your Cravings</p>
      </div>

  <!-----------------------------------
  #column-Office
  ------------------------------------->
  <div class="footer-col">
        <h3>Office</h3>
        <p class="paragraph">CraveCrisp</br>
        No.136/C, Pittugala, Malabe, SriLanka.</p></br>
        <h4><p class="email-id">cravecrisp@gmail.com</p></h4>
        <h4>+94-7600 98 789</h4>

      </div>

  <!-----------------------------------
  #column-Links
  ------------------------------------->
      <div class="footer-col">
        <h3>Links</h3>
        <ul>
          <li><a href="Home.php">Home</a></li>
          <li><a href="Menu.php">Menu</a></li>
          <li><a href="Contact.php">Contact</a></li>
          <li><a href="About.php">About Us</a></li>

        </ul>

      </div>

  <!-----------------------------------
  #column-Menu
  ------------------------------------->
      <div class="footer-col">
        <h3>Menu</h3>
        <ul>
          <li><a href="Menu.php">Chicken</a></li>
          <li><a href="Menu.php">Burger</a></li>
          <li><a href="Menu.php">Snacks</a></li>
          <li><a href="Menu.php">Beverages</a></li>

        </ul>

      </div>

  <!-----------------------------------
  #column-Social Media
  ------------------------------------->
      <div class="footer-col">
        <h3>Social Media</h3>
        <div class="Social-Media">
          <img src="images/Facebook.png" width="23%" height="23%">
          <img src="images/twitter.png" width="23%" height="23%">
          <img src="images/whatsapp.png" width="23%" height="23%">
          <img src="images/pinterest.png" width="23%" height="23%">
        </div>

      </div>

    </div>


  <!-----------------------------------
  #copy-right
  ------------------------------------->
    <div class="footer_copy">
      <h3 class="copy">© Copyright @ 2023 By CraveCrisp | All Rights Reserved!</h3>
    </div>

  </footer>
</body>

</html>


<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="js/script.js"></script>