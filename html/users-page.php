<?php
include('../php/functions.php');
 
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
                <form method="post" action="#">
                    <tr>
                        <td>
                        <input class="searchForum" name="search-tags" placeholder="Αναζήτηση χρηστώνgit">
                        </td>
                        <td>
                        <button type="submit" name="search-for-tags" class="searchIconForum"><img src="../images/search-icon.png"
                                                                               alt="search icon">
                            </button>
                        </td>
                    </tr>
                    </form>
                </table>
            </div>
        </div>
         <div class="forum-posts">
             <?php $showFriends = false;
              if(isset($_POST['user-search'])){
                $users = findUsers($conn, $_POST['user-search']);
             }else{
                $showFriends = true;
                $users = getAllFriends($conn, $_SESSION['userId']);
             }
                if($users):
                    foreach($users as $user ):
                ?>
                <div class="userProfile">
                    <img class="post-pic" src="<?php echo $showFriends ? getImagePath($conn, $user['username']) : $user['imgpath']; ?>">
                    <a id="username" href="../html/personal-info-page.php?username=<?php echo $user['username']; ?>"> <?php echo $user['username']; ?></a>
                </div>
                <?php
                    endforeach;
                endif;
            
            
                 ?>
            
           
            
            
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