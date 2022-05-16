let appHeader = `
    <div id="side-nav">
        <ul>
            <li><span class="closeNav" onclick="closeNav()">&#10006</span></li>
            <li><a href="../html/homepage.html">Home</a></li>
            <li><a href="../html/forum.html">Forum</a></li>
            <li><a href="../html/learn-more.html">Learn More</a></li>
            <li><a href="../html/contact.html">Help</a></li>
        </ul>
    </div>
    
    <div class="icon-nav">
        <div class="phone-nav">
            <button class="nav-btn" onclick="openNav()">
                <span class="menu-icon">&#9776;</span>
<!--                <ion-icon class="menu-icon" name="menu-outline"></ion-icon>-->
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
            <li class="navigation-list-item"><a href="../html/contact.html">Help</a></li>
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
    
`;

if (window.location.pathname.split("/").pop() === "log_in.html") {
    appHeader += `<div class="btn-container">
        <a href="../html/sign_up.php" class="btn btn-acc">Sign Up</a>
    </div>`
} else {
    appHeader += `<div class="btn-container">
        <a href="../html/log_in.html" class="btn btn-acc">Log In</a>
    </div>`
}

document.getElementById("page-header").innerHTML = appHeader;