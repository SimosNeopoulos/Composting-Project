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

    if(isset($_POST['deleteUser'])){
        
        if(deleteUserFromDB($conn, $_SESSION['username'])){
            //TODO να μην εμφανιζονται πλεον τα στοιχεια του χρηστη!
            header("Location:../html/homepage.php");
        }
        
    }
    
    if(isset($_GET['username']) && ($_SESSION['username'] !== $_GET['username'] )){
        $user = getUser($conn, $_GET['username']);
    }else{
        $user = getUser($conn, $_SESSION['username']);
    } 

    if(isset($_POST['addFriend'])){
        $friendID= getUserId($conn, $user[0]['username']);
       if( !addFriend($conn, $_SESSION['userId'], $user[0]['username']) && !addFriend($conn, $friendID, $_SESSION['username'])){
           echo 'Υπήρξε κάποιο πρόβλημα';
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

        <img class="picture" src=<?php echo $user[0]['imgpath']; ?> alt="profile image!">
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
            <form id="delete-form" method="post" action="#"> 
                <input id="delete-user" name="deleteUser" type="submit" name="delete-user" value="">
            </form>
        </div>
        
        <form method='post' action="#" >
           
            <div class="user-data-fields">
                <label>Όνομα χρήστη</label>
                <input type="text" name="username" placeholder="Username" value="<?php echo $user[0]['username']; ?>">

            </div>
            <div class="user-data-fields">
                <label> Email</label>
                <input type="text" name="email" placeholder="Email" value="<?php echo $user[0]['email']; ?>">


            </div>  
          <div class="user-data-fields">
               <label>Διεύθυνση</label>
                <input type="text" name="address" placeholder="Address" value="<?php echo $user[0]['city']; ?>">

          </div>
          <div class="user-data-fields">
            <label>Κωδικός πρόσβασης </label>
            <input type="password" name="password" placeholder="Password" value="<?php echo $user[0]['password']; ?>">

           </div>
            <div class="user-data-fields">
              <label>Τηλέφωνο</label>
              <input type="tel" name="telephone" placeholder="69-99999999"  required value="<?php echo $user[0]['telephone'] ?>">

            </div>


            <div class="save-button">
                <button id="save" type="submit" name="save-button" >
                    Αποθηκευση!
                </button>
                    
                
            </div>

            <form method='post' action='#' class="addFriendForm">
                <input id = 'addFriend' type='submit' name='addFriend' value='Προσθεσε φίλο!'>
            </form>

        </form>
        

        <div class="links-container" style="display:block;">
            <div class="links">
                <img class="link-icons" src="../images/save_icon.png" alt="Posts!">
                <a class="posts" href="../html/users-page.php?myFriends=true"> Οι φίλοι μου</a>
            </div>
            <div class="links">
                <img class="link-icons" src="../images/push_pin.png" alt="Saved!">
                <a class="posts" href="../html/forum.php?myPosts=true">Τα ποστ μου</a>
            </div>
            <div class="links">
                <img class="link-icons" src="../images/logout-icon.png" alt="Logout!">
                <a class="posts" href="../php/logout.php" title="logout">Αποσύνδεση</a>
            </div>
        </div>

    </div>
</div>

<?php include("../php/footer.php") ?>

<?php
if(!$_SESSION['isAdnim']){
    echo '<script type="text/javascript" src="../javascript/isAdmin.js"></script>';
}
if(isset($_GET['username'])){
    if(($_SESSION['username'] !== $_GET['username']) && !$_SESSION['isAdnim']){
        
        echo '<script type="text/javascript" src="../javascript/manipulate-content.js"></script>';
    }
        
    
}
?>
<script type="text/javascript" src="../javascript/script.js"></script>
<script type="text/javascript" src="../javascript/personal-info.js"></script>

</body>
</html>




