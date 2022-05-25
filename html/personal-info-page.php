<?php
    include("../php/connect.php");
    include("../php/functions.php");   
    
?>


<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="../css/personal-info-style.css">
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <link rel="shortcut icon" href="../images/composting200.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Composting!</title>
    
</head>
<body>



<header id="page-header"></header>
<div class="container">

    <!--Profile pic box-->
    <div class="profile_pic">
        <img class="picture" src="../images/profile-circle.png" alt="profile image!">
        <div class="edit">
            <h3 id="edit-text"> Νεα εικόνα προφίλ;</h3>
            <input type="file" id="image-upload" accept="image/*">
            <label for="image-upload"><img id="edit-icon" src="../images/edit-icon.png" alt="click hear to edit"></label>
        </div>

    </div>

    <!--Profile info box-->
    <div class="profile_info">
        <div class="title">
            <h1 id="profile-header">Καλωσόρισες στο προφίλ σου!</h1>
        </div>


        <div class="user-data-fields">
            <label>Όνομα χρήστη</label>
            <input type="text" placeholder="Username" value="<?php displayName(); ?>">

        </div>
        <div class="user-data-fields">
            <label> Email</label>
            <input type="text" placeholder="Email" value="<?php displayEmail(); ?>">


        </div>
        <div class="user-data-fields">
            <label>Διεύθυνση</label>
            <input type="text" placeholder="Address" value="<?php dipslayAddress(); ?>">

        </div>
        <div class="user-data-fields">
            <label>Κωδικός πρόσβασης </label>
            <input type="password" placeholder="Password" value="<?php displayPassword(); ?>">

        </div>
        <div class="user-data-fields">
            <label>Τηλέφωνο</label>
            <input type="tel" placeholder="69-99999999" pattern="69-[0-9]{8}" required value="<?php displayTelephone(); ?>">

        </div>


        <div class="save-button">
            <button id="save" type="button" name="save-button">
                Αποθήκευση
            </button>
        </div>

        <div class="links-container">
            <div class="links">
                <img class="link-icons" src="../images/save_icon.png" alt="Posts!">
                <a class="posts" href=""> Τα ποστ μου</a>
            </div>
            <div class="links">
                <img class="link-icons" src="../images/push_pin.png" alt="Saved!">
                <a class="posts" href="">Αποθηκευμένα ποστ</a>
            </div>
            <div class="links">
                <img class="link-icons" src="../images/logout-icon.png" alt="Logout!">
                <a class="posts" href="../php/logout.php" title="logout">Αποσύνδεση</a>
            </div>
        </div>

    </div>
</div>

<footer>
    <div class="footer-content">
        <h3><b>Composting</b></h3>
        <p>You can also find us on our social media!</p>
        <ul class="socials">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
        </ul>
    </div>
    <div class="footer-bottom">
        <p>copyright &copy;2022 composting</p>
    </div>
</footer>

<!--header script-->
<script defer src="../javascript/header.js"></script>
<script type="text/javascript" src="../javascript/script.js"></script>
<script type="text/javascript" src="../javascript/personal-info.js"></script>

</body>
</html>




