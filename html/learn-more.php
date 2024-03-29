<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <link rel="stylesheet" type="text/css" href="../css/learn-more-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Composting!</title>
    <link rel="shortcut icon" href="../images/composting200.png">

</head>
<body>

<?php
    require("../php/header.php");
?>



<div class='top-part'>
    <img class='top-part-image' src="../images/soil.jpg" alt="Green Branches over your head">


    <div class="about-composting-box">
        <h5>Τι είναι το Composting;</h5>
        <p>Αυτή είναι μια ιστοσελίδα για ελεύθερη ανταλλαγή κομποστοποιημένων και κομποστοποιήσιμων υλικών. Θες να
            ξεκινήσεις; Πήγαινε στο forum για να συζητήσεις με την κοινότητα.</p>
    </div>
    <div class="what-is-composting-box">
        <h5>Τι είναι όμως η κομποστοποίηση;</h5>
        <p>Για αυτούς που αναρωτιούντε η Βικιπαίδια μας λέει: <q>Η κομποστοποίηση είναι μια φυσική διαδικασία η οποία
            μετατρέπει τα οργανικά υλικά σε μια πλούσια σκούρα ουσία. Αυτή η ουσία λέγεται κομπόστ ή χούμος ή
            εδαφοβελτιωτικό. </q><br> Με απλά λόγια είναι ένα εύκολος τρόπος μετατροπής των οργανικών απορριμμάτων της
            κουζίνας μας σε λίπασμα για τις γλάστρες στο μπαλκόνι και τον κήπο. Παρακάτω σας δίνουμε μερικά tips για να
            ξεκικήσετε στο σπίτι.</p>
    </div>

</div>

<div class="card">
    <div class="card-body">
        <!-- First empty space -->
    </div>
</div>

<!-- first section / information part -->
<div class="container-fluid">
    <div class="row info">

        <!-- left section of information part -->
        <div class="col-sm-8 col-md-8">
            <div class="row">

                <!-- flower icon -->
                <div class="col-sm-4 col-md-3 ">
                    <img class="flower" src="../images/flower.png" alt="A flower for you!">
                </div>

                <!-- here are the information about composting -->
                <div class="col-sm-8 col-md-9 ">
                    <h3 class="info-header">Κομποστοποίηση στο σπίτι, δηλαδή τι κάνω;</h3>
                    <p class="info-text"> Πριν σας δώσουμε τα βήματα ας μιλήσουμε λίγο για τα βασικά συστατικά της σωρού
                        κομποστοποίησης που θα φτιάξουμε.</p>
                    <p class="info-text"><b>Χρειαζόμαστε</b>: </p>
                    <ul class="info-text">
                        <li><b id="bold">Κάδο κομποστοποίησης </b>- μπορείτε να τον προμηθευτείτε από καταστήματα, μέσω
                            ίντερνετ ή και από τον Δήμο σας εφόσον υπάρχει αντίστοιχο πρόγραμμα
                        </li>
                        <li><b>Μερικά τετραγωνικά μέτρα</b> ελεύθερης γης για να τοποθετηθεί ο κάδος</li>
                        <li><b>Πράσινα υλικά </b>- πλούσια σε άζωτο (χλωρά φύλλα, κομμένο γρασίδι, λουλούδια,
                            υπολείμματα φρούτων και λαχανικών υπολείμματα καφέ και τσαγιού, τσόφλια αβγών)
                        </li>
                        <li><b>Καφέ υλικά </b>- πλούσια σε άνθρακα (ξερά φύλλα, πριονίδι, άχυρο, χαρτί, χαρτόνι,
                            χαρτοπετσέτες σε μικρές ποσότητες, τεμαχισμένα κλαδιά)
                        </li>
                        <li><b>Αερισμός </b>- είναι απαραίτητος για την βιοαποδόμηση των οργανικών αποβλήτων.
                            Προτείνεται ανάδευση του σωρού μία φορά την εβδομάδα
                        </li>
                        <li><b>Υγρασία σε ελεγχόμενα επίπεδα </b>- αν η σωρός είναι πολύ ξηρή ποτίζουμε ελαφρά και
                            ανακατεύουμε, αν η σωρός είναι πολύ υγρή προσθέτουμε καφέ υλικά
                        </li>
                    </ul>

                    <p class="info-text"><b>Δεν χρειαζόμαστε </b> και πρέπει να τα αποφεύγουμε καθώς προσελκύουν
                        τρωκτικά και χαλούν την ποιότητα του κομπόστ: </p>
                    <ul class="info-text">
                        <li>Λίπη, λάδια, υπολείμματα μαγειρεμένου φαγητού, κόκκαλα, κρέας, ψάρια, γαλακτοκομικά
                            προϊόντα
                        </li>
                        <li>Στελέχη άρρωστων φυτών</li>
                        <li>Περιττώματα ζώων κ.ά. (παραπάνω πληροφορίες θα βρείτε στους παρακάτω συνδέσμους)</li>
                    </ul>
                    <p class="info-text"><b>Το κομπόστ είναι έτοιμο όταν</b> έχει σκούρο καφέ χρώμα, ευχάριστη μυρωδιά
                        χώματος και είναι εύθραυστο χωρίς να περιέχει κομμάτια υλικών που είχαν προστεθεί. Για να το
                        χρησιμοποιήσουμε αναμειγνύουμε με χώμα σε αναλογία 1:3 και τοποθετούμε στην βάση των φυτών μας.
                    </p>
                    <h3 class='info-header'>Οπότε ξεκινάμε; </h3>
                    <p class="info-text"><b>Βήμα 1.</b> Τοποθετούμε τον κάδο κομποστοποίησης.</p>
                    <p class="info-text"><b>Βήμα 2.</b> Στον πάτο του κάδου βάζουμε κλαδάκια, χαρτόνια ή άλλα
                        αντίστοιχου μεγέθους υλικά σχηματίζοντας ένα στρώμα 5 εκατοστών. Με αυτό το τρόπο η σωρός θα
                        αερίζεται πίο αποδοτικά.</p>
                    <p class="info-text"><b>Βήμα 3.</b> Προσθέτουμε τα καφέ υλικά και ποτίζουμε ελαυρά ώστε η σωρός να
                        είναι νωπή και να έχει οσμή υγρού χώματος. Προσοχή μην το παρακάνουμε.</p>
                    <p class="info-text"><b>Βήμα 4.</b> Προσθέτουμε τα <i>πράσινα υλικά</i> και καλύπτουμε με ενα στρόμα
                        χώματος από τον κήπο.</p>
                    <p class="info-text"><b>Βήμα 5.</b> Κάθε μία εβδομάδα αναδεύουμε το περιεχόμενο του κάδου ώστε να
                        αερίζεται σωστά και να επιταχύνεται η διαδικασία.</p>


                </div>
            </div>
        </div>

        <!-- right section of information part / image -->
        <div class="col-sm-4 col-md-4 image-info">
<!--            <img class='images' src="../images/veggies.jpg" alt="Some veggies that are good for composting!">-->
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <!-- Second empty space -->
    </div>
</div>

<!-- secont section / links part -->
<div class="container-fluid">
    <div class="row links">

        <!-- left section of links part / image -->
        <div class="col-sm-6 col-md-5 links-image">
<!--            <img class="images" src="../images/learn-more.jpg" alt="Μια τάξη!">-->
        </div>

        <!-- right section of links part / links -->
        <div class="col-sm-6 col-md-7 links-text">

            <div class="row">
                <!-- book icon -->
                <div class="col-sm-6 col-md-3">
                    <img class='learn-more' src="../images/learn-more.png" alt="Learn more!">
                </div>

                <div class="col-sm-6 col-md-9">
                    <h2 id="links-header">Πώς μπορώ να μάθω περισσότερα;</h2>
                    <p class="links-list">Σχετικά με την διαδικασία:</p>
                    <ul class="info-text">
                        <li>
                            <a href="https://el.wikipedia.org/wiki/%CE%9A%CE%BF%CE%BC%CF%80%CE%BF%CF%83%CF%84%CE%BF%CF%80%CE%BF%CE%AF%CE%B7%CF%83%CE%B7"
                               target="_blank">Βικιπαίδεια</a>
                        </li>
                        <li>
                            <a href="https://www.epa.gov/recycle/composting-home" target="_blank">United States
                                Environmental Protection Agency</a>
                        </li>
                        <li>
                            <a href="https://kalamaria.gr/%CF%80%CE%B5%CF%81%CE%B9%CE%B2%CE%AC%CE%BB%CE%BB%CE%BF%CE%BD/%CE%BF%CE%B9%CE%BA%CE%B9%CE%B1%CE%BA%CE%AE-%CE%BA%CE%BF%CE%BC%CF%80%CE%BF%CF%83%CF%84%CE%BF%CF%80%CE%BF%CE%AF%CE%B7%CF%83%CE%B7/"
                               target="_blank">Οικιακή κομποστοποίηση Δήμου Καλαμαρίας</a>
                        </li>
                        <li>
                            <a href="http://www.ecorec.gr/ecorec/index.php?option=com_content&view=article&id=171:2013-03-04-14-11-43&catid=23&Itemid=496&lang=en"
                               target="_blank">Οικολογική Εταιρία Ανακύκλωσης</a>
                        </li>
                    </ul>
                    <p class="links-list">Σχετικά με την αναγκαιότητα:</p>
                    <ul class="info-text">
                        <li>
                            <a href="https://www.compostnetwork.info/policy/biowaste-in-europe/" target="_blank">European
                                compost network</a>
                        </li>
                        <li>
                            <a href="https://www.europarl.europa.eu/news/el/headlines/society/20180328STO00751/i-diacheirisi-ton-apovliton-stis-chores-tis-ee-grafima"
                               target="_blank">Ευροπαΐκό Κοινοβούλιο</a>
                        </li>
                        <li>
                            <a href="http://www.ecorec.gr/ecorec/index.php?option=com_content&view=category&id=65&Itemid=538&lang=en"
                               target="_blank">Οικολογική </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <!-- Second empty space -->
    </div>
</div>

<?php include("../php/footer.php") ?>

<script type="text/javascript" src="../javascript/script.js"></script>

<!-- bootstrap javascripts -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>

</body>
</html>