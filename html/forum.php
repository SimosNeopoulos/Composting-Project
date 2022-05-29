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
<!-- <header id="page-header"></header>
<script defer src="../javascript/header.js"></script> -->
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
                    <img class="profile-pic" src="../images/profilepicture.png" alt="profile picture">
                </div>
                <div class="profile-info-container">
                    <b class="username">Όνομα χρήστη: Όνομα</b>
                    <button class="btn-profile" onclick="window.location.href = 'personal-info-page.php'">Επισκεψου το
                        προφιλ σου
                    </button>
                </div>
            </div>
        </div>
        <div class="popular-tags">
            <b class="tag-title">Δημοφιλείς ετικέτες</b>
            <ul class="tag-list">
                <li><a href="">#ετικέτα1</a></li>
                <li><a href="">#ετικέτα2</a></li>
                <li><a href="">#ετικέτα3</a></li>
                <li><a href="">#ετικέτα4</a></li>
                <li><a href="">#ετικέτα5</a></li>
                <li><a href="">#ετικέτα6</a></li>

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
            <ul id="posts" class="posts">
                <li class="post">
                    <div class="post-top">
                        <div class="post-pic-container">
                            <img class="post-pic" src="../images/profilepicture.png" alt="poster profile picture">
                        </div>
                        <b class="user">Όνομα δημοσιευτή</b>
                    </div>
                    <div class="post-body">
                        <p class="paragraph">Περιεχόμενο δημοσίευσης
                        </p>
                    </div>
                    <div class="post-answers">
                        <ul class="comment-section">
                            <li>
                                <div class="comment-user-container">
                                    <div class="comment-pic-container">
                                        <img class="comment-pic" src="../images/profilepicture.png"
                                             alt="commenter profile picture">
                                    </div>
                                    <b class="user-commenting">Όνομα σχολιαστή #1</b>

                                </div>
                                <p class="user-comment">Περιεχόμενο σχόλιου πρώτου χρήστη</p>

                            </li>
                            <li>
                                <div class="comment-user-container">
                                    <div class="comment-pic-container">
                                        <img class="comment-pic" src="../images/profilepicture.png"
                                             alt="commenter profile picture">
                                    </div>
                                    <b class="user-commenting">Όνομα σχολιαστή #2</b>
                                </div>
                                <p class="user-comment">Περιεχόμενο σχόλιου δεύτερου χρήστη</p>
                            </li>
                        </ul>

                        <div class="add-comment">
                            <div class="my-pic-container">
                                <img class="my-pic" src="../images/profilepicture.png" alt="my comment profile picture">
                            </div>
                            <b class="me">Εγώ</b>
                            <input class="my-comment" placeholder="Πρόσθεσε σχόλιο">
                            <button class="btn-enter">Σχολίασε</button>
                        </div>
                    </div>
                </li>
                <li class="post">
                    <div class="post-top">
                        <div class="post-pic-container">
                            <img class="post-pic" src="../images/profilepicture.png" alt="poster profile picture">
                        </div>
                        <b class="user">Όνομα δημοσιευτή</b>
                    </div>
                    <div class="post-body">
                        <p class="paragraph">Περιεχόμενο δημοσίευσης
                        </p>
                    </div>
                    <div class="post-answers">
                        <ul class="comment-section">
                            <li>
                                <div class="comment-user-container">
                                    <div class="comment-pic-container">
                                        <img class="comment-pic" src="../images/profilepicture.png"
                                             alt="commenter profile picture">
                                    </div>
                                    <b class="user-commenting">Όνομα σχολιαστή #1</b>

                                </div>
                                <p class="user-comment">Περιεχόμενο σχόλιου πρώτου χρήστη</p>

                            </li>
                            <li>
                                <div class="comment-user-container">
                                    <div class="comment-pic-container">
                                        <img class="comment-pic" src="../images/profilepicture.png"
                                             alt="commenter profile picture">
                                    </div>
                                    <b class="user-commenting">Όνομα σχολιαστή #2</b>
                                </div>
                                <p class="user-comment">Περιεχόμενο σχόλιου δεύτερου χρήστη</p>
                            </li>
                        </ul>

                        <div class="add-comment">
                            <div class="my-pic-container">
                                <img class="my-pic" src="../images/profilepicture.png" alt="my comment profile picture">
                            </div>
                            <b class="me">Εγώ</b>
                            <input class="my-comment" placeholder="Πρόσθεσε σχόλιο">
                            <button class="btn-enter">Σχολίασε</button>
                        </div>
                    </div>
                </li>
                <li class="post">
                    <div class="post-top">
                        <div class="post-pic-container">
                            <img class="post-pic" src="../images/profilepicture.png" alt="poster profile picture">
                        </div>
                        <b class="user">Όνομα δημοσιευτή</b>
                    </div>
                    <div class="post-body">
                        <p class="paragraph">Περιεχόμενο δημοσίευσης
                        </p>
                    </div>
                    <div class="post-answers">
                        <ul class="comment-section">
                            <li>
                                <div class="comment-user-container">
                                    <div class="comment-pic-container">
                                        <img class="comment-pic" src="../images/profilepicture.png"
                                             alt="commenter profile picture">
                                    </div>
                                    <b class="user-commenting">Όνομα σχολιαστή #1</b>

                                </div>
                                <p class="user-comment">Περιεχόμενο σχόλιου πρώτου χρήστη</p>

                            </li>
                            <li>
                                <div class="comment-user-container">
                                    <div class="comment-pic-container">
                                        <img class="comment-pic" src="../images/profilepicture.png"
                                             alt="commenter profile picture">
                                    </div>
                                    <b class="user-commenting">Όνομα σχολιαστή #2</b>
                                </div>
                                <p class="user-comment">Περιεχόμενο σχόλιου δεύτερου χρήστη</p>
                            </li>
                        </ul>

                        <div class="add-comment">
                            <div class="my-pic-container">
                                <img class="my-pic" src="../images/profilepicture.png" alt="commenter profile picture">
                            </div>
                            <b class="me">Εγώ</b>
                            <input class="my-comment" placeholder="Πρόσθεσε σχόλιο">
                            <button class="btn-enter">Σχολίασε</button>
                        </div>
                    </div>
                </li>
                <li class="post">
                    <div class="post-top">
                        <div class="post-pic-container">
                            <img class="post-pic" src="../images/profilepicture.png" alt="poster profile picture">
                        </div>
                        <b class="user">Όνομα δημοσιευτή</b>
                    </div>
                    <div class="post-body">
                        <p class="paragraph">Περιεχόμενο δημοσίευσης
                        </p>
                    </div>
                    <div class="post-answers">
                        <ul class="comment-section">
                            <li>
                                <div class="comment-user-container">
                                    <div class="comment-pic-container">
                                        <img class="comment-pic" src="../images/profilepicture.png"
                                             alt="commenter profile picture">
                                    </div>
                                    <b class="user-commenting">Όνομα σχολιαστή #1</b>

                                </div>
                                <p class="user-comment">Περιεχόμενο σχόλιου πρώτου χρήστη</p>

                            </li>
                            <li>
                                <div class="comment-user-container">
                                    <div class="comment-pic-container">
                                        <img class="comment-pic" src="../images/profilepicture.png"
                                             alt="commenter profile picture">
                                    </div>
                                    <b class="user-commenting">Όνομα σχολιαστή #2</b>
                                </div>
                                <p class="user-comment">Περιεχόμενο σχόλιου δεύτερου χρήστη</p>
                            </li>
                        </ul>

                        <div class="add-comment">
                            <div class="my-pic-container">
                                <img class="my-pic" src="../images/profilepicture.png" alt="my comment profile picture">
                            </div>
                            <b class="me">Εγώ</b>
                            <input class="my-comment" placeholder="Πρόσθεσε σχόλιο">
                            <button class="btn-enter">Σχολίασε</button>
                        </div>
                    </div>
                </li>
            </ul>
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
</body>
</html>