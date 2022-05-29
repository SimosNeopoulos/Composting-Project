<?php
include("../php/functions.php");
include("../php/connect.php");

// Veriables that indicate if there was a problem with the user singing up.
// An appropriate error message is shown if there was a problem
$serverError = false;
$nameTaken = false;
$emailTaken = false;
do {
    // Checking if the user submited any data
    if(isset($_POST['submit-btn'])) {
        //Checking if the username the user submited already exists in the database
        $nameTaken = nameExists($conn, $_POST['username']);
        // The name already exists or there was an error in the database
        if($nameTaken === null || $nameTaken) {
            $emailTaken = true;
            break;
        }

        //Checking if the email the user submited already exists in the database
        $emailTaken = emailExists($conn, $_POST['email']);
        // The email already exists or there was an error in the database
        if($emailTaken === null || $emailTaken) {
            $emailTaken = true;
            break;
        }
        
        // Adding the user data to the database and signing them in the site
        if(signUp($conn, $_POST["username"], $_POST["email"], $_POST["address"], $_POST["password"], $_POST["telephone"])) {
            mysqli_close($conn);
            header('Location: ../html/homepage.php');
        } else {
            $serverError = true;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <i class="fa fa-eye" aria-hidden="true" id="eye" onclick="toggleSignup()"></i>
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
