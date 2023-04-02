<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>
    <!-- remove any custom browser styles -->
    <link rel="stylesheet" href="css/normalize.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="css/app.css" />

    <script src="js/scripts.js" defer></script>
</head>
<body>
    <header>
        <h1>
            <a href="index.php?pageId='Home'">Assignment 2</a>
        </h1>
        <nav>
            <ul>
                
                <?php
                //connect to the database and run the validated sql command
                require('includes/db.php');
                $sql="SELECT * FROM pages";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $pages=$cmd->fetchAll();

                foreach($pages as $page){
                    echo '<li>
                        <a href="index.php?pageId=' . $page['pageId'] .'">'. $page['pageName'].'</a>
                        </li>';
                }

                // access the current session
                if (session_status() == PHP_SESSION_NONE) {
                    session_start(); 
                }
                
                if (empty($_SESSION['user'])) {
                ?>
                    
                    <li>
                        <a href="register.php">Register</a>
                    </li>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                <?php
                }
                else {
                ?>
                    <li>
                        <a href="page-list.php">Pages</a>
                    </li>
                    <li>
                        <a href="user-list.php">Users</a>
                    </li>
                    <li>
                        <a href="#"><?php echo $_SESSION['user'] ?></a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </header>