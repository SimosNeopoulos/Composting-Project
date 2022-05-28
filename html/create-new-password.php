<?php

?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/create-new-password.css">
    <title>Composting Log In</title>
    <link rel="shortcut icon" href="../images/composting200.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!------------ HEADER ------------->
    <header id="page-header"></header>
    <script defer src="../javascript/header.js"></script>
    <!--------------------------------->
    <!------------- MAIN CONTAINER -------------->
    <div class="form-container container-height">
    <?php
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];
        $emailUser = $_GET["email"];

        if (empty($selector) || empty($validator)) {
            echo "Could not validate your request! This website only opens by email letter";
        } else {
            // checking if legit tokens
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) { ; // valid
            ?>
                <center><h5 class="top-text">Reset your password here!</h5></center>
                <form method="post" action="../include(php)/reset-password.inc.php" id="create-new-pass-form">
                    <!-------- INPUT FIELDS --------->
                        <input type="hidden" name="selector" value="<?php echo $selector ?>">
                        <input type="hidden" name="validator" value="<?php echo $validator ?>">
                        <input type="hidden" name="email" value="<?php echo $emailUser ?>">
                        <div class="input-field">
                            <input type="password" placeholder=" " name="new-password" id="forgot-password-email" required>
                            <span></span>
                            <label for="forgot-password-email">Enter a new password</label>
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder=" " name="new-password-repeat" id="forgot-password-email" required>
                            <span></span>
                            <label for="forgot-password-email">Repeat new password</label>
                        </div>
                        <?php
                        if (isset($_GET["newpwd"])) {
                            if ($_GET["newpwd"] == "passwordupdated") { ?>
                                <div class="information-text">
                                    <p class="info-text"><strong><center>Your password has changed!</center></strong></p>
                                </div>
                            <?php } elseif ($_GET["newpwd"] == "notsame") { ?>
                                <div class="information-text">
                                    <p class="info-text"><strong><center>Please put the same password!</center></strong></p>
                                </div>
                            <?php } elseif ($_GET["newpwd"] == "incorrect") { ?>
                                <div class="information-text">
                                    <p class="info-text"><strong><center>Password must be 6-16 characters long and contain at least one 
                                        numeric and special character !@#$%^&*</center></strong></p>
                                </div>
                            <?php } } ?>
                        <div class="btn-space">
                            <button name="reset-password-submit" type="submit" class="submit-btn">Submit password</button>
                        </div>
                </form>

                <?php ;
            } 
        }
    ?>