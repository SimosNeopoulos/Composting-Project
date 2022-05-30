<?php
include('../php/functions.php');

// getPostsFromDB($conn);


if(isset($_POST['posting'])){
    $associate_tags = explode(" ", $_POST['tags']);
    createPost($conn, $_SESSION['userId'], $_POST['new-post'], $associate_tags);
    $_POST = array();
    
}

if(isset($_POST['saveComment'])){
    addComment($conn, $_POST['id-value'], $_POST['newComment'], $_SESSION['username']);
}   

if(isset($_POST['deletePost'])){
    deletePost($conn, $_POST['deletePost']);
}

if(isset($_POST['deleteComment'])){
    deleteComment($conn, $_POST['deleteComment']);
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
            <?php
                    $tags = getAllTags($conn);
                    if($tags):
                        foreach ($tags as $tag):
                ?>
                <li><a href="#">#<?php echo $tag["tag_name"]; ?></a></li>
                <?php 
                        endforeach;
                    endif;
                ?>
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
                <form method="post" action="#">
                    <tr>
                        <td>
                        <input class="searchForum" name="search-tags" placeholder="Αναζήτηση tag">
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
        <?php if(isset($_SESSION['user'])):?>
         <div class="forum-posts">
            <div class="add-post">
                <form method="post" action="#">
                    <input type="text" name="new-post">
                    <input type="text" name="tags">
                    <input type="submit" name="posting" value="Δημοσιευσε">
                </form>
            </div>
        <?php endif;?>
            
            <?php 
                if(isset($_GET['myPosts'])){
                    $posts= getUserPosts($conn, $_SESSION['userId']);
                }
                elseif(isset($_POST["search-tags"])){
                    $tags_array = explode(" ", $_POST["search-tags"]);
                    $posts = getPostsWithTag($conn, $tags_array);
                } else {
                    $posts = getPostsFromDB($conn);
                }
                if($posts):
                    foreach($posts as $post):
                ?> 
                 
                <ul id="posts" class="posts">
                    <li class="post">
                    <div class="post-top">
                        <div class="post-pic-container">
                        <img class="post-pic" src="<?php echo getUserImage($conn, $post['id_user']); ?>" alt="poster profile picture">
                        <?php
                            if(isset($_SESSION['username'])):
                                if($_SESSION['isAdnim'] ):
                        ?>
                        <form method='post' action='#'> 
                        <input id="delete-user" name="deletePost" type="submit" name="delete-Post" value="<?php echo $post["id"] ?>">
                        </form>
                        <?php 
                            endif;
                        endif;
                        ?>
                        </div>
                        <b class="user"><?php echo getUserNameByID($conn, $post['id_user']); ?></b> 
                    </div>
                    <div class="post-body">
                    <p class="paragraph"><?php echo $post['body']; ?> </p>
                    <ul>
                    <?php
                      $tags = getTagsFromPost($conn, $post['id']);
                      if($tags):
                        foreach($tags as $tag):
                    ?>
                    <li> <?php echo $tag['tag_name']; ?></li> 
                    <?php 
                        endforeach;
                       endif;   
                    ?>
                    </ul>
                    </div>
                    <div class="post-answers">
                        <ul class="comment-section">
                        <?php 
                            $comments = getCommentsForPost($conn, $post['id']);
                            if($comments):
                                foreach ($comments as $comment):
                            ?>
                            <li>
                                <div class="comment-user-container">
                                    <div class="comment-pic-container">
                                    <img class="comment-pic" src="<?php echo getUserImage($conn, $post['id_user']); ?>"
                                             alt="commenter profile picture">
                                    </div>
                                    <b class="user-commenting"><?php echo $comment['comment_author'] ?></b>
                                    <?php 
                                    if(isset($_SESSION['username'])):
                                        if($_SESSION['isAdnim']):
                                    ?>
                                    <form method='post' action='#'> 
                                        <input id="delete-user" name="deleteComment" type="submit" name='deleteComment' value="<?php echo $comment['id'] ?>">
                                    </form>
                                    <?php 
                                        endif;
                                    endif;
                                    ?>
                                </div>
                                <p class="user-comment"><?php echo $comment['body'] ?></p>
        
                            </li>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                           
                        </ul>
                        
                        <div class="add-comment">
                        <div class="my-pic-container">
                        <img class="my-pic" src="<?php echo getUserImage($conn, $post['id_user']); ?>" alt="my comment profile picture">
                        </div>
                        <form method="post" action="forum.php">
                            <input type="text" name="newComment" class="my-comment" placeholder="Πρόσθεσε σχόλιο"> 
                            <input type="hidden" name="id-value" class="id-value" value="<?php echo $post["id"] ?>"> 
                            <input type="submit" name="saveComment" value="Αποθήκευση σχολίου">
                        </form>
                       
                   </div>
               </div>
           </li>
       </ul> 
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