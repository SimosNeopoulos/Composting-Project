<?php
    include("../php/functions.php");  
?>    


<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/homepage-style.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Homepage</title>
    <link rel="shortcut icon" href="../images/composting200.png">
</head>
<body>
    
<?php
    require("../php/header.php");
?>


<div class="homepage-container">
    <img class="image" src="../images/holding_plant.jpg" alt="holding plat image">
    <b class="title">Ποιοι είμαστε;</b>
    <div class="subtitle">Είμαστε μία ομάδα τεσσάρων φοιτητών με μεγάλο ενδιαφέρον για το περιβάλλον και αυτή η
        ιστοσελίδα έχει δημιουργηθεί στα πλαίσια εργασίας για το μάθημα Πληροφοριακά Συστήματα Παγκόσμιου Ιστού.
    </div>
    <button class="read-more" onclick="scrollToBottom()">Μαθε περισσοτερα!</button>
</div>

<div class="join-us">
    <img class="join-us-image" src="../images/join%20us.jpg" alt="join us image">
    <b class="join-us-title">Κάνε εγγραφή για να γίνεις κι εσύ μέλος της κοινότητας που αγαπάει το περιβάλλον!</b>
    <button class="join-btn" onclick="window.location.href = 'sign_up.php'">Γινε μελος!</button>
</div>

<div class="info">
    <div class="info-preview">
        <div class="info-left">
            <div class="info-img-left-container">
                <img class="info-img-left " src="../images/compost.jpg" alt="info image compost">
            </div>
            <div class="left-text">
                <b class="ingredients-title">Κομποστοποιήσιμα υλικά:</b>
                <ul class="ingredients-list">
                    <li>Φρούτα και λαχανικά</li>
                    <li>Φακελάκια τσαγιού</li>
                    <li>Τσόφλια αυγών και ξηρών καρπών</li>
                    <li>Χαρτί κουζίνας</li>
                    <li>Φύλλα</li>
                    <li>Κλαδιά και φλοιοί θάμνων και δέντρων</li>
                </ul>
            </div>
        </div>
        <div class="info-right">
            <div class="info-img-right-container">
                <img class="info-img-right" src="../images/shovel.jpg" alt="info image shovel">
            </div>
            <div class="right-text">
                <b class="steps-title">Βασικά βήματα κομποστοποίησης:</b>
                <ol class="steps-list">
                    <li>Διάλεξε κάδο κομποστοποίησης</li>
                    <li>Βρες το κατάλληλο σημείο</li>
                    <li>Διάλεξε κατάλληλα υλικά</li>
                    <li>Πρόσθεσε χώμα</li>
                    <li>Ανακάτευε συχνά</li>
                </ol>
                <button class="btn-more-info" onclick="window.location.href = '../html/learn-more.html'">Μαθε
                    περισσοτερα
                </button>
            </div>
        </div>
    </div>
</div>

<?php include("../php/footer.php") ?>

<script type="text/javascript" src="../javascript/script.js"></script>
</body>
</html>
<script>
    function scrollToBottom() {
        window.scrollTo({top: document.body.scrollHeight, behavior: 'smooth'});
    }

    history.scrollRestoration = "manual";
</script>