<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your head content here -->
    <style>
               body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        html,
        body {
            overflow-x: hidden;
        }

        .header {
            background-color: white;
            color: #5c5c5c;
            width: 100%;
            height: 90px;
            font-size: 17px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;

        }

        .navbar li {
            margin-right: 20px;
        }
 
        .navbar a {
            text-decoration: none;
            color: #5c5c5c;
        }

        .navbar a:hover {
            text-decoration: underline;
            color: #FDB10E;
        }

        .icons {
            display: flex;
            align-items: center;
            position: relative;
        }

        .icons a {
            margin-right: 20px;
            text-decoration: none;
            color: #333;
        }

        .dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            display: none;
        }

        .dropdown a {
            padding: 10px;
            text-decoration: none;
            display: block;
            color: #333;
        }

        .dropdown a:hover {
            background-color: #f1f1f1;
        }

        .logo {
            margin-left: 110px;
                   margin-right: 80px;
        }
        .profile-name{
            margin-right: 30px;
            margin-left: -300px;
        }
    </style>
</head>

<body>
    <!-- Your existing HTML content -->
    <header class="header">

        <h1><a class="logo" href="home.php"><img src="images/cravecrisp.png" width="90" height="60" alt="Home.php"></a></h1>
        <ul class="navbar">
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <div class="icons">
            <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
            ?>
            <a href="search.php"><i class="fas fa-search"></i></a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
            <i class="fas fa-user" id="profileIcon"></i>
           


            <div class="dropdown" id="userDropdown">
                <?php
                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile->execute([$user_id]);
                if ($select_profile->rowCount() > 0) {
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                    <a href="profile.php">Profile</a>
                    <a href="components/user_logout.php" onclick="return confirm('Logout from this website?');">Logout</a>
                <?php
                } else {
                ?>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                <?php
                }
                ?>
            </div>
            <div class="dropdown" id="menuDropdown">
                <!-- Add your menu items here -->
            </div>
        </div>
        <div class="profile">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if ($select_profile->rowCount() > 0) {
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
                <!-- Add your profile content here -->
            <?php
            } else {
            ?>
                <!-- Add content for users who are not logged in -->
            <?php
            }
            ?>
        </div>
        <div class="profile-name">
        <?php if (!empty($fetch_profile['name'])) {
                // Access the 'name' element of $fetch_profile
                echo $fetch_profile['name'];
            } 
            ?></div>
    </header>

    <!-- Your page content here -->

    <!-- Add your JavaScript code to toggle dropdowns -->
    <script>
        var profileIcon = document.getElementById('profileIcon');
        var userDropdown = document.getElementById('userDropdown');

        profileIcon.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent the body click event from closing the dropdown
            if (userDropdown.style.display === 'block') {
                userDropdown.style.display = 'none';
            } else {
                userDropdown.style.display = 'block';
            }
        });

        // Close the dropdown when clicking outside of it
        document.body.addEventListener('click', function() {
            if (userDropdown.style.display === 'block') {
                userDropdown.style.display = 'none';
            }
        });
    </script>
</body>

</html>