<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/sign-up-style.css">
    <link rel="stylesheet" href="../css/general.css">
    <title>Composting Sign Up</title>
    <link rel="shortcut icon" href="../images/composting200.png">
</head>
<body>

<!------------ HEADER ------------->
<?php require("../php/header.php")?>

<!-- <script defer src="../javascript/header.js"></script> -->
<!--------------------------------->

<!------------- MAIN CONTAINER -------------->
<div class="form-container container-height">
    <h1 class="top-text">Sign Up</h1>
    <form method="post">
        <!-------- INPUT FIELDS --------->
        <div class="input-field">
            <input type="text" placeholder=" " id="sign-up-username" required>
            <span></span>
            <label for="sign-up-username">Όνομα Χρήστη</label>
        </div>

        <div class="input-field">
            <input type="email" placeholder=" " id="sign-up-email" required>
            <span></span>
            <label for="sign-up-email">Email</label>
        </div>

        <div class="input-field">
            <input type="text" placeholder=" " id="sign-up-address" required>
            <span></span>
            <label for="sign-up-address">Διεύθυνση</label>
        </div>

        <div class="input-field">
            <input type="password" placeholder=" " id="sign-up-password" required>
            <span></span>
            <label for="sign-up-password">Κωδικός</label>
        </div>

        <div class="input-field">
            <input type="tel" placeholder=" " id="sign-up-tel">
            <span></span>
            <label for="sign-up-tel">Τηλέφωνο</label>
        </div>
        <!--------------------------------->

        <!---------- SUBMIT BUTTON ----------->
        <div class="btn-space">
            <button onclick="signUpClick()" name="submit-btn" type="button" class="submit-btn">
                Sign Up
            </button>
        </div>
        <!--------------------------------->

        <!-- LOG IN LINK -->
        <div class="log-in-text">Έχεις Λογαριασμό? <a href="log_in.php">Log In!</a></div>
        <!----------------->

    </form>
</div>

<script type="text/javascript" src="../javascript/script.js"></script>

</body>
</html>
