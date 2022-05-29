<?php
    include("../php/functions.php");  
    
 

    if(isset($_POST['upload-pic'])){

        $target_dir = '../images/usrimages/';

        if(isset($_FILES["pic"]["name"]) ){

            $target_file = $target_dir.basename($_FILES["pic"]["name"]);
            move_uploaded_file($_FILES['pic']['tmp_name'], $target_file);
            $upadteImgpath = "UPDATE user SET imgpath= '../images/usrimages/" .$_FILES['pic']['name']. "' WHERE username='" .$_SESSION['username']."' ";

            if(mysqli_query($conn, $upadteImgpath)){
                
                $_SESSION['imgpath']= "../images/usrimages/" .$_FILES['pic']['name']. "";
            }
        }else{
            echo 'not uploaded';
        }
        
      
    }

    if(isset($_POST['save-button'])){
                
        $update = "UPDATE user SET username= '".$_POST['username']."',  email= '" . $_POST['email'] . "' , city= '" . $_POST['address'] . "' , password= '" . $_POST['password'] . "' , telephone= '" . $_POST['telephone'] . "' WHERE username='" .$_SESSION['username']."' ";
        
        if(mysqli_query($conn, $update)){
            $_SESSION['username']=$_POST['username'];
            $_SESSION['email']=$_POST['email'];
            $_SESSION['address']=$_POST['address'];
            $_SESSION['password']=$_POST['password'];
            $_SESSION['telephone']=$_POST['telephone'];
        }else{
            printf("error");
        }
        
       
    }

    
?>


<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="../css/personal-info-style.css">
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <link rel="shortcut icon" href="../images/composting200.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Composting!</title>
    
</head>
<body>

<?php
    require("../php/header.php");
    
?>

<div class="container">

    <!--Profile pic box-->
    <div class="profile_pic">

        <img class="picture" src=<?php displayImg(); ?> alt="profile image!">
        <div class="edit">
            
            <h3 id="edit-text"> Νεα εικόνα προφίλ;</h3>
            <form method="post" action="" enctype="multipart/form-data" >
                <label for="image-upload"><img id="edit-icon" src="../images/edit-icon.png" alt="click hear to edit"></label>
                <input type="file" name="pic" id="image-upload" accept="images/*">
                <input type="submit" value="Αποθήκευση" name="upload-pic" id="submit-upload">
            </form>
            
            
        </div>
       
    </div>

    <!--Profile info box-->
    <div class="profile_info">

        <div class="title">
            <h1 id="profile-header">Καλωσόρισες στο προφίλ σου!</h1>
        </div>

        <form method='post' action="#" >
           
            <div class="user-data-fields">
                <label>Όνομα χρήστη</label>
                <input type="text" name="username" placeholder="Username" value="<?php displayName(); ?>">

            </div>
            <div class="user-data-fields">
                <label> Email</label>
                <input type="text" name="email" placeholder="Email" value="<?php displayEmail(); ?>">


            </div>  
          <div class="user-data-fields">
               <label>Διεύθυνση</label>
                <input type="text" name="address" placeholder="Address" value="<?php dipslayAddress(); ?>">

          </div>
          <div class="user-data-fields">
            <label>Κωδικός πρόσβασης </label>
            <input type="password" name="password" placeholder="Password" value="<?php displayPassword(); ?>">

           </div>
            <div class="user-data-fields">
              <label>Τηλέφωνο</label>
              <input type="tel" name="telephone" placeholder="69-99999999"  required value="<?php displayTelephone(); ?>">

            </div>


            <div class="save-button">
                <button id="save" type="submit" name="save-button" >
                    Αποθηκευση!
                </button>
                    
                
            </div>
        </form>
        

        <div class="links-container">
            <div class="links">
                <img class="link-icons" src="../images/save_icon.png" alt="Posts!">
                <a class="posts" href=""> Τα ποστ μου</a>
            </div>
            <div class="links">
                <img class="link-icons" src="../images/push_pin.png" alt="Saved!">
                <a class="posts" href="">Αποθηκευμένα ποστ</a>
            </div>
            <div class="links">
                <img class="link-icons" src="../images/logout-icon.png" alt="Logout!">
                <a class="posts" href="../php/logout.php" title="logout">Αποσύνδεση</a>
            </div>
        </div>

    </div>
</div>

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
<script type="text/javascript" src="../javascript/personal-info.js"></script>

</body>
</html>




