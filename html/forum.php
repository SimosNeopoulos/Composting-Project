<?php
include('../php/functions.php');



if(isset($_POST['posting'])){
    createPost($conn, $_SESSION['userId'], $_POST['new-post'], $_POST['tags']);
    $_POST = array();
    
}

if(isset($_POST['saveComment'])){
    echo $_POST['id-value'];
    addComment($conn, $_POST['id-value'], $_POST['newComment'], $_SESSION['username']);
}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/forum-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Forum</title>
</head>
<body>

<?php
    require('../php/header.php');
?>

<div class="forum-body">
    <div class="sidebar-container">
        <div class="profile-widget">
            <div class="profile-title">
                <b>Το προφίλ μου</b>
            </div>
            <div class="profile-body">
                <div class="profile-pic-container">
                    <img class="profile-pic" src="<?php displayImg(); ?>" alt="profile picture">
                </div>
                <div class="profile-info-container">
                    <b class="username">Όνομα χρήστη: <?php displayName(); ?></b>
                    <button class="btn-profile" onclick="window.location.href = 'personal-info-page.php'">Επισκεψου το
                        προφιλ σου
                    </button>
                </div>
            </div>
        </div>
        <div class="popular-tags">
            <b class="tag-title">Δημοφιλείς ετικέτες</b>
            <ul class="tag-list">
            </ul>
        </div>
    </div>

    <div class="main-container">
        <div class="forum-menu">
            <div class="space"></div>
            <div class="container">
                <button class="btn-forum-filter" onclick="dropdownMenu()">Φιλτράρισμα<img src="../images/arrow-down.png"
                                                                                          onclick="myFunction()"
                                                                                          alt="arrow">
                </button>
                <div class="dropdown_menu">
                    <button class="tabs">Πιο πρόσφατο</button>
                    <button class="tabs">Πιο κοντά</button>
                </div>
            </div>
            <div class="forum-search">
                <table class="elementsContainerForum">
                    <tr>
                        <td>
                            <input class="searchForum" placeholder="Αναζήτηση στο forum">
                        </td>
                        <td>
                            <button type="submit" class="searchIconForum"><img src="../images/search-icon.png"
                                                                               alt="search icon">
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
         <div class="forum-posts">
            <div class="add-post">
                <form method="post" action="#">
                    <input type="text" name="new-post">
                    <input type="text" name="tags">
                    <input type="submit" name="posting" value="Δημοσιευσε">
                </form>
            </div>
            
            <?php         
                $result= getPostsFromDB($conn);
                while($row = mysqli_fetch_array($result)){
            ?> 
             
            <ul id="posts" class="posts">
                <li class="post">
                <div class="post-top">
                    <div class="post-pic-container">
                        <img class="post-pic" src="<?php echo getUserImage($conn, $row['id_user']); ?>" alt="poster profile picture">
                    </div>
                    <b class="user"><?php echo getUserNameByID($conn, $row['id_user']); ?></b>
                </div>
                <div class="post-body">
                    <p class="paragraph"><?php echo $row['body']; ?> </p>
                </div>
                <div class="post-answers">
                    <ul class="comment-section">
                        <li>
                            <div class="comment-user-container">
                                <div class="comment-pic-container">
                                    <img class="comment-pic" src="<?php echo getUserImage($conn, $row['id_user']); ?>"
                                         alt="commenter profile picture">
                                </div>
                                <b class="user-commenting">Όνομα σχολιαστή #1</b>
    
                            </div>
                            <p class="user-comment">Περιεχόμενο σχόλιου πρώτου χρήστη</p>
    
                        </li>
                       
                    </ul>
                    
                    <div class="add-comment">
                    <div class="my-pic-container">
                        <img class="my-pic" src="<?php echo getUserImage($conn, $row['id_user']); ?>" alt="my comment profile picture">
                    </div>
                    <form method="post" action="forum.php">
                        <input type="text" name="newComment" class="my-comment" placeholder="Πρόσθεσε σχόλιο"> 
                        <input type="hidden" name="id-value" class="id-value" value="<?php echo $row["id"] ?>"> 
                        <input type="submit" name="saveComment" value="Αποθήκευση σχολίου">
                    </form>
                   
               </div>
           </div>
       </li>
   </ul> 
    <?php  } ?>
            
               
    <!-- <?php 
       // if(isset($_GET['myPosts'])){
        //    echo 'malakes mpainei re';
       //     inqlude('../html/my-posts.php');
       // }
        
    
    ?> -->
                         
        
        </div> 
    </div>


</div>

<?php include("../php/footer.php") ?>

<script>
    let btn_forum_filter = document.querySelector('.btn-forum-filter');
    let dropdown_menu = document.querySelector('.dropdown_menu');
    let container = document.querySelector('.container');
    btn_forum_filter.addEventListener("click", () => {
        dropdown_menu.classList.toggle('open_dropdown_menu');
        container.classList.toggle('change_container_color');
    });

</script>
<script type="text/javascript" src="../javascript/script.js"></script>
<script type="text/javascript" src="../javascript/forum.js"></script>
</body>
</html>