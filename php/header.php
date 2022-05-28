<?php
?>
<header id="page-header">
    <div id="side-nav">
            <ul>
                <li><span class="closeNav" onclick="closeNav()">&#10006</span></li>
                <li><a href="../html/homepage.html">Home</a></li>
                <li><a href="../html/forum.html">Forum</a></li>
                <li><a href="../html/learn-more.html">Learn More</a></li>
                <li><a href="../html/contact.php">Help</a></li>
            </ul>
    </div>
    
    <div class="icon-nav">
        <div class="phone-nav">
            <button class="nav-btn" onclick="openNav()">
                <span class="menu-icon">&#9776;</span>
            </button>
        </div>
    
        <div class="logo-container">
            <a class="logo" href="../html/homepage.html">
                <img src="../images/composting.png" alt="search icon">
            </a>
        </div>
    </div>

    <nav class="navigation">
        <ul class="navigation-list">
            <li class="navigation-list-item"><a href="../html/homepage.html">Home</a></li>
            <li class="navigation-list-item"><a href="../html/forum.html">Forum</a></li>
            <li class="navigation-list-item"><a href="../html/learn-more.html">Learn More</a></li>
            <li class="navigation-list-item"><a href="../html/contact.php">Help</a></li>
        </ul>
    </nav>

    <div class="search-box">
        <table class="elementsContainer">
            <tr>
                <td>
                    <input type="text" class="search" placeholder="Search">
                </td>
                <td>
                    <button type="submit" class="searchIcon"><img src="../images/search-icon.png" alt="search icon">
                    </button>
                </td>
            </tr>
        </table>
    </div>

    <?php
    // If the user has logged in the site a "My Account" button is displayed in the nav bar
    $filePath = explode("/", $_SERVER['PHP_SELF']);
    $headerLocation = array_pop($filePath);
    if(isset($_SESSION["user"])):
    ?>
    <div class="btn-container">
        <a href="../html/personal-info-page.php" class="btn btn-acc">My Account</a>
    </div>

    <!-- If the user has not logged in the site and is currently in the "sign_up.php" page a "Log In" button is displayed in the nav bar -->
    <?php elseif($headerLocation == "sign_up.php"): ?>

    <div class="btn-container">
        <a href="../html/log_in.php" class="btn btn-acc">Log In</a>
    </div>
    
    <!-- If the user has not logged in the site and is currently in any other page other than "sign_up.php"  a "Sign Up" button is displayed in the nav bar -->
    <?php else:?>
    <div class="btn-container">
        <a href="../html/sign_up.php" class="btn btn-acc">Sign Up</a>
    </div>
    <?php endif; ?>

    </header>