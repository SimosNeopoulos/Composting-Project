<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/log-in-style.css">
    <link rel="stylesheet" href="../css/general.css">
    <title>Composting Log In</title>
    <link rel="shortcut icon" href="../images/composting200.png">
</head>
<body>

<!------------ HEADER ------------->
<?php require("../php/header.php")?>

<!-- <script defer src="../javascript/header.js"></script> -->
<!--------------------------------->

<!------------- MAIN CONTAINER -------------->
<div class="form-container container-height">
    <h1 class="top-text">Log In</h1>
    <form method="post">
        <!-------- INPUT FIELDS --------->
        <div class="input-field">
            <input type="email" placeholder=" " id="log-in-email" required>
            <span></span>
            <label for="log-in-email">Email</label>
        </div>

        <div class="input-field">
            <input type="password" placeholder=" " id="log-in-password" required>
            <span></span>
            <label for="log-in-password">Κωδικός</label>
        </div>
        <!--------------------------------->

        <!-- FORGOT PASSWORD LINK -->
        <div class="forgot-pass"><a href="#">Forgot your Password?</a></div>
        <!-------------------------->

        <!---------- SUBMIT BUTTON ----------->
        <div class="btn-space">
            <button onclick="logInClick()" name="submit-btn" type="submit" class="submit-btn">
                Log In
            </button>
        </div>
        <!--------------------------------->

        <!-- SIGN UP LINK -->
        <div class="sign-up-text">Δεν έχεις λογαριασμό? <a
                href="sign_up.php">Sign Up!</a>
        </div>
        <!------------------>
    </form>
</div>
<!---------------------------------------->

<script type="text/javascript" src="../javascript/script.js"></script>
</body>
</html>