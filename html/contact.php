<?php
include("../php/functions.php");
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/contact-style.css">
    <title>Composting Contact Page</title>
    <link rel="shortcut icon" href="../images/composting200.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<!------------ HEADER ------------->
<?php require("../php/header.php")?>
<!--------------------------------->

<!------------- MAIN CONTAINER -------------->
<div class="form-container container-height">
    <h1 class="contact-text">Ποιό είναι το πρόβλημα;</h1>
    <form action="../php/contact-email.inc.php" id="contact-form" method="post">
        <!-------- INPUT FIELDS --------->
        <div class="input-field">
            <input type="text" placeholder=" " name="contact-name" id="contact-name" required>
            <span></span>
            <label for="contact-name">Ονοματεπώνημο</label>
        </div>

        <div class="input-field">
            <input type="email" placeholder=" " name="contact-email" id="contact-email" required>
            <span></span>
            <label for="contact-email">Email</label>
        </div>

        <div class="input-field">
            <input type="text" placeholder=" " name="contact-subject" id="contact-subject" required>
            <span></span>
            <label for="contact-subject">Θέμα</label>
        </div>

        <div class="input-field-message">
            <textarea placeholder=" " name="contact-message" id="contact-message" required></textarea>
            <label for="contact-message">Μήνυμα</label>
        </div>
        <!--------------------------------->
	<?php if (isset($_POST["reset"])) {
            if ($_POST["reset"] == "success") { ?>
                <div class="information-text">
                    <p class="info-text"><strong><center>Ευχαριστούμε για το μήνυμα σας.</center></strong></p>
                </div>
            <?php } ?>
        <?php } ?>
        <!---------- SUBMIT BUTTON ----------->
        <div class="btn-space">
            <button name="submit-btn" type="submit" class="submit-btn">
                Send
            </button>
        </div>
        <!--------------------------------->
    </form>
</div>
<!---------------------------------------->


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

<script type="text/javascript" src="../javascript/script.js"></script>
</body>
</html>