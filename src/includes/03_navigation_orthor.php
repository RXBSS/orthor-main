<?php

/**
 * ### Navigation
 * 
 * Die Navigation besteht aus mehreren Teilen: 
 * 
 * 1. Navbar 
 * 1.1 Logo -> Das Logo des Systems
 * 1.2 Page Title -> Seitentitel aus der Page Variable
 * 1.3 Actions -> Actions
 * 
 * 2. Breadcrumbs -> Navigation aus der Page Variable
 * 
 * 3. Sidebar
 * 3.1 User -> Leiste für den eingeloggten Benutzer
 * 3.2 Default Navigation -> Bringt eine Standard Funktion für ein ArrayToNav mit
 * 3.3 Version
 * 
 */
?>

<!-- 1. Navbar -->
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid justify-content-start align-items-center">


        <!-- 1.1 Logo -->
        <div id="navbar-banner" class="navbar-brand" style="min-width: 258px;">
            <div class="d-flex align-items-center">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;" width="50px" height="50px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                        <circle cx="30" cy="50" fill="#7ab929" r="20">
                            <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="-0.7246376811594202s"></animate>
                        </circle>
                        <circle cx="70" cy="50" fill="#ffffff" r="20">
                            <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="0s"></animate>
                        </circle>
                        <circle cx="30" cy="50" fill="#7ab929" r="20">
                            <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="-0.7246376811594202s"></animate>
                            <animate attributeName="fill-opacity" values="0;0;1;1" calcMode="discrete" keyTimes="0;0.499;0.5;1" dur="1.4492753623188404s" repeatCount="indefinite"></animate>
                        </circle>
                    </svg>
                </div>

                <div>
                    <a href="index.php"><strong>ORTHOR</strong></a>
                </div>
            </div>
        </div>

        <!-- 1.2 Title -->
        <?php include('includes/01_nav_title.php'); ?>


        <!-- 1.3 Actions-->
        <div class="navbar-action-container d-flex btn-group">
            <?php include('includes/02_nav_actions.php'); ?>
        </div>


    </div>
</nav>

<!--  2. Breadcrumbs -->
<?php include('includes/03_nav_breadcrumbs.php'); ?>

<!-- 3. Sidebar -->
<aside class="sidebar text-white" id="main-navigation">

    <div class="sidebar-inner d-flex flex-column">

        <!-- 3.1 User Login -->
        <?php include('includes/04_nav_user_login.php'); ?>

        <ul class="list-unstyled nav-autoclose">

            <!-- Home Icon -->
            <li class="mb-2">
                <a href="index.php" class="btn btn-toggle"><i class="fa-solid fa-home"></i> Home</a>
            </li>

            <!-- 3.2 Default Navigation -->
            <?php include('includes/05_nav_default_nav.php'); ?>

        </ul>

        <!-- 3.3 Version -->
        <?php include('includes/06_nav_version.php'); ?>

        <div class="sidebar-toggler">
            <a href="javascript:void(0);">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>

    </div>

</aside>