<?php
include("../php/functions.php");
include("../php/connect.php");

$serverError = false;
$passwordIncorrect = false;
do{
    if(isset($_POST['submit-btn'])) {
        $loggedIn = authenticate($conn, $_POST['email'], $_POST['password']);
        if($loggedIn === null) {
            $serverError = true;
            break;
        }

        if(!$loggedIn) {
            $passwordIncorrect = true;
            break;
        }
        if($loggedIn)
            header("Location: ../html/homepage.html");
    }
}while(false)

?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/log-in-style.css">
    <link rel="stylesheet" href="../css/general.css">
    <title>Composting Log In</title>
    <link rel="shortcut icon" href="../images/composting200.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<!------------ HEADER ------------->
<?php //unset($_SESSION['user']); ?>
<?php require("../php/header.php")?>



<!-- <script defer src="../javascript/header.js"></script> -->
<!--------------------------------->

<!------------- MAIN CONTAINER -------------->
<div class="form-container container-height">
    <h1 class="top-text">Log In</h1>
    <form action="#" id="log-in-form" method="post">
        <!-------- INPUT FIELDS --------->
        <div class="input-field">
            <input type="email" name="email" placeholder=" " id="log-in-email" required>
            <span></span>
            <label for="log-in-email">Email</label>
        </div>

        <div class="input-field">
            <input type="password" placeholder=" " name="log-in-password" id="log-in-password" required>
            <i class="fa fa-eye" aria-hidden="true" id="eye" onclick="toggle()"></i>
            <span></span>
            <label for="log-in-password">Κωδικός</label>
        </div>
        <!--------------------------------->

        <!-- FORGOT PASSWORD LINK -->
        <div class="forgot-pass"><a href="forgot-password.php">Forgot your Password?</a></div>
        <!-------------------------->

        <!---------- SUBMIT BUTTON ----------->
        <div class="btn-space">
            <button name="submit-btn" type="submit" class="submit-btn">
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
<?php
if($passwordIncorrect) {
    echo "<script>function warning() { alert('Λάθος κωδικός ή email!'); } warning();</script>";
}
if($serverError) {
    echo "<script>function warning() { alert('Παρουσιάστηκε πρόβλημα με τον server'); } warning();</script>";
}
$serverError = false;
$passwordIncorrect = false;
?>
</html>
