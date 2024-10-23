<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        /* Reset some default styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }


        .header {
            background-color: white;
            color: #5c5c5c;
            width: 100%;
            height: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .header .flex {
            display: flex;
            align-items: center;
        }

        .header .logo {
            margin-left: 170px;
            margin-right: 80px;
            font-size: 24px;
            text-decoration: none;
            color: #333;
        }

        .header .logo span {
            color: #FDB10E;
        }


        .header .navbar a {
            text-decoration: none;
            color: #5c5c5c;
            margin-left: 30px;
        }

        .header .navbar a:hover {
            text-decoration: underline;
        }


        .header .btn:hover {
            background-color: #D00000;
        }

        .profile {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-left: 30px;
        }

        .flexbtn .flexbtnn,
        .icons {

            margin-left: 30px;
        }

        .navbar {
            margin-right: 70px;
        }
    </style>
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
          <div class="message">
             <span>' . $message . '</span>
             <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
          </div>
          ';
        }
    }
    ?>

    <header class="header">
        <section class="flex">
            <a href="dashboard.php" class="logo">Admin<span>Panel</span></a>
            <nav class="navbar">
                <a href="dashboard.php">home</a>
                <a href="products.php">products</a>
                <a href="placed_orders.php">orders</a>
                <a href="admin_accounts.php">admins</a>
                <a href="users_accounts.php">users</a>
                <a href="messages.php">messages</a>
            </nav>


            <div class="icons">
            <a href="admin_accounts.php"> <div id="user-btn" class="fas fa-user"></div> </a>
            </div>
            <div class="profile">
                <?php
                $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
                $select_profile->execute([$admin_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                 <a href="admin_accounts.php"><p><?= $fetch_profile['name']; ?></p></a>
                <div class="flexbtn">
                    <a class="flexbtnn" href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>

                </div>
            </div>
        </section>
    </header>
</body>

</html>