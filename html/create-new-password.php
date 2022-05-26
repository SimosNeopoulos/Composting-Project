<?php

?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/forgot-password.css">
    <link rel="stylesheet" href="../css/general.css">
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

        if (empty($selector) || empty($validator)) {
            echo "Could not validate your request!";
        } else {
            // checking if legit tokens
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) { // valid
                ?>

                <form action="includes/reset-password.inc.php" method="post">
                    <!-------- INPUT FIELDS --------->
                    <div class="input-field">
                        <input type="hidden" name="selector" value="<?php echo $selector ?>">
                        <input type="hidden" name="selector" value="<?php echo $selector ?>">
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
                        <div class="btn-space">
                            <button name="reset-password-submit" type="submit" class="submit-btn">Submit password</button>
                        </div>
                    </div>
                </form>

                <?php
            }
        }
    ?>