<?php
  include('inc/contants.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato&display=swap">
    <link rel="stylesheet" href="style.css" /  >
</head>

<body>
    <header>
        <!-- <div id="header">
            <div id="top" class="container-fluid">
                <div id="logo">
                    // <img src="logo.png" alt"logo"> 
                    Resume Maker
                </div>
                <div id="toplink">


                </div>
                <div class="clear"></div>
            </div>
            <div id="nav">
                <div class="container-fluid">
                    <a href="index.php" class="active">Home</a>
                    <a href="about.php">About</a>
                    <a href="contact.php">Contact</a>
                    <a href="services.php">Services</a>
                </div>
                <div class="clear"></div>
            </div>
        </div> -->

        <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Resume Builder</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo BASEURL; ?>index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASEURL; ?>about.php">About US</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASEURL; ?>contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASEURL; ?>services.php">Services</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav  mb-2 mb-lg-0">
                        <?php
                        if (isset($_SESSION['user'])) {
                            // echo "<a href='account.php' class='btn-top'>My Account</a>";
                            // echo "<a href='logout.php' class='btn-top'>Logout</a>";
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="account.php">My Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="signup.php">Sign Up</a>
                            </li>
                            <!-- <a href="login.php" class="btn btn-primary">Login </a>
                        <a href="signup.php" class="btn btn-primary">Sign Up</a> -->
                        <?php
                        }
                        ?>
                    </ul>
                    <!-- <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> -->
                </div>
            </div>
        </nav>
    </header>