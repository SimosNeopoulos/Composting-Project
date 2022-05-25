<?php
include("../php/functions.php");
include("../php/connect.php");

$serverError = false;
$nameTaken = false;
$emailTaken = false;
do {
    if(isset($_POST['submit-btn'])) {
        $nameTaken = nameExists($conn, $_POST['username']);
        if($nameTaken === null || $nameTaken) {
            break;
        }

        $emailTaken = emailExists($conn, $_POST['email']);
        if($emailTaken === null || $emailTaken) {
            break;
        }
        
        if(signUp($conn, $_POST["username"], $_POST["email"], $_POST["address"], $_POST["password"], $_POST["telephone"])) {
            mysqli_close($conn);
            header('Location: ../html/homepage.html');
        }
    }
} while(false)

?>

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

<!------------- MAIN CONTAINER -------------->
<div class="form-container container-height">
    <h1 class="top-text">Sign Up</h1>
    <form method="post" id="sign-up-form" action="sign_up.php">
        <!-------- INPUT FIELDS --------->
        <div class="input-field">
            <input type="text" name="username" placeholder=" " id="sign-up-username" required>
            <span></span>
            <label for="sign-up-username">Όνομα Χρήστη</label>
        </div>

        <div class="input-field">
            <input type="email" name="email" placeholder=" " id="sign-up-email" required>
            <span></span>
            <label for="sign-up-email">Email</label>
        </div>

        <div class="input-field">
            <input type="text" name="address" placeholder=" " id="sign-up-address" required>
            <span></span>
            <label for="sign-up-address">Διεύθυνση</label>
        </div>

        <div class="input-field">
            <input type="password" name="password" placeholder=" " id="sign-up-password" required>
            <span></span>
            <label for="sign-up-password">Κωδικός</label>
        </div>

        <div class="input-field">
            <input type="tel" name="telephone" placeholder=" " id="sign-up-tel">
            <span></span>
            <label for="sign-up-tel">Τηλέφωνο</label>
        </div>
        <!--------------------------------->

        <!---------- SUBMIT BUTTON ----------->
        <div class="btn-space">
            <button name="submit-btn" type="submit" class="submit-btn">
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
<?php
if($nameTaken) {
    echo "<script>function warning() { alert('To username χρησιμοποιείτε ήδη!'); } warning();</script>";
}
if($emailTaken) {
    echo "<script>function warning() { alert('To email χρησιμοποιείτε ήδη!'); } warning();</script>";
}
if($serverError) {
    echo "<script>function warning() { alert('Υπήρξε πρόβλημα με τον server'); } warning();</script>";
}
$serverError = false;
$nameTaken = false;
$emailTaken = false;
?>
</html>
