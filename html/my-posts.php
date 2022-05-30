




<div class="forum-posts">
    <ul id="posts" class="posts">
        <li class="post">
            <div class="post-top">
                <div class="post-pic-container">
                    <img class="post-pic" src="<?php echo getUserImage($conn, $row['id_user']); ?>" alt="poster profile picture">
                </div>
                <b class="user"><?php echo getUserNameByID($conn, $row['id_user']); ?></b>
            </div>
            <div class="post-body">
                <p class="paragraph"><?php echo'kalhmwea' ?> </p>
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
                    
                </div>
                
        </li>
    </ul>
</div>
