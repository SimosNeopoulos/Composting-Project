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
        <h1 class="top-text">Reset Password</h1>
        <form action="../include(php)/reset-request.inc.php" id="forgot-password-form" method="post">
            <div class="information-text">
                <p class="info-text">An e-mail will be send to you with instructions on how to reset your password.</p>
            </div>
            <form action="includes/reset-request.inc.php" method="post">
                <!-------- INPUT FIELDS --------->
                <div class="input-field">
                    <input type="text" placeholder=" " name="forgot-password-email" id="forgot-password-email" required>
                    <span></span>
                    <label for="forgot-password-email">Email</label>
                </div>
                <?php
                    if (isset($_GET["reset"])) {
                        if ($_GET["reset"] == "success") {
                            echo "gg wp";
                        }
                    }
                ?>
                <!---------- SUBMIT BUTTON ----------->
                <div class="btn-space">
                    <button name="submit-btn" type="submit" class="submit-btn">Continue</button>
                </div>
                <!--------------------------------->
            </form>
        </form>
    </div>
</body>