<?php
session_start();
include("../php/connect.php");
include("../php/classes.php");

/********** LOG IN / SIGN UP VERIFICATION **********/

/**
 * Finds whether a username exist in the database or not
 * 
 * @param mysqli $conn      the connection to the serever
 * @param string $username  the username that searching we are searching for
 * 
 * @return mixed            true if the username exists, false if it doesn't
 *                          and null if there was an error with the database
 */
function nameExists($conn, $username) {
    $sql_query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql_query);
    if(!$result) {
        return null;
    }
    $resultCheck = mysqli_num_rows($result);
    mysqli_free_result($result);

    if($resultCheck > 0) {
        return true;
    }
    return false;
}

/**
 * Finds whether a email exist in the database or not
 * 
 * @param mysqli $conn      the connection to the serever
 * @param string $email     the email that searching we are searching for
 * 
 * @return mixed            true if the email exists, false if it doesn't
 *                          and null if there was an error with the database
 */
function emailExists($conn, $email) {
    $sql_query = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql_query);
    if(!$result) {
        return null;
    }
    $resultCheck = mysqli_num_rows($result);
    mysqli_free_result($result);

    if($resultCheck > 0) {
        return true;
    }
    return false;
}

/**
 * Signing Up a user
 * 
 * @param mysqli $conn      the connection to the serever
 * @param string $username  the username of the user that's being added
 * @param string $email     the email of the user that's being added
 * @param string $address   the address of the user that's being added
 * @param string $password  the password of the user that's being added
 * @param string $telephone the telephone of the user that's being added
 * 
 * @return boolean          returns true if the user didn't already exist and was
 *                          created successfully and false if there was a problem
 *                          with the creation of the user
 */
function signUp($conn, $username, $email, $address, $password, $telephone) {
     return addAccountToDB($conn, $username, $email, $address, $password, $telephone);
}

/**
 * Adding an acount to the database if the user didn't already exist and was
 * created successfully and logging him into the site
 * 
 * @param mysqli $conn      the connection to the serever
 * @param string $username  the username of the user that's being added
 * @param string $email     the email of the user that's being added
 * @param string $address   the address of the user that's being added
 * @param string $password  the password of the user that's being added
 * @param string $telephone the telephone of the user that's being added
 * 
 * @return boolean          returns true if the user didn't already exist and was
 *                          created successfully and false if there was a problem
 *                          with the creation of the user
 */
function addAccountToDB($conn, $username, $email, $address, $password, $telephone) {
    $sql_query = "INSERT INTO users(username, email, address, password, telephone) VALUES ('$username', '$email', '$address', '$password','$telephone')";
    if(mysqli_query($conn, $sql_query)) {
        $id = mysqli_insert_id($conn);
        $user = new User($id, $username, $email, $address, $password, $telephone);
        if(logIn($user)) {
            return true;
        } else {
            return false;
        }
            
    }
    echo "query error " . mysqli_error($conn);
    return false;
}

/**
 * Verifies the user log in informstion and logs them in if it is correct
 * 
 * @param mysqli $conn      the connection to the serever
 * @param string $email     the email of the user that requsts to log in
 * @param string $password  the password of the user that requsts to log in
 * 
 * @return mixed            true if the accont data were correct and the user was
 *                          loged in successfully, false if the accont data were incorrect
 *                          and null if there was an error with the database
 */
function authenticate($conn, $email, $password) {
    $sql_query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql_query);
    if(!$result) {
        return null;
    }
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    if($rows < 1 || $data["password"] != $password) {
        return false;
    }
    $user = new User($data["id"], $data["username"], $data["email"], $data["address"], $data["password"], $data["telephone"]);
    return logIn($user);
}

/**
 * Adds a user to a session
 * 
 * @param User $user    veriable that represents the user
 * 
 * @return boolean      true when the user is added to the SESSION
 */
function logIn($user) {
    $_SESSION["user"] = $user;
    return true;
}
/****************************** *****************************/

function getCurrentUserData(){

}

function displayName(){
    if(isset($_SESSION['username'])){
        echo $_SESSION['username'];
    }else{
        echo '';
    }
}

function displayEmail(){
    if(isset($_SESSION['email'])){
        echo $_SESSION['email'];
    }else{
        echo '';
    }
}

function dipslayAddress(){
    if(isset($_SESSION['address'])){
        echo $_SESSION['address'];
    }else{
        echo '';
    }
}

function displayPassword(){
    if(isset($_SESSION['password'])){
        echo $_SESSION['password'];
    }else{
        echo '';
    }
}

function displayTelephone(){
    if(isset($_SESSION['telephone'])){
        echo $_SESSION['telephone'];
    }else{
        echo '';
    }
}


/************* POSTS / COMMENTS / TAGS *************/

/********* SEARCH QUERIES **********/

/**
 * This function creates and returns an associated array of the data 
 * from all the posts of the user with an id equal to the $userId parameter
 * 
 * 
 * @param mysqli $conn      the connection to the serever
 * @param integer $userId   the id of the user that we want to get the posts from
 * 
 * @return mixed            returns an associated array of the data from all the
 *                          posts of a specific user or false if the search had no results
 */
function getUserPosts($conn, $userId) {
    $sql_query = "SELECT * FROM posts WHERE id_user = '$userId' ORDER BY post_date DESC";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
}

/**
 * This function creates and returns an associated array of the data 
 * from all the users that live in the same area as the one that the
 * parameter city represents
 * 
 * 
 * @param mysqli $conn      the connection to the serever
 * @param string $city      the area which we want to find the users that live there
 * 
 * @return mixed            returns an associated array of the data from all the
 *                          users that live in a specific area or false if the 
 *                          search had no results
 */

function getPostsFromArea($conn, $city) {
    $sql_query = "SELECT posts.id, id_user, posts.body, posts.post_date 
                  FROM users, posts 
                  WHERE users.address = '$city' AND id_user = users.id 
                  ORDER BY post_date DESC 
                  LIMIT 5";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
}

/**
 * This function returns an associated array with the data from all 
 * the posts that have one or more of the tags in the array
 * 
 * 
 * @param mysqli  $conn             the connection to the serever
 * @param array   $tags             string array of the tags of a post
 * @param integer $numberOfPosts    string array of the tags of a post
 * 
 * @return mixed            returns an associated array with the data from all the
 *                          posts that have one or more of the tags in the array $tags
 */
function getPostsWithTag($conn, $tags, $numberOfPosts=30) {
    $where_query = getArrayWhereStatment($tags, "tag_name");
    $sql_query = "SELECT id, id_user, body, post_date
                  FROM posts INNNER JOIN posts_has_tags
                  ON id = posts_id
                  INNER JOIN tags
                  ON id_tag = tags_id
                  WHERE $where_query
                  ORDER BY post_date DESC 
                  LIMIT $numberOfPosts";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
}

/**
 * This function is used to get the ids of the tags inside the $tags array
 * 
 * 
 * @param mysqli  $conn             the connection to the serever
 * @param array   $tags             string array of the tags of a post
 * 
 * @return mixed            returns an associated array with the ids of all the tags
 *                          in the $tags array
 */
function getTagsId($conn, $tags) {
    $where_query = getArrayWhereStatment($tags, "tag_name");
    $sql_query = "SELECT id FROM tags WHERE $where_query";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    
    if($rows < 1) {
        return false;
    }
    return $result;
}

/**
 * This function checks is a user with id equal to $userId is friends
 * with another user whose username is qual to $friendName
 * 
 * 
 * @param mysqli    $conn               the connection to the serever
 * @param integer   $userId             the id of the user that we want to see if he has a 
 *                                      specific friened
 * @param string    $friendName         a string of the username of a friend 
 * 
 * @return boolean          returns true if the user with id equal to $userId has
 *                          a friend with a username equal to$friendName
 */
function isFriendsWith($conn, $userId, $friendName) {
    $sql_query = "SELECT username 
                  FROM friends 
                  WHERE users_id = '$userId' AND username = '$friendName'";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    mysqli_free_result($result);
    if($rows > 0) {
        return true;
    }
    return false;
}

function findFriends($conn, $userId, $friendName) {
    $sql_query = "SELECT * 
                  FROM friends 
                  WHERE users_id = '$userId' AND username LIKE '%$friendName%'";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
}

function findUsers($conn, $username) {
    $sql_query = "SELECT * 
                  FROM users 
                  WHERE username LIKE '%$username'%";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        return false;
    }
    return $data;
}

function findUsersFromArea($conn, $area) {
    $sql_query = "SELECT * 
                  FROM users 
                  WHERE address = '$area'";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        echo "Δεν επιστρέφηκαν αποτελέσματα";
        return false;
    }
    return $data;
}

/**************** ****************/

/********* INSERT QUERIES **********/

function createPost($conn, $userId, $body, $tags) {
    $post_date = date('Y-m-d H:i:s');
    if(!$post_date) {
        return null;
    }
    $sql_query = "INSERT INTO posts(id_user, body, post_date) VALUES ('$userId', '$body', '$post_date')";
    if(!mysqli_query($conn, $sql_query)) {
        return null;
    }
    $id = mysqli_insert_id($conn);
    addTagsToPost($conn, $id, $tags);

}

function addTagsToPost($conn, $post_id, $tags) {
    $result = getTagsId($conn, $tags);
    
    if(!$result) {
        echo "Δεν επιστρέφηκαν αποτελέσματα";
        return;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $tag_id = $row['id'];
        $sql_query = "INSERT INTO posts_has_tags(posts_id, tags_id) VALUES ('$post_id', '$tag_id')";
        mysqli_query($conn, $sql_query);
    }
    mysqli_free_result($result);
}

function addFriend($conn, $userId, $friendName) {
    $sql_query = "INSERT INTO friends(users_id, username) VALUES ('$userId', '$friendName')";
    if(mysqli_query($conn, $sql_query))
        return true;
    return false;
}

function createComment($conn, $posts_id, $body, $commentAuthor) {
    $post_date = date('Y-m-d H:i:s');
    if(!$post_date) {
        return null;
    }
    $sql_query = "INSERT INTO comments(posts_id, body, comment_author, post_date) VALUES ('$posts_id', '$body', '$commentAuthor', '$post_date')";
    if(!mysqli_query($conn, $sql_query)) {
        return null;
    }
    return true;
}

/*************** *****************/

/********* DELETE QUERIES **********/
function deletePost($conn, $id) {
    $sql_query = "DELETE FROM posts WHERE id = '$id'";
    if(mysqli_query($conn, $sql_query)) 
        return true;
    return false;
}

function removeTagsToPost($conn, $post_id, $tags) {
    $result = getTagsId($conn, $tags);

    if(!$result) {
        echo "Δεν επιστρέφηκαν αποτελέσματα";
        return null;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $tag_id = $row['id'];
        $sql_query = "DELETE FROM posts_has_tags WHERE posts_id = $post_id AND tags_id = $tag_id";
        if(!mysqli_query($conn, $sql_query)) {
            return null;
        }
    }
    mysqli_free_result($result);
    return true;
}

function deleteComment($conn, $id) {
    $sql_query = "DELETE FROM comments WHERE id = '$id'";
    if(mysqli_query($conn, $sql_query))
        return true;
    return false;
}


function deleteFriend($conn, $userId, $friendName) {
    $sql_query = "DELETE FROM friends WHERE users_id = '$userId' AND username = '$friendName'";
    if(mysqli_query($conn, $sql_query))
        return true;
    return false;
}

/***************** *****************/

/********* UPDATE QUERIES **********/

function updateComment($conn, $id, $newBody) {
    $sql_query = "UPDATE comments SET body = '$newBody' WHERE id = '$id'";
    if(mysqli_query($conn, $sql_query))
        return true;
    return false;
}

function updatePost($conn, $id, $newBody) {
    $sql_query = "UPDATE posts SET body = '$newBody' WHERE id = '$id'";
    if(mysqli_query($conn, $sql_query))
        return true;
    return false;
}

/***************** *****************/

function getArrayWhereStatment($array, $columnName) {
    $where_query = "( ";
    $numElements = count($array);
    for($i=0; $i<$numElements; $i++) {
        $elemnt = $array[$i];
        $where_query .= "$columnName = '$elemnt'";
        if($i+1 !== $numElements) {
            $where_query .= " OR ";
        }
    }
    $where_query .= ")";
    return $where_query;
}

/************************  *************************/
?>

